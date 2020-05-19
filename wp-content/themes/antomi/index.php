<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Antomi_Theme
 * @since Antomi 1.0
 */
$antomi_opt = get_option( 'antomi_opt' );
get_header();
$antomi_bloglayout = 'blog-large';
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
			<div class="col-12 <?php echo 'col-lg-'.$antomi_blogcolclass; ?> <?php esc_attr($main_column_class); ?> <?php echo esc_attr($antomi_blog_main_extra_class);?>">
				<div class="page-content blog-page blogs <?php echo esc_attr($antomi_blogclass); ?>">
					<header class="entry-header">
						<h1 class="entry-title"><?php if(isset($antomi_opt['blog_header_text']) && ($antomi_opt['blog_header_text'] !='')) { echo esc_html($antomi_opt['blog_header_text']); } else { esc_html_e('Blog', 'antomi');}  ?></h1>
					</header>
					<div class="blog-wrapper">
						<?php if ( have_posts() ) : ?>
							<div class="post-container">
								<?php /* Start the Loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<?php get_template_part( 'content', get_post_format() ); ?>
								<?php endwhile; ?>
							</div>
							<?php Antomi_Class::antomi_pagination(); ?>
						<?php else : ?>
							<article id="post-0" class="post no-results not-found">
							<?php if ( current_user_can( 'edit_posts' ) ) :
								// Show a different message to a logged-in user who can add posts.
							?>
								<header class="entry-header">
									<h1 class="entry-title"><?php esc_html_e( 'No posts to display', 'antomi' ); ?></h1>
								</header>
								<div class="entry-content">
									<p><?php printf( wp_kses(__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'antomi' ), array('a'=>array('href'=>array()))), admin_url( 'post-new.php' ) ); ?></p>
								</div><!-- .entry-content -->
							<?php else :
								// Show the default message to everyone else.
							?>
								<header class="entry-header">
									<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'antomi' ); ?></h1>
								</header>
								<div class="entry-content">
									<p><?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'antomi' ); ?></p>
									<?php get_search_form(); ?>
								</div><!-- .entry-content -->
							<?php endif; // end current_user_can() check ?>
							</article><!-- #post-0 -->
						<?php endif; // end have_posts() check ?>
					</div>
				</div>
			</div>
			<?php if($antomi_bloglayout!='nosidebar' && is_active_sidebar('sidebar-1')): ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
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