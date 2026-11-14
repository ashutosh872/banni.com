<?php
/**
 * Standard Page Template - Kurtis Boutique
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 50px 0 80px;">
	<div class="container" style="max-width: 900px;">
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="heading-section" style="text-align: center; margin-bottom: 30px;"><?php the_title(); ?></h1>
			<div class="page-content" style="font-size: 1rem; line-height: 1.8; color: var(--color-text-main);">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
