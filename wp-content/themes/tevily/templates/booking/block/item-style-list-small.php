<?php
$thumbnail = isset($settings['image_size']) && $settings['image_size'] ? $settings['image_size'] : 'medium';
$post_id =  isset($post_item->ID) && $post_item->ID ? $post_item->ID : $post['ID'];
$ba_post = BABE_Post_types::get_post($post_id);
$url     = BABE_Functions::get_page_url_with_args($post_id, $_GET);
$image   = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $thumbnail);
if ( !isset($ba_post['discount_price_from']) || !isset($ba_post['price_from']) || !isset($ba_post['discount_date_to']) || !isset($ba_post['discount']) ) {
   $prices = BABE_Post_types::get_post_price_from($post_id);
} else {
   $prices = $ba_post;
}
?>

<div class="booking-block-list-small">
	<div class="babe-block-content">
		<div class="post-image">
			<?php if(has_post_thumbnail($post_id)){ ?>
				<a class="post-link" href="<?php echo esc_url($url) ?>">
					<img src="<?php echo esc_url($image[0]) ?>" alt="<?php echo esc_attr( $ba_post['post_title'] ) ?>">
				</a>
			<?php } ?>   
		</div>

		  <div class="booking-content">
				<div class="content-inner">
					<?php echo BABE_Rating::post_stars_rendering( $post_id ); ?>
					<h3 class="title">
						<a href="<?php echo esc_url( $url ); ?>"><?php echo apply_filters( 'translate_text', $ba_post['post_title'] ); ?></a>
					</h3>
					<div class="ba-price">
						<label><?php echo esc_html__('From', 'tevily'); ?></label>
						<span class="item_info_price_new"><?php echo BABE_Currency::get_currency_price($prices['discount_price_from']); ?></span>
						<?php if($prices['discount_price_from'] < $prices['price_from']){ ?>
                     <span class="item_info_price_old"><?php echo BABE_Currency::get_currency_price($prices['price_from'])  ?></span>
                  <?php } ?>
					</div>
				</div>   
		  </div>

	 </div>
</div>