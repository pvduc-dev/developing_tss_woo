<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $woocommerce_loop;
$antomi_opt = get_option( 'antomi_opt' );
$antomi_viewmode = Antomi_Class::antomi_show_view_mode();
// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;
// Extra post classes
$classes = array();
$count   = $product->get_rating_count();
$antomi_shopclass = Antomi_Class::antomi_shop_class('');
$colwidth = 3;
if($antomi_shopclass=='shop-fullwidth') {
	if(isset($antomi_opt['product_per_row_fw'])){
		$woocommerce_loop['columns'] = $antomi_opt['product_per_row_fw'];
		if($woocommerce_loop['columns'] > 0){
			$colwidth = round(12/$woocommerce_loop['columns']);
		}
	}
	$classes[] = ' item-col col-6 col-md-4 col-xl-'.$colwidth ;
} else {
	if(isset($antomi_opt['product_per_row'])){
		$woocommerce_loop['columns'] = $antomi_opt['product_per_row'];
		if($woocommerce_loop['columns'] > 0){
			$colwidth = round(12/$woocommerce_loop['columns']);
		}
	}
	$classes[] = ' item-col col-6 col-sm-6 col-md-4 col-xl-'.$colwidth ;
}
$colwidth_over1500 = 3;
if($antomi_shopclass=='shop-fullwidth') {
	if(isset($antomi_opt['product_per_row_fw_over1500'])){
		$woocommerce_loop['columns_over1500'] = $antomi_opt['product_per_row_fw_over1500'];
		if($woocommerce_loop['columns_over1500'] > 0){
			$colwidth_over1500 = 'col-over-1500 col-over1500-'.$antomi_opt['product_per_row_fw_over1500'];
		}
		$classes[] = $colwidth_over1500 ;
	}
} else {
	if(isset($antomi_opt['product_per_row_over1500'])){
		$woocommerce_loop['columns_over1500'] = $antomi_opt['product_per_row_over1500'];
		if($woocommerce_loop['columns_over1500'] > 0){
			$colwidth_over1500 = 'col-over-1500 col-over1500-'.$antomi_opt['product_per_row_over1500'];
		}
		$classes[] = $colwidth_over1500 ;
	}
}
?>
<div <?php post_class( $classes ); ?>>
	<div class="product-wrapper gridview">
		<div class="list-col4">
			<div class="product-image">
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<?php 
					echo wp_kses($product->get_image('shop_catalog', array('class'=>'primary_image')), array(
						'a'=>array(
							'href'=>array(),
							'title'=>array(),
							'class'=>array(),
						),
						'img'=>array(
							'src'=>array(),
							'height'=>array(),
							'width'=>array(),
							'class'=>array(),
							'alt'=>array(),
						)
					));
					if(isset($antomi_opt['second_image'])){
						if($antomi_opt['second_image']){
							$attachment_ids = $product->get_gallery_image_ids();
							if ( $attachment_ids ) {
								echo wp_get_attachment_image( $attachment_ids[0], apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), false, array('class'=>'secondary_image') );
							}
						}
					}
				?>
				<?php if ( $product->is_on_sale() ) : ?>
					<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale"><span class="sale-text">' . esc_html__( 'Sale', 'antomi' ) . '</span></span>', $post, $product ); ?>
				<?php endif; ?>
				<!-- end sale label -->
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
			<ul class="actions">
				<?php if ( class_exists( 'YITH_WCWL' ) ) { ?>
					<li class="add-to-wishlist"> 
						<?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')); ?>
					</li>
				<?php } ?>				
				<?php if ( $antomi_opt['quickview'] == null || $antomi_opt['quickview'] != false ) { ?>
					<li class="quickviewbtn">
						<a class="detail-link quickview fa fa-external-link" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Xem nhanh</a>
					</li>
				<?php } ?>
			</ul>
		</div>
		<div class="list-col8">
			<div class="product-info">
				<div class="product-name">
					<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<?php if ($count) { ?>
					<div class="product-ratings">
						<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
					</div>
				<?php } ?>
				<!-- hook rating -->
				<?php if ( $product->get_price() != '' )  { ?>
					<div class="price-box">
						<div class="price-box-inner">
							<?php echo wp_kses($product->get_price_html(), array( 
								'span' => array(
									'class' => array(),
								),
								'del' => array(),
								'ins' => array(),
							)); ?>
						</div>
					</div>
				<?php } ?>
				<!-- end price -->
				<div class="count-down">
					<?php
					$countdown = false;
					$sale_end = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
					/* simple product */
					if($sale_end){
						$countdown = true;
						$sale_end = date('Y/m/d', (int)$sale_end);
						?>
						<p class="count-down-text">
							<strong><?php esc_html_e('Hurry Up!', 'antomi') ?></strong>
							<?php esc_html_e('Offers ends in:', 'antomi') ?>
						</p>
						<div class="countbox hastime" data-time="<?php echo esc_attr($sale_end); ?>"></div>
					<?php } ?>
					<?php /* variable product */
					if($product->has_child()){
						$vsale_end = array();
						$pvariables = $product->get_children();
						foreach($pvariables as $pvariable){
							$vsale_end[] = (int)get_post_meta( $pvariable, '_sale_price_dates_to', true );
							if( get_post_meta( $pvariable, '_sale_price_dates_to', true ) ){
								$countdown = true;
							}
						}
						if($countdown){
							/* get the latest time */
							$vsale_end_date = max($vsale_end);
							$vsale_end_date = date('Y/m/d', $vsale_end_date);
							?>
							<p class="count-down-text">
								<strong><?php esc_html_e('Hurry Up!', 'antomi') ?></strong>
								<?php esc_html_e('Offers ends in:', 'antomi') ?>
							</p>
							<div class="countbox hastime" data-time="<?php echo esc_attr($vsale_end_date); ?>"></div>
						<?php
						}
					}
					?>
				</div>
				<div class="add-to-cart">
					<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'"]') ?>
				</div>
			</div>
		</div>
	</div>
	<div class="product-wrapper listview">
		<div class="list-col4 <?php if($antomi_viewmode=='list-view'){ echo ' col-12 col-md-3';} ?>">
			<div class="product-image">
				<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
				<?php 
					echo wp_kses($product->get_image('shop_catalog', array('class'=>'primary_image')), array(
						'a'=>array(
							'href'=>array(),
							'title'=>array(),
							'class'=>array(),
						),
						'img'=>array(
							'src'=>array(),
							'height'=>array(),
							'width'=>array(),
							'class'=>array(),
							'alt'=>array(),
						)
					));
					if(isset($antomi_opt['second_image'])){
						if($antomi_opt['second_image']){
							$attachment_ids = $product->get_gallery_image_ids();
							if ( $attachment_ids ) {
								echo wp_get_attachment_image( $attachment_ids[0], apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), false, array('class'=>'secondary_image') );
							}
						}
					}
				?>
				<?php if ( $product->is_on_sale() ) : ?>
					<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale"><span class="sale-text">' . esc_html__( 'Sale', 'antomi' ) . '</span></span>', $post, $product ); ?>
				<?php endif; ?>
				<!-- end sale label -->
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
		</div>
		<div class="list-col8 <?php if($antomi_viewmode=='list-view'){ echo ' col-12 col-md-9';} ?>">
			<div class="products-list-text">
				<div class="product-name">
					<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<?php if ($count) { ?>
					<div class="star-rating">
						<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
					</div>
				<?php } ?>
				<!-- hook rating -->
				<?php if ( $product->get_price() != '' )  { ?>
					<div class="price-box">
						<div class="price-box-inner">
							<?php echo wp_kses($product->get_price_html(), array( 
								'span' => array(
									'class' => array(),
								),
								'del' => array(),
								'ins' => array(),
							)); ?>
						</div>
					</div>
				<?php } ?>
				<!-- end price -->
				<?php if ( has_excerpt() ) { ?>
					<div class="product-desc">
						<?php the_excerpt(); ?>
					</div>
				<?php } ?>
			</div>
			<div class="product-buttons">
				<div class="product-buttons-inner">
					<div class="add-to-cart">
						<?php echo do_shortcode('[add_to_cart id="'.$product->get_id().'"]') ?>
					</div>
					<ul class="actions">
						<?php if ( class_exists( 'YITH_WCWL' ) ) { ?>
							<li class="add-to-wishlist"> 
								<?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')); ?>
							</li>
						<?php } ?>						
						<?php if ( $antomi_opt['quickview'] == null || $antomi_opt['quickview'] != false ) { ?>
							<li class="quickviewbtn">
								<a class="detail-link quickview fa fa-external-link" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">Xem nhanh</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>