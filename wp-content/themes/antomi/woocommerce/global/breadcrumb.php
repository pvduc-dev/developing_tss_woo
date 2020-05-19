<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php $delimiter = '<span class="separator">/</span>'; ?>
<?php if ( $breadcrumb ) : ?>

	<?php echo wp_kses($wrap_before, array( 
		'nav' => array(
			'class' => array(),
		),
	));  ?>

	<?php foreach ( $breadcrumb as $key => $crumb ) : ?>

		<?php echo esc_html($before); ?>

		<?php if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) : ?>
			<?php echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>'; ?>
		<?php else : ?>
			<?php echo esc_html( $crumb[0] ); ?>
		<?php endif; ?>

		<?php echo esc_html($after); ?>

		<?php if ( sizeof( $breadcrumb ) !== $key + 1 ) : ?>
			<?php echo wp_kses($delimiter, array( 
				'span' => array(
					'class' => array(),
				),
			)); ?>
		<?php endif; ?>

	<?php endforeach; ?>

	<?php echo wp_kses($wrap_after, array( 
		'nav' => array(
			'class' => array(),
		),
	));  ?> 

<?php endif; ?>