<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
get_header(); 

$class_main = 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12';
if(is_active_sidebar('woocommerce_single_sidebar')){ 
  $class_main = 'col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12';
}

?>

<section id="wp-main-content" class="clearfix main-page">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	 
	<div class="container">	
		<div class="main-page-content row">
			<div class="content-page <?php echo esc_attr($class_main); ?>">      
				<?php while ( have_posts() ) : the_post(); ?>
					<?php wc_get_template_part( 'content', 'single-product' ); ?>
				<?php endwhile; // end of the loop. ?>
			</div>   

			<?php if(is_active_sidebar('default_sidebar')){ ?>
				<div class="sidebar wp-sidebar sidebar-left col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
          		<div class="sidebar-inner">
            		<?php dynamic_sidebar('woocommerce_single_sidebar'); ?>
          		</div>
       		</div>   
       	<?php } ?>	

		</div>   
	</div>

	 <?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	 ?>

	 <div class="related-section">
		<div class="container">
		  <?php woocommerce_output_related_products() ?>
		</div>
	 </div>
</section>

<?php get_footer(); ?>