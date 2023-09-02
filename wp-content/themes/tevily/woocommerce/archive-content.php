<?php
   $classes = 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12';
   if(is_active_sidebar('woocommerce_sidebar')){ 
      $classes = 'col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12';
   }

   if(!is_shop()){
      do_action( 'tevily_woocommerce_breacrumb' );
   }

?>

<div class="<?php echo(is_shop() ? 'container-shop' : 'container') ?>"> 
   <div class="woo-archive-content">
      <div class="row">

         <div class="<?php echo esc_attr($classes) ?>">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
               <h1 class="page-title hidden"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>

            <?php do_action( 'woocommerce_archive_description' ); ?>

            <?php woocommerce_product_subcategories(); ?>  

            <?php if ( have_posts() ) : ?>
            <div class="shop-loop-container">
               <div class="gvawooaf-before-products layout-grid">
                  
                  <div class="woocommerce-filter clearfix">
                     <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                  </div> 

                  <?php do_action('tevily_woocommerce_active_filter' );  ?>
                  
                  <?php 
                     woocommerce_product_loop_start();
                     while ( have_posts() ) : the_post();
                        wc_get_template_part( 'content', 'product' );
                     endwhile; 
                     woocommerce_product_loop_end();
                  ?>
                        
                  <?php do_action( 'woocommerce_after_shop_loop' ); ?> 
               </div>
            </div>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
               <?php wc_get_template( 'loop/no-products-found.php' ); ?>
            <?php endif; ?>
         </div>

         <?php if(is_active_sidebar('woocommerce_sidebar')){ ?>
            <div class="sidebar wp-sidebar sidebar-right col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
               <div class="sidebar-inner">
                  <?php dynamic_sidebar('woocommerce_sidebar'); ?>
               </div>
            </div>
         <?php } ?>

      </div>
   </div>   
</div>   
   