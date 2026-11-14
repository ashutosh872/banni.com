<?php
/**
 * Search Results Template - Saaj of Banni
 * Displays WooCommerce products matching search queries.
 */

get_header();

$search_query = get_search_query();
global $wp_query;
$total_results = $wp_query->found_posts;
?>

<main id="primary" class="site-main" style="padding: 40px 0 90px; min-height: 60vh;">
	<div class="container">

		<!-- Breadcrumb & Eyebrow -->
		<div style="text-align: center; margin-bottom: 28px;">
			<div class="heading-eyebrow" style="color: var(--color-primary); letter-spacing: 0.15em; font-size: 0.8125rem;">
				<?php _e( 'SEARCH RESULTS', 'kurtis-boutique' ); ?>
			</div>
			<h1 class="heading-section" style="margin-bottom: 8px;">
				<?php printf( esc_html__( 'Search: "%s"', 'kurtis-boutique' ), esc_html( $search_query ) ); ?>
			</h1>
			<p style="color: var(--color-text-muted); font-size: 0.9375rem;">
				<?php
				if ( $total_results === 1 ) {
					echo 'Found <strong>1</strong> handcrafted kurti matching your query';
				} elseif ( $total_results > 1 ) {
					printf( 'Found <strong>%d</strong> handcrafted kurtis matching your query', $total_results );
				} else {
					echo 'No direct matches found';
				}
				?>
			</p>
		</div>

		<!-- Quick Search Refine Bar -->
		<div style="max-width: 560px; margin: 0 auto 40px;">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display: flex; gap: 8px;">
				<input type="hidden" name="post_type" value="product">
				<input type="search" class="footer-input" name="s" value="<?php echo esc_attr( $search_query ); ?>" placeholder="Search cotton, corset, square neck..." required style="padding: 12px 18px; font-size: 0.9375rem; border: 1.5px solid var(--color-border); border-radius: var(--radius-sm);">
				<button type="submit" class="footer-btn-sub" style="padding: 0 24px; font-weight: 700; border-radius: var(--radius-sm);"><?php _e( 'Search', 'kurtis-boutique' ); ?></button>
			</form>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="product-grid">
				<?php
				$badge_index = 0;
				$badges = array( 'POPULAR', 'NEW IN', 'BEST SELLER', 'TRENDING', 'HOT PICK' );
				while ( have_posts() ) : the_post();
					global $product;
					if ( ! $product ) {
						$product = wc_get_product( get_the_ID() );
					}
					if ( ! $product ) continue;
					$badge_label = $badges[ $badge_index % count( $badges ) ];
					$badge_index++;
					?>
					<div class="kurtis-card">
						<div class="kurtis-card-media">
							<span class="card-badge <?php echo $badge_index === 1 ? 'badge-new' : ''; ?>"><?php echo esc_html( $badge_label ); ?></span>
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'kurtis-card-img' ) ); ?>
								<?php else : ?>
									<img src="https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=600&q=80" class="kurtis-card-img" alt="<?php the_title_attribute(); ?>">
								<?php endif; ?>
							</a>
							<button type="button" class="card-quick-add ajax-add-to-cart-quick" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>" data-size="M" aria-label="Quick Add to Bag">
								<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
							</button>
						</div>
						<div class="kurtis-card-info">
							<h3 class="kurtis-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="kurtis-price-wrap">
								<span class="kurtis-price-current"><?php echo wc_price( $product->get_price() ); ?></span>
								<?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
									<span class="kurtis-price-old"><?php echo wc_price( $product->get_regular_price() ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<div style="margin-top: 48px; text-align: center;">
				<?php
				the_posts_pagination( array(
					'prev_text' => __( '← Previous', 'kurtis-boutique' ),
					'next_text' => __( 'Next →', 'kurtis-boutique' ),
				) );
				?>
			</div>

		<?php else : ?>

			<!-- Zero Search Results Fallback State -->
			<div style="text-align: center; max-width: 620px; margin: 40px auto 70px; padding: 40px 24px; background: #FFFDF9; border: 1px dashed var(--color-border); border-radius: var(--radius-lg);">
				<div style="font-size: 3rem; margin-bottom: 12px;">🔍</div>
				<h2 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 10px;">
					<?php _e( 'No kurtis matched your search', 'kurtis-boutique' ); ?>
				</h2>
				<p style="color: var(--color-text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 24px;">
					We couldn't find any items matching "<strong><?php echo esc_html( $search_query ); ?></strong>". Check your spelling or browse our bestselling signature collections below.
				</p>
				<div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
					<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-checkout" style="display: inline-flex; width: auto; padding: 12px 28px;">
						<?php _e( 'Explore All Kurtis', 'kurtis-boutique' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/product-category/corset-back/' ) ); ?>" class="btn-checkout" style="display: inline-flex; width: auto; padding: 12px 28px; background: transparent; border: 1.5px solid var(--color-primary); color: var(--color-primary);">
						<?php _e( 'Corset Back Kurtis', 'kurtis-boutique' ); ?>
					</a>
				</div>
			</div>

			<!-- Recommended Bestsellers Section -->
			<div style="margin-top: 60px;">
				<div style="text-align: center; margin-bottom: 32px;">
					<div class="heading-eyebrow"><?php _e( 'YOU MAY ALSO LOVE', 'kurtis-boutique' ); ?></div>
					<h2 class="heading-section"><?php _e( 'Signature Bestsellers', 'kurtis-boutique' ); ?></h2>
				</div>
				<?php
				$featured_query = new WP_Query( array(
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'posts_per_page' => 4,
					'orderby'        => 'rand',
				) );
				if ( $featured_query->have_posts() ) :
				?>
					<div class="product-grid">
						<?php while ( $featured_query->have_posts() ) : $featured_query->the_post();
							global $product;
							if ( ! $product ) continue;
						?>
							<div class="kurtis-card">
								<div class="kurtis-card-media">
									<span class="card-badge badge-new">BESTSELLER</span>
									<a href="<?php the_permalink(); ?>">
										<?php if ( has_post_thumbnail() ) : ?>
											<?php the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'kurtis-card-img' ) ); ?>
										<?php else : ?>
											<img src="https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=600&q=80" class="kurtis-card-img" alt="<?php the_title_attribute(); ?>">
										<?php endif; ?>
									</a>
									<button type="button" class="card-quick-add ajax-add-to-cart-quick" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>" data-size="M" aria-label="Quick Add to Bag">
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
									</button>
								</div>
								<div class="kurtis-card-info">
									<h3 class="kurtis-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="kurtis-price-wrap">
										<span class="kurtis-price-current"><?php echo wc_price( $product->get_price() ); ?></span>
									</div>
								</div>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				<?php endif; ?>
			</div>

		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
