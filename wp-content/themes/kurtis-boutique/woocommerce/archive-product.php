<?php
/**
 * The Template for displaying product archives, including the main shop page
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main" style="padding: 40px 0 80px;">
	<div class="container">
		
		<?php if ( is_search() ) : ?>
		<div style="text-align: center; margin-bottom: 28px;">
			<div class="heading-eyebrow" style="color: var(--color-primary); letter-spacing: 0.15em; font-size: 0.8125rem;">
				<?php _e( 'SEARCH RESULTS', 'kurtis-boutique' ); ?>
			</div>
			<h1 class="heading-section" style="margin-bottom: 8px;">
				<?php printf( esc_html__( 'Search: "%s"', 'kurtis-boutique' ), esc_html( get_search_query() ) ); ?>
			</h1>
			<p style="color: var(--color-text-muted); font-size: 0.9375rem;">
				<?php
				global $wp_query;
				$total = $wp_query->found_posts;
				if ( $total === 1 ) {
					echo 'Found <strong>1</strong> handcrafted kurti matching your query';
				} elseif ( $total > 1 ) {
					printf( 'Found <strong>%d</strong> handcrafted kurtis matching your query', $total );
				} else {
					echo 'No direct matches found';
				}
				?>
			</p>
		</div>

		<!-- Quick Search Refine Bar -->
		<div style="max-width: 560px; margin: 0 auto 36px;">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display: flex; gap: 8px;">
				<input type="hidden" name="post_type" value="product">
				<input type="search" class="footer-input" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Search cotton, corset, square neck..." required style="padding: 12px 18px; font-size: 0.9375rem; border: 1.5px solid var(--color-border); border-radius: var(--radius-sm);">
				<button type="submit" class="footer-btn-sub" style="padding: 0 24px; font-weight: 700; border-radius: var(--radius-sm);"><?php _e( 'Search', 'kurtis-boutique' ); ?></button>
			</form>
		</div>
		<?php else : ?>
		<div style="text-align: center; margin-bottom: 24px;">
			<div class="heading-eyebrow"><?php _e( 'Handpicked Ethnic Wear', 'kurtis-boutique' ); ?></div>
			<h1 class="heading-section">
				<?php
				if ( is_shop() ) {
					_e( 'All Kurtis Collection', 'kurtis-boutique' );
				} else {
					woocommerce_page_title();
				}
				?>
			</h1>
			<p style="color: var(--color-text-muted); font-size: 0.95rem; max-width: 600px; margin: 0 auto;">
				<?php _e( 'Explore our signature range of 100% pure cotton kurtis, flattering cuts, and breathable fabrics designed for effortless everyday living.', 'kurtis-boutique' ); ?>
			</p>
		</div>
		<?php endif; ?>

		<!-- Category Filter Pills -->
		<?php
		$current_term_id = is_product_category() ? get_queried_object_id() : 0;
		echo kurtis_render_category_pills( $current_term_id );
		?>

		<?php if ( woocommerce_product_loop() ) : ?>
			<div class="product-grid">
				<?php
				$badge_index = 0;
				$badges = array( 'MOST WANTED', 'NEW IN', 'FAST MOVER', 'BEST SELLER', 'RESTOCKED' );
				while ( have_posts() ) : the_post();
					global $product;
					$current_badge = $badges[ $badge_index % count( $badges ) ];
					$badge_index++;
					?>
					<div class="kurtis-card">
						<div class="kurtis-card-media">
							<span class="card-badge <?php echo $badge_index === 1 ? 'badge-new' : ''; ?>"><?php echo esc_html( $current_badge ); ?></span>
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
			<?php if ( is_search() ) : ?>
				<!-- Zero Search Results Fallback State -->
				<div style="text-align: center; max-width: 620px; margin: 40px auto 60px; padding: 40px 24px; background: #FFFDF9; border: 1px dashed var(--color-border); border-radius: var(--radius-lg);">
					<div style="font-size: 3rem; margin-bottom: 12px;">🔍</div>
					<h2 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 10px;">
						<?php _e( 'No kurtis matched your search', 'kurtis-boutique' ); ?>
					</h2>
					<p style="color: var(--color-text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 24px;">
						We couldn't find any items matching "<strong><?php echo esc_html( get_search_query() ); ?></strong>". Check your spelling or browse our bestselling signature collections below.
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
				<div style="margin-top: 50px;">
					<div style="text-align: center; margin-bottom: 28px;">
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
			<?php else : ?>
				<div style="text-align: center; padding: 60px 20px;">
					<p style="font-size: 1.2rem; color: var(--color-text-muted);"><?php _e( 'No kurtis found in this collection.', 'kurtis-boutique' ); ?></p>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
