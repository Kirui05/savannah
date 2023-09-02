<?php
	$user_info = wp_get_current_user();

	if($user_info->ID > 0){
		  
		$check_role = BABE_My_account::validate_role($user_info); 
		 
		if ($check_role){
			echo '<div id="my_account_page_wrapper">';
				$nav_arr = BABE_My_account::get_nav_arr($check_role);
				$current_nav_slug_arr = BABE_My_account::get_current_nav_slug($nav_arr);
				$current_nav_slug = key($current_nav_slug_arr);
		 
				echo '<div class="my_account_page_nav_wrapper">';
		 
					echo '<input type="text" class="my_account_page_nav_selector" name="' . esc_attr($current_nav_slug) . '_label" value="'. esc_attr($current_nav_slug_arr[$current_nav_slug]) . '">';
						echo '<i class="fas fa-chevron-down my_account_page_nav_selector_i"></i>';
						echo '<div class="my_account_page_nav_list">';     
							echo BABE_My_account::get_nav_html($nav_arr, $current_nav_slug);
						echo '</div>';
					echo '</div>';
		 
					echo '<div class="my_account_page_content_wrapper">';
						echo '<div class="my_account-content-inner">';

							if(isset($_GET['inner_page']) && $_GET['inner_page'] == 'posts-wishlist'){ 
								do_action('tevily_get_all_posts_wishlist');
							}else{
								echo apply_filters('babe_myaccount_page_content_' . $check_role, '', $user_info );
							}

						echo '</div>';
					echo '</div>';
		 
				echo '</div>';
		 
		 } //// end if ($check_role)
		 
	}else{
		  
		if (isset($_GET['action']) && $_GET['action'] == 'lostpassword'){
			echo '<div class="my_account_page_content_wrapper login-register-page">';
				echo '<div class="z-login-form">';
					echo '<div class="form-content">';
						echo BABE_My_account::get_lostpassword_form();
					echo '</div>';   
				echo '</div>';   
			echo '</div>';
		}else{
			
			echo '<div class="my_account_page_content_wrapper login-register-page">';

				if(isset($_GET['action']) && $_GET['action'] == 'register'){
					
					$html = BABE_My_account::get_register_form();
					$html = str_replace('modal fade', 'registration-wrapper', $html);
					$html = str_replace('modal-dialog modal-dialog-centered modal-lg', '', $html);
					$html = str_replace('modal-body', 'form-content', $html);
					$html = str_replace('modal-content', 'form-content-inner', $html);

					if(!get_option( 'users_can_register' )){
						$html = '<div class="alert alert-info">' . esc_html__('Website does not allow register', 'tevily') . '</div>';
					}
					echo '<div class="container">';
						echo '<div class="z-register-form">';
							echo '<div class="row">';
								
								echo '
									<div class="col-12 col-md-5 register-content-left">
										<span class="img-register">
											<img src="' . TEVILY_THEME_URL . '/assets/images/register.png '. '" alt="' . esc_attr__('Register', 'tevily') . '">
										</span>
										<div class="content-inner">
											<div class="quick-login">
												<span class="text">' . esc_html__('Already a member', 'tevily') . '</span>
												<a class="btn-theme btn-small login-link" href="#" data-bs-toggle="modal" data-bs-target="#form-ajax-login-popup">
													' . esc_html__('Login', 'tevily') . '             
												</a>
											</div>
										</div>
									</div>
								';

								echo '
									<div class="col-12 col-md-7 register-form-content">
										<h3 class="title">' . esc_html__('Create a free account', 'tevily') . '</h3>
										<div class="desc"> ' . esc_html__('A few clicks away from creating your account', 'tevily') . '</div>
										' . html_entity_decode($html) . '
									</div>                   
								'; 

							echo '</div>';   
						echo '</div>';   
					echo '</div>';   

				}else{
					echo '<div class="z-login-form">';
						echo '<div class="form-content">';
							echo BABE_My_account::get_login_form();
							echo '<div class="user-registration">';
								echo esc_html__('Do not have an account', 'tevily');
								echo '<a class="quick-login-link" href="#" data-bs-toggle="modal" data-bs-target="#form-ajax-login-popup">' . esc_html__('Register', 'tevily') . '</a>';
							echo '</div>';
						echo '</div>';   
					echo '</div>';   
				}

			echo '</div>';
		}
		  
	 } //// end if ($user_info->ID > 0)
	 
