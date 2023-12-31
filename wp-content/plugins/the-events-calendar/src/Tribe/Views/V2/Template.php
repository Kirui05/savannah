<?php
/**
 * The base template all Views will use to locate, manage and render their HTML code.
 *
 * @since   4.9.2
 * @package Tribe\Events\Views\V2
 */

namespace Tribe\Events\Views\V2;

use Tribe\Traits\Cache_User;
use Tribe__Repository__Interface as Repository_Interface;
use Tribe__Template as Base_Template;
use Tribe__Utils__Array as Arr;
use WP_Post;

/**
 * Class Template
 *
 * @since   4.9.2
 * @package Tribe\Events\Views\V2
 */
class Template extends Base_Template {
	use Cache_User;

	/**
	 * The view the template should use to build its path.
	 *
	 * @var View_Interface
	 */
	protected $view;

	/**
	 * The repository instance that provided the template with posts, if any.
	 *
	 * @var Repository_Interface
	 */
	protected $repository;

	/**
	 * An array cache to keep track of  resolved template files on a per-name basis.
	 * The file look-around needs not to be performed twice per request.
	 *
	 * @since 4.9.4
	 *
	 * @var array
	 */
	protected $template_file_cache = [];

	/**
	 * Renders and returns the View template contents.
	 *
	 * @since 4.9.2
	 *
	 * @param array $context_overrides Any context data you need to expose to this file
	 *
	 * @return string The rendered template contents.
	 */
	public function render( array $context_overrides = [] ) {
		$context             = wp_parse_args( $context_overrides, $this->context );
		$context['_context'] = $context;

		$template_slug = $this->view->get_template_slug();
		if ( ! empty( $this->view->get_template_path() ) ) {
			$template_slug = [
				$this->view->get_template_path(),
				$template_slug,
			];
		}

		return parent::template( $template_slug, $context, false );
	}

	/**
	 * Template constructor.
	 *
	 * @since 4.9.2
	 * @since 4.9.4 Modified the first param to only accept View_Interface instances.
	 *
	 * @param View_Interface $view The view the template should use to build its path.
	 *
	 */
	public function __construct( $view ) {
		$this->set_view( $view );

		$this->set_template_origin( tribe( 'tec.main' ) )
		     ->set_template_folder( 'src/views/v2' )
		     ->set_template_folder_lookup( true )
		     ->set_template_context_extract( true );

		// Set some global defaults all Views are likely to search for; those will be overridden by each View.
		$this->set_values( [
			'slug'     => $view::get_view_slug(),
			'prev_url' => '',
			'next_url' => '',
		], false );

		// Set some defaults on the template.
		$this->set( 'view_class', get_class( $view ), false );
		$this->set( 'view_slug', $view::get_view_slug(), false );
		$this->set( 'view_label', $view::get_view_label(), false );

		// Set which view globally.
		$this->set( 'view', $view, false );
	}

	/**
	 * Returns the template file the View will use to render.
	 *
	 * If a template cannot be found for the view then the base template for the view will be returned.
	 *
	 * @since 4.9.2
	 * @since 6.2.0 Added support for looking up the inheritance chain for templates from parent views.
	 *
	 * @param string|array|null $name Either a specific name to check, the fragments of a name to check, or `null` to let
	 *                                the view pick the template according to the template override rules.
	 *
	 * @return string The path to the template file the View will use to render its contents.
	 */
	public function get_template_file( $name = null ) {
		$view_slug = $this->view::get_view_slug();
		$name      = null !== $name ? $name : [ $view_slug ];
		if ( ! is_array( $name ) ) {
			$name = explode( '/', $name );
		}
		$count_name = count( $name );
		$cache_key  = is_array( $name ) ? implode( '/', $name ) : $name;

		$cached = Arr::get( $this->template_file_cache, $cache_key, false );
		if ( $cached ) {
			return $cached;
		}

		$file           = parent::get_template_file( $name );
		$found_template = false !== $file;

		if ( ! $found_template ) {
			$found_inheritance_template = false;
			if ( $view_slug === reset( $name ) ) {
				$inheritance = $this->get_view()->get_inheritance( false );
				$paths       = array_map( static function ( $view_class ) use ( $name ) {
					return array_replace( $name, [ $view_class::get_view_slug() ] );
				}, $inheritance );

				foreach ( $paths as $path ) {
					$file = parent::get_template_file( $path );
					if ( false !== $file ) {
						$found_inheritance_template = true;
						break;
					}
				}
			}

			if ( $found_inheritance_template === false && $count_name === 1 ) {
				$file = $this->get_base_template_file();
			}
		}

		$this->template_file_cache[ $cache_key ] = $file;

		return $file;
	}

	/**
	 * Returns the absolute path to the view base template file.
	 *
	 * @since 4.9.2
	 *
	 * @return string The absolute path to the Views base template.
	 */
	public function get_base_template_file() {
		// Print the lookup folders as relative paths.
		$this->set(
			'lookup_folders',
			array_map(
				static function ( array $folder ) {
					$folder['path'] = str_replace( WP_CONTENT_DIR, '', $folder['path'] );
					$folder['path'] = str_replace( WP_PLUGIN_DIR, '/plugins', $folder['path'] );

					return $folder;
				},
				$this->get_template_path_list()
			),
			false
		);

		if ( $this->view instanceof View_Interface ) {
			$this->set( 'view_slug', $this->view::get_view_slug(), false );
			$this->set( 'view_label', $this->view::get_view_label(), false );
			$this->set( 'view_class', get_class( $this->view ), false );
		}

		return parent::get_template_file( 'base' );
	}

	/**
	 * Sets up the post data and replace the global post variable on all required places.
	 *
	 * @since 4.9.13
	 *
	 * @param WP_Post $event Which event will replace the Post for the templates
	 *
	 * @return bool|void  Returns whatever WP_Query::setup_postdata() sends back.
	 */
	public function setup_postdata( WP_Post $event ) {
		global $post, $wp_query;

		// Replace the global $post with the event given.
		$post = $event;

		// Setup Post data with the info passed.
		return $wp_query->setup_postdata( $post );
	}

	/**
	 * Returns the absolute path to the view "not found" template file.
	 *
	 * @since 4.9.2
	 *
	 * @return string The absolute path to the Views "not found" template.
	 */
	public function get_not_found_template() {
		return parent::get_template_file( 'not-found' );
	}

	/**
	 * Sets the template view.
	 *
	 * @since 4.9.4 Modified the Param to only accept View_Interface instances
	 *
	 * @param View_Interface $view Which view we are using this template on.
	 */
	public function set_view( $view ) {
		$this->view = $view;
	}

	/**
	 * Returns the current template view, either set in the constructor or using the `set_view` method.
	 *
	 * @since 4.9.4 Modified the Param to only accept View_Interface instances
	 *
	 * @return View_Interface The current template view.
	 */
	public function get_view() {
		return $this->view;
	}

	/**
	 * Returns the current template view slug.
	 *
	 * @since 6.0.7
	 *
	 * @return string The view slug.
	 */
	public function get_view_slug() {
		$view = $this->get_view();

		return $view::get_view_slug();
	}

	/**
	 * Returns the current template context.
	 *
	 * @since 5.0.0
	 *
	 * @return \Tribe__Context The template context instance, or the global context if no context is set.
	 */
	public function get_context() {
		return $this->context instanceof \Tribe__Context ? $this->context : tribe_context();
	}
}
