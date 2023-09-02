<?php
/**
 * $Desc
 *
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2021 gaviasthemes. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */

	$primary_text = tevily_get_option('nfpage_primary_text', '');
	$title = tevily_get_option('nfpage_title', '');
	$desc = tevily_get_option('nfpage_desc', '');

	$btn_title = tevily_get_option('nfpage_btn_title', '');
	$btn_link = tevily_get_option('nfpage_btn_link', '');
	$btn_link = !empty($bth_title) ? $bth_title : home_url( '/' );
?>

<?php get_header(); ?>
<div id="content">
	<div class="page-wrapper">
		<div class="not-found-wrapper text-center">
			<div class="not-found-title">
				<h1>
					<?php echo ( !empty($primary_text) ? esc_html($primary_text) : esc_html__('404', 'tevily') ); ?>
				</h1>
			</div>

			<div class="not-found-subtitle">
				<?php echo ( !empty($title) ? esc_html($title) : esc_html__('Page Not Found', 'tevily') ); ?>
			</div>

			<div class="not-found-desc">
				<?php echo ( !empty($desc) ? esc_html($desc) : esc_html__('The page requested could not be found. This could be a spelling error in the URL or a removed page.', 'tevily') ); ?>
			</div> 

			<div class="not-found-home text-center">
				<a class="btn-theme" href="<?php echo esc_url($btn_link); ?>">
					<i class="far fa-arrow-alt-circle-left"></i>
					<?php echo ( !empty($btn_title) ? esc_html($btn_title) : esc_html__('Back Homepage', 'tevily') ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>