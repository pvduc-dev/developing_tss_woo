<?php
/**
 * The sidebar for shop page
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Antomi_Theme
 * @since Antomi 1.0
 */
$antomi_opt = get_option( 'antomi_opt' );
$shopsidebar = 'left';
if(isset($antomi_opt['sidebarshop_pos']) && $antomi_opt['sidebarshop_pos']!=''){
	$shopsidebar = $antomi_opt['sidebarshop_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$shopsidebar = $_GET['sidebar'];
}
$antomi_shop_sidebar_extra_class = NULl;
if($shopsidebar=='left') {
	$antomi_shop_sidebar_extra_class = 'order-lg-first';
}
?>
<?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
	<div id="secondary" class="col-12 col-lg-3 sidebar-shop <?php echo esc_attr($antomi_shop_sidebar_extra_class);?>">
		<div class="sidebar-content">
			<?php dynamic_sidebar( 'sidebar-shop' ); ?>
		</div>
	</div>
<?php endif; ?>