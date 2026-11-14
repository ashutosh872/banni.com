<?php
/**
 * Main Index Template - Kurtis Boutique
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 50px 0 80px;">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="product-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div><?php the_excerpt(); ?></div>
					</article>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
