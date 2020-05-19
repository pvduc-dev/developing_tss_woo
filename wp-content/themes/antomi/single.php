<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Antomi_Theme
 * @since Antomi 1.0
 */
$antomi_opt = get_option( 'antomi_opt' );
get_header();
$antomi_bloglayout = 'sidebar';
if(isset($antomi_opt['blog_layout']) && $antomi_opt['blog_layout']!=''){
	$antomi_bloglayout = $antomi_opt['blog_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$antomi_bloglayout = $_GET['layout'];
}
$antomi_blogsidebar = 'right';
if(isset($antomi_opt['sidebarblog_pos']) && $antomi_opt['sidebarblog_pos']!=''){
	$antomi_blogsidebar = $antomi_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$antomi_blogsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-1' ) )  {
	$antomi_bloglayout = 'nosidebar';
}
switch($antomi_bloglayout) {
	case 'nosidebar':
		$antomi_blogclass = 'blog-nosidebar';
		$antomi_blogcolclass = 12;
		$antomi_blogsidebar = 'none';
		break;
	default:
		$antomi_blogclass = 'blog-sidebar'; 
		$antomi_blogcolclass = 9;
}
?>
<div class="breadcrumb-container">
	<div class="container">
		<?php Antomi_Class::antomi_breadcrumb(); ?>
	</div>
</div>
<div class="main-container <?php if(isset($antomi_opt['blog_banner']['url']) && ($antomi_opt['blog_banner']['url'])!=''){ echo 'has-image';} ?>">
	<div class="container">
		<div class="row">
			<div class="col-12 <?php echo 'col-lg-'.$antomi_blogcolclass; ?>">
				<div class="page-content blog-page single <?php echo esc_attr($antomi_blogclass); if($antomi_blogsidebar=='left') {echo ' left-sidebar'; } if($antomi_blogsidebar=='right') {echo ' right-sidebar'; } ?> ">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php
			$customsidebar = get_post_meta( $post->ID, '_antomi_custom_sidebar', true );
			$customsidebar_pos = get_post_meta( $post->ID, '_antomi_custom_sidebar_pos', true );
			if($customsidebar != ''){
				if($customsidebar_pos == 'left' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3 order-lg-last">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				if($antomi_blogsidebar=='left') {
					get_sidebar();
				}
			} ?>
			<?php
			if($customsidebar != ''){
				if($customsidebar_pos == 'right' && is_active_sidebar( $customsidebar ) ) {
					echo '<div id="secondary" class="col-12 col-lg-3">';
						dynamic_sidebar( $customsidebar );
					echo '</div>';
				} 
			} else {
				if($antomi_blogsidebar=='right') {
					get_sidebar();
				}
			} ?>
		</div>
	</div> 
	<!-- brand logo -->
	<?php 
		if(isset($antomi_opt['inner_brand']) && function_exists('antomi_brands_shortcode') && shortcode_exists( 'ourbrands' ) ){
			if($antomi_opt['inner_brand'] && isset($antomi_opt['brand_logos'][0]) && $antomi_opt['brand_logos'][0]['thumb']!=null) { ?>
				<div class="inner-brands">
					<div class="container">
						<?php if(isset($antomi_opt['inner_brand_title']) && $antomi_opt['inner_brand_title']!=''){ ?>
							<div class="title">
								<h3><?php echo esc_html( $antomi_opt['inner_brand_title'] ); ?></h3>
							</div>
						<?php } ?>
						<?php echo do_shortcode('[ourbrands]'); ?>
					</div>
				</div>
			<?php }
		}
	?>
	<!-- end brand logo --> 
</div>
<?php get_footer(); ?>