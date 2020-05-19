<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Antomi_Theme
 * @since Antomi 1.0
 */
$antomi_opt = get_option( 'antomi_opt' );
$antomi_blogsidebar = 'right';
if(isset($antomi_opt['sidebarblog_pos']) && $antomi_opt['sidebarblog_pos']!=''){
	$antomi_blogsidebar = $antomi_opt['sidebarblog_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$antomi_blogsidebar = $_GET['sidebar'];
}
$antomi_blog_sidebar_extra_class = NULl;
if($antomi_blogsidebar=='left') {
	$antomi_blog_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="col-12 col-lg-3 <?php echo esc_attr($antomi_blog_sidebar_extra_class);?>">
		<div class="sidebar-content">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div><!-- #secondary -->
<?php endif; ?>