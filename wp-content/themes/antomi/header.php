<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Antomi
 * @since Antomi1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php $antomi_opt = get_option( 'antomi_opt' ); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
	<div class="page-wrapper">
		<?php 
			if(isset($antomi_opt['header_layout']) && $antomi_opt['header_layout']!=''){
				$header_class = strtolower($antomi_opt['header_layout']);
			} else {
				$header_class = '';
			} 
			if( (class_exists('RevSliderFront')) && (is_front_page() && has_shortcode( $post->post_content, 'rev_slider_vc')) ) {
				$hasSlider_class = 'rs-active';
			} else {
				$hasSlider_class = '';
			}
			if( isset($antomi_opt['header_mobile_layout']) && $antomi_opt['header_mobile_layout'] != "") {
				$hasMobileLayout_class = 'has-mobile-layout';
			} else {
				$hasMobileLayout_class = '';
			}
		?>
		<div class="header-container <?php echo esc_html($header_class)." ".esc_html($hasSlider_class) ." ".esc_html($hasMobileLayout_class) ?>">
			<div class="header">
				<div class="header-content">
					<?php
					if ( isset($antomi_opt['header_layout']) && $antomi_opt['header_layout'] != "") { 
						$jscomposer_templates_args = array(
							'orderby'          => 'title',
							'order'            => 'ASC',
							'post_type'        => 'templatera',
							'post_status'      => 'publish',
							'posts_per_page'   => 30,
						);
						$jscomposer_templates = get_posts( $jscomposer_templates_args );
						if(count($jscomposer_templates) > 0) {
							foreach($jscomposer_templates as $jscomposer_template){
								if($jscomposer_template->post_title == $antomi_opt['header_layout']){ ?>
									<div class="header-composer">
										<div class="container">
											<?php 
												echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
											?>
										</div>
									</div>
								<?php }
							}
						}
						// header mobile
						if ( isset($antomi_opt['header_mobile_layout']) && $antomi_opt['header_mobile_layout'] != "") {
							if(count($jscomposer_templates) > 0) {
								foreach($jscomposer_templates as $jscomposer_template){
									if($jscomposer_template->post_title == $antomi_opt['header_mobile_layout']){ ?>
										<div class="header-mobile">
											<div class="container">
												<?php 
													echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
												?>
											</div>
										</div>
									<?php }
								}
							}
						}
						// header mobile
						if ( isset($antomi_opt['sticky_header']) && $antomi_opt['sticky_header']) {
							if(count($jscomposer_templates) > 0) {
								foreach($jscomposer_templates as $jscomposer_template){
									if($jscomposer_template->post_title == $antomi_opt['header_sticky_layout']){ ?>
										<div class="header-sticky <?php if ( is_admin_bar_showing() ) {echo 'with-admin-bar';} ?>">
											<div class="container">
												<?php 
													echo do_shortcode(apply_filters( 'the_content', $jscomposer_template->post_content ));
												?>
											</div>
										</div>
									<?php }
								}
							}
						}
					} else { ?>
						<div class="header-default">
							<div class="logo-row">
								<div class="container">
									<div class="row">
										<div class="col-8 col-lg-5 col-xl-4">
											<?php if( isset($antomi_opt['logo_main']['url']) && $antomi_opt['logo_main']['url']!=''){ ?>
												<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url($antomi_opt['logo_main']['url']); ?>" alt=" <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?> " /></a></div>
											<?php } else { ?>
												<h1 class="logo site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
												<?php } ?>
										</div>
										<div class="col-4 col-lg-7 col-xl-8">
											<div class="header-right">
												<?php if ( has_nav_menu( 'mobilemenu' ) ) : ?>
													<div class="visible-small mobile-menu style1"> 
														<div class="mbmenu-toggler"></div>
														<div class="clearfix"></div>
														<div class="mobile-menu-content">
															<div class="mobile-menu-inner">
																<?php wp_nav_menu( array( 'theme_location' => 'mobilemenu', 'container_class' => 'mobile-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
																<button class="mobile-close"><i class="fa fa-times" aria-hidden="true"></i></button>
															</div>
														</div>
													</div>
												<?php endif; ?>
												<div class="header-search visible-large">
													<div class="search-without-dropdown">
														<?php get_search_form(); ?>
													</div>
												</div>
												<div class="header-search visible-small">
													<div class="search-dropdown">
														<?php get_search_form(); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="main-menu-row">
								<div class="container">
									<div class="main-menu-wrapper">
										<?php if ( has_nav_menu( 'primary' ) ) : ?>
											<div class="horizontal-menu visible-large">
												<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'primary-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
											</div>
										<?php endif; ?>
									</div> 
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>