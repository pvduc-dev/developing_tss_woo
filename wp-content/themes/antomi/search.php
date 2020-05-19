<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Antomi_Theme
 * @since Antomi 1.0
 */
$antomi_opt = get_option( 'antomi_opt' );
get_header();
$antomi_bloglayout = 'grid';
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
$antomi_blog_main_extra_class = NULl;
if($antomi_blogsidebar=='left') {
	$antomi_blog_main_extra_class = 'order-lg-last';
}
$main_column_class = NULL;
switch($antomi_bloglayout) {
	case 'nosidebar':
		$antomi_blogclass = 'blog-nosidebar';
		$antomi_blogcolclass = 12;
		$antomi_blogsidebar = 'none';
		Antomi_Class::antomi_post_thumbnail_size('antomi-post-thumb');
		break;
	case 'largeimage':
		$antomi_blogclass = 'blog-large';
		$antomi_blogcolclass = 9;
		$main_column_class = 'main-column';
		Antomi_Class::antomi_post_thumbnail_size('antomi-post-thumbwide');
		break;
	case 'grid':
		$antomi_blogclass = 'grid';
		$antomi_blogcolclass = 9;
		$main_column_class = 'main-column';
		Antomi_Class::antomi_post_thumbnail_size('antomi-post-thumbwide');
		break;
	default:
		$antomi_blogclass = 'blog-sidebar';
		$antomi_blogcolclass = 9;
		$main_column_class = 'main-column';
		Antomi_Class::antomi_post_thumbnail_size('antomi-post-thumb');
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
			<div class="col-12 <?php echo 'col-lg-'.$antomi_blogcolclass; ?> <?php echo esc_attr($main_column_class); ?> <?php echo esc_attr($antomi_blog_main_extra_class);?>">
				<div class="page-content blog-page blogs <?php echo esc_attr($antomi_blogclass); if($antomi_blogsidebar=='left') {echo ' left-sidebar'; } if($antomi_blogsidebar=='right') {echo ' right-sidebar'; } ?>">
					<header class="entry-header">
						<h1 class="entry-title"><?php printf( wp_kses(__( 'Search Results for: %s', 'antomi' ), array('span'=>array())), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header>
					<div class="post-container">
						<?php if ( have_posts() ) : ?>
							
								<?php /* Start the Loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<?php get_template_part( 'content', get_post_format() ); ?>
								<?php endwhile; ?> 
							<?php Antomi_Class::antomi_pagination(); ?>
						<?php else : ?>
							<article id="post-0" class="post no-results not-found">
								<header class="entry-header">
									<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'antomi' ); ?></h1>
								</header>
								<div class="entry-content">
									<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'antomi' ); ?></p>
									<?php get_search_form(); ?>
								</div><!-- .entry-content -->
							</article><!-- #post-0 -->
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
	<!-- brand logo -->
	<?php 
		if(isset($antomi_opt['inner_brand']) && function_exists('antomi_brands_shortcode') && shortcode_exists( 'ourbrands' ) ){
			if($antomi_opt['inner_brand'] && isset($antomi_opt['brand_logos'][0]) && $antomi_opt['brand_logos'][0]['thumb']!=null) { ?>
				<div class="inner-brands">
					<div class="container">
						<?php if(isset($antomi_opt['inner_brand_title']) && $antomi_opt['inner_brand_title']!=''){ ?>
							<div class="heading-title style1 ">
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