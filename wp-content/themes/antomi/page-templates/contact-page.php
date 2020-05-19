<?php
/**
 * Template Name: Contact Template
 *
 * Description: Contact page template
 *
 * @package WordPress
 * @subpackage Antomi_Theme
 * @since Antomi 1.0
 */
$antomi_opt = get_option( 'antomi_opt' );

get_header();
?>
<div class="breadcrumb-container">
	<div class="container">
		<?php Antomi_Class::antomi_breadcrumb(); ?>
	</div>
</div>
<div class="main-container contact-page">
	<div class="page-content contact-container">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="container">
				<?php get_template_part( 'content', 'page' ); ?>
			</div>
		<?php endwhile; ?>
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
<?php get_footer('contact'); ?>