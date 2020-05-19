<?php
/**
 * The sidebar for content page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Antomi_Theme
 * @since Antomi 1.0
 */
$antomi_opt = get_option( 'antomi_opt' );
$antomi_page_sidebar_extra_class = NULl;
if($antomi_opt['sidebarse_pos']=='left') {
	$antomi_page_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-page' ) ) : ?>
<div id="secondary" class="col-12 col-lg-3 <?php echo esc_attr($antomi_page_sidebar_extra_class);?>">
	<div class="sidebar-content">
		<?php dynamic_sidebar( 'sidebar-page' ); ?>
	</div>
</div>
<?php endif; ?>