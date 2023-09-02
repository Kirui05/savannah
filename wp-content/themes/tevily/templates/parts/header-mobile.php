<?php 
	$tevily_options = tevily_get_options();
?>

<div class="header-mobile header_mobile_screen">
  	
  	<?php if(tevily_get_option('hm_show_topbar') == 'yes'){ ?>

		<div class="topbar-mobile">
			<div class="row">
				
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 topbar-left">

					<ul class="socials-2">
					   <?php if(tevily_get_option('hm_social_facebook', '')){ ?>
					     <li><a href="<?php echo esc_url(tevily_get_option('hm_social_facebook', '')); ?>"><i class="fab fa-facebook-square"></i></a></li>
					   <?php } ?> 

					   <?php if(tevily_get_option('hm_social_instagram', '')){ ?>
					     <li><a href="<?php echo esc_url(tevily_get_option('hm_social_instagram', '')); ?>"><i class="fab fa-instagram"></i></a></li>
					   <?php } ?>  

					   <?php if(tevily_get_option('hm_social_twitter', '')){ ?>
					     <li><a href="<?php echo esc_url(tevily_get_option('hm_social_twitter', '')); ?>"><i class="fab fa-twitter"></i></a></li>
					   <?php } ?>  

					   <?php if(tevily_get_option('hm_social_linkedin', '')){ ?>
					     <li><a href="<?php echo esc_url(tevily_get_option('hm_social_linkedin', '')); ?>"><i class="fab fa-linkedin"></i></a></li>
					   <?php } ?> 

					   <?php if(tevily_get_option('hm_social_pinterest', '')){ ?>
					     <li><a href="<?php echo esc_url(tevily_get_option('hm_social_pinterest', '')); ?>"><i class="fab fa-pinterest"></i></a></li>
					   <?php } ?> 
				
					   <?php if(tevily_get_option('hm_social_tumblr', '')){ ?>
					     <li><a href="<?php echo esc_url(tevily_get_option('hm_social_tumblr', '')); ?>"><i class="fab fa-tumblr-square"></i></a></li>
					   <?php } ?>

					   <?php if(tevily_get_option('hm_social_vimeo', '')){ ?>
					     <li><a href="<?php echo esc_url(tevily_get_option('hm_social_vimeo', '')); ?>"><i class="fab fa-vimeo"></i></a></li>
					   <?php } ?>

					    <?php if(tevily_get_option('hm_social_youtube', '')){ ?>
					     <li><a href="<?php echo esc_url(tevily_get_option('hm_social_youtube', '')); ?>"><i class="fab fa-youtube-square"></i></a></li>
					   <?php } ?>
					</ul>

				</div>

				<?php if(tevily_get_option('hm_topbar_information', '')){ ?>
					<div class="col-12 col-xl-8 col-lg-8 col-md-8 col-sm-8 d-none d-xl-block d-lg-block d-md-block d-sm-block topbar-right">
						<div class="content-inner topbar-information">
							<?php echo html_entity_decode(tevily_get_option('hm_topbar_information')) ?>
						</div>
					</div>
				<?php } ?>
				
			</div>
		</div>

	<?php } ?>	

  	<div class="header-mobile-content">
		<div class="header-content-inner clearfix"> 
		 
		  	<div class="header-left">
				<div class="logo-mobile">
					<?php $logo_mobile = (isset($tevily_options['hm_logo']['url']) && $tevily_options['hm_logo']['url']) ? $tevily_options['hm_logo']['url'] : get_template_directory_uri().'/assets/images/logo-mobile.png' ; ?>
				  	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					 	<img src="<?php echo esc_url($logo_mobile); ?>" alt="<?php bloginfo( 'name' ); ?>" />
				  	</a>
				</div>
		  	</div>

		  	<div class="header-right">
		  		<?php if(class_exists('BABE_My_account')){ ?>
					<div class="gva-user">
						<?php if(is_user_logged_in()){
					     
				         $user_id = get_current_user_id();
				         $user_info = wp_get_current_user();
				         $menu_html = '';

				         if($user_info->ID > 0){

				            $check_role = BABE_My_account::validate_role($user_info);
				            $nav_arr = BABE_My_account::get_nav_arr($check_role);
				            $nav_activity = isset($nav_arr['activity']) ? $nav_arr['activity'] : false;
				            
				            if(isset($nav_arr['activity']['title'])){ 
				               $nav_arr['activity']['title'] = ''; 
				            }
				            if(isset($nav_arr['post_to_book']['title'])){ 
				               $nav_arr['post_to_book']['title'] = ''; 
				            }
				            if(isset($nav_arr['profile']['title'])){ 
				               $nav_arr['profile']['title'] = ''; 
				            }
				            $user_nav = array();

				            if(isset($nav_arr['dashboard'])){ 
				               $user_nav['dashboard'] = $nav_arr['dashboard'];
				            }

				            if(isset($nav_arr['post_to_book'])){ 
				               $user_nav['post_to_book'] = array(
				                  'title'              => '',
				                  'new-post-to_book'   => $nav_arr['post_to_book']['new-post-to_book'],
				                  'all-posts-to_book'  => $nav_arr['post_to_book']['all-posts-to_book']
				               );
				            }

				            if(isset($nav_arr['activity'])){ 
				               $user_nav_2['activity'] = $nav_arr['activity'];
				            }

				            if(isset($nav_arr['profile'])){ 
				               $user_nav_2['profile'] = $nav_arr['profile'];
				            }

				            if(isset($nav_arr['logout'])){ 
				               $user_nav_2['logout'] = $nav_arr['logout'];
				            }

				            $menu_html .= '<div class="my_account_nav">';
				               
				               $menu_html .= '<div class="hi-account">' . esc_html__('Hi, ', 'tevily') . $user_info->display_name . '</div>';

				               $menu_html .= BABE_My_account::get_nav_html($user_nav, '', 1);
				               $menu_html .= '
				                  <ul class="my_account_nav_list">
				                     <li class="my_account_nav_item my_account_nav_wishlist">
				                        <a href="' . BABE_Settings::get_my_account_page_url() . '?inner_page=posts-wishlist">
				                           <span class="my_account_nav_item_title">
				                              <i class="my_account_nav_item_icon lar la-heart"></i>'
				                              . esc_html__('Wishlist', 'tevily') . 
				                           '</span>
				                        </a>
				                     </li>
				                  </ul>
				               ';
				               $menu_html .= BABE_My_account::get_nav_html($user_nav_2, '', 1);
				            $menu_html .= '</div>';
				            
				         } //// end if ($check_role)
						   ?>
						   
					      <div class="login-account">
					         <div class="profile">
					            <div class="avata">
					               <?php  
					                  $user_avatar = get_avatar_url($user_id, array('size' => 90));;
					                  $avatar_url = !empty($user_avatar) ? $user_avatar : (get_template_directory_uri() . '/images/placehoder-user.jpg');
					               ?>
					               <img src="<?php echo esc_url($avatar_url) ?>" alt="<?php echo esc_attr($user_info->display_name) ?>">
					            </div>
					         </div>  
					         
					         <div class="user-account" >
					            <?php echo html_entity_decode($menu_html) ?>
					         </div> 

					      </div>

					   <?php }else{ ?>

					      <?php 
					         $register_link = home_url('/wp-login.php?action=register&redirect_to=' . get_permalink());
					         if(class_exists('BABE_Settings')){
					            $register_link = BABE_Settings::get_my_account_page_url() . '?action=register';
					         } 
					      ?>
					      <div class="login-account without-login">
					         <div class="profile">
					            <div class="avata-icon">
					               <i class="icon flaticon-user"></i>
					            </div>
					         </div>
					         <div class="user-account">
					            <ul class="my_account_nav_list">
					               <li>
					                  <a class="login-link" href="#" data-bs-toggle="modal" data-bs-target="#form-ajax-login-popup">
					                     <i class="icon far fa-user"></i>
					                     <?php echo esc_html__('Login', 'tevily') ?>
					                  </a>
					               </li>
					               <li>
					                  <a class="register-link" href="<?php echo esc_url($register_link) ?>">
					                     <i class="icon fas fa-user-plus"></i> 
					                     <?php echo esc_html__('Register', 'tevily') ?>
					                  </a>
					               </li>
					            </ul>
					         </div>
					      </div>

						<?php } ?>

					</div>
				<?php } ?>
			 	
				<?php get_template_part('templates/parts/canvas-mobile'); ?>

		  	</div>

		</div>  
  	</div>
</div>