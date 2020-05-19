<?php
/**
 * Template Name: Full Width
 *
 * Description: Full Width page template
 *
 * @package WordPress
 * @subpackage Antomi
 * @since Antomi 1.0
 */
$antomi_opt = get_option( 'antomi_opt' );
get_header();
?>
<div class="main-container full-width">
	<div class="breadcrumb-container">
		<div class="container">
			<?php Antomi_Class::antomi_breadcrumb(); ?>
		</div>
	</div>
	<div class="page-content">
		<div class="container">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; ?>
		</div> 
	</div>
</div>
<?php get_footer(); ?>