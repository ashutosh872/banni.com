<?php
/**
 * Front Page Template - Kurtis Boutique
 */

get_header();

// Fetch Customizer Values
$hero_tagline    = get_theme_mod( 'kurtis_hero_tagline', 'Saaj of Banni' );
$hero_headline   = get_theme_mod( 'kurtis_hero_headline', "Here's a collection for the days you just want to feel soft." );
$hero_subheadline= get_theme_mod( 'kurtis_hero_subheadline', 'Discover breathable, all-day comfortable pure cotton kurtis crafted for effortless elegance, college, office, and celebration.' );
$hero_btn_text   = get_theme_mod( 'kurtis_hero_btn_text', 'Explore the Collection' );
$hero_btn_link   = get_theme_mod( 'kurtis_hero_btn_link', '/shop/' );
$hero_bg_image   = get_theme_mod( 'kurtis_hero_bg_image', 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=1800&q=80' );

$promo_1_title   = get_theme_mod( 'kurtis_promo_1_title', 'Corset Back Kurtis' );
$promo_1_link    = get_theme_mod( 'kurtis_promo_1_link', '/product-category/corset-back/' );
$promo_1_image   = get_theme_mod( 'kurtis_promo_1_image', 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=800&q=80' );

$promo_2_title   = get_theme_mod( 'kurtis_promo_2_title', 'Festive Co-ord Sets' );
$promo_2_link    = get_theme_mod( 'kurtis_promo_2_link', '/product-category/festive-co-ords/' );
$promo_2_image   = get_theme_mod( 'kurtis_promo_2_image', 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=800&q=80' );

$insta_handle    = get_theme_mod( 'kurtis_insta_handle', '@saaj.of.banni' );
$insta_url       = get_theme_mod( 'kurtis_insta_url', 'https://www.instagram.com/saaj.of.banni/' );
?>

<main id="primary" class="site-main">

	<!-- 1. Editorial Hero Section -->
	<section class="hero-banner">
		<div class="hero-slider-wrap">
			<div class="hero-slide">
				<div class="hero-bg-layer" style="background-image: url('<?php echo esc_url( $hero_bg_image ); ?>');"></div>
				<div class="hero-overlay"></div>
				<div class="hero-content">
					<span class="hero-editorial-pill"><?php echo esc_html( $hero_tagline ); ?></span>
					<h1 class="hero-title"><?php echo esc_html( $hero_headline ); ?></h1>
					<p class="hero-subtitle"><?php echo esc_html( $hero_subheadline ); ?></p>
					<a href="<?php echo esc_url( home_url( $hero_btn_link ) ); ?>" class="hero-btn">
						<span><?php echo esc_html( $hero_btn_text ); ?></span>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 2. Value Proposition / Trust Bar -->
	<section class="trust-bar">
		<div class="container">
			<div class="trust-grid">
				<div class="trust-item">
					<div class="trust-icon">🌿</div>
					<div class="trust-info">
						<h4>100% Pure Cotton</h4>
						<p>Breathable fabric for Indian weather</p>
					</div>
				</div>
				<div class="trust-item">
					<div class="trust-icon">🚚</div>
					<div class="trust-info">
						<h4>Free Shipping</h4>
						<p>On all orders with 2+ items</p>
					</div>
				</div>
				<div class="trust-item">
					<div class="trust-icon">💵</div>
					<div class="trust-info">
						<h4>Cash on Delivery</h4>
						<p>Pay when your parcel arrives</p>
					</div>
				</div>
				<div class="trust-item">
					<div class="trust-icon">🔄</div>
					<div class="trust-info">
						<h4>Easy 7-Day Exchange</h4>
						<p>Hassle-free doorstep pickup</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 3. New Arrivals Section -->
	<section style="padding: 60px 0 30px;">
		<div class="container">
			<div style="text-align: center; margin-bottom: 30px;">
				<div class="heading-eyebrow"><?php _e( 'Fresh Drops, Every Week', 'kurtis-boutique' ); ?></div>
				<h2 class="heading-section"><?php _e( 'New Arrivals', 'kurtis-boutique' ); ?></h2>
			</div>

			<!-- Product Grid -->
			<div class="product-grid">
				<?php
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => 4,
					'orderby'        => 'date',
					'order'          => 'DESC',
				);
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) :
					$badge_index = 0;
					$badges = array( 'MOST WANTED', 'NEW IN', 'FAST MOVER', 'BEST SELLER' );
					while ( $loop->have_posts() ) : $loop->the_post();
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
					<?php endwhile; wp_reset_postdata(); ?>
				<?php else : ?>
					<p><?php _e( 'No kurtis found. Please import demo products.', 'kurtis-boutique' ); ?></p>
				<?php endif; ?>
			</div>

			<div style="text-align: center; margin-top: 36px;">
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="hero-btn" style="background-color: var(--color-primary); color: #FFF;">
					<?php _e( 'Explore All New Arrivals', 'kurtis-boutique' ); ?>
				</a>
			</div>
		</div>
	</section>

	<!-- 4. Shop by Style / Categories Section -->
	<section style="padding: 40px 0; background-color: var(--color-bg-subtle);">
		<div class="container">
			<div style="text-align: center; margin-bottom: 32px;">
				<div class="heading-eyebrow"><?php _e( 'Kurtis crafted for every mood', 'kurtis-boutique' ); ?></div>
				<h2 class="heading-section"><?php _e( 'Shop by Style', 'kurtis-boutique' ); ?></h2>
			</div>

			<div class="category-card-grid">
				<a href="<?php echo esc_url( home_url( '/product-category/corset-back/' ) ); ?>" class="cat-circle-card">
					<div class="cat-circle-media">
						<img src="https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=300&q=80" alt="Corset Back">
					</div>
					<div class="cat-circle-title">Corset Back</div>
				</a>
				<a href="<?php echo esc_url( home_url( '/product-category/square-neck/' ) ); ?>" class="cat-circle-card">
					<div class="cat-circle-media">
						<img src="https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=300&q=80" alt="Square Neck">
					</div>
					<div class="cat-circle-title">Square Neck</div>
				</a>
				<a href="<?php echo esc_url( home_url( '/product-category/boat-neck/' ) ); ?>" class="cat-circle-card">
					<div class="cat-circle-media">
						<img src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=300&q=80" alt="Boat Neck">
					</div>
					<div class="cat-circle-title">Boat Neck</div>
				</a>
				<a href="<?php echo esc_url( home_url( '/product-category/bell-sleeves/' ) ); ?>" class="cat-circle-card">
					<div class="cat-circle-media">
						<img src="https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=300&q=80" alt="Bell Sleeves">
					</div>
					<div class="cat-circle-title">Bell Sleeves</div>
				</a>
				<a href="<?php echo esc_url( home_url( '/product-category/halter-neck/' ) ); ?>" class="cat-circle-card">
					<div class="cat-circle-media">
						<img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80" alt="Halter Neck">
					</div>
					<div class="cat-circle-title">Halter Neck</div>
				</a>
				<a href="<?php echo esc_url( home_url( '/product-category/essential-solids/' ) ); ?>" class="cat-circle-card">
					<div class="cat-circle-media">
						<img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=300&q=80" alt="Essential Solids">
					</div>
					<div class="cat-circle-title">Essential Solids</div>
				</a>
			</div>
		</div>
	</section>

	<!-- 5. Promotional Split Banners -->
	<section class="container">
		<div class="promo-split-grid">
			<div class="promo-banner-card" style="background-image: url('<?php echo esc_url( $promo_1_image ); ?>');">
				<div class="promo-banner-content">
					<div class="heading-eyebrow" style="color: #FFFFFF; opacity: 0.9;">Trending Silhouette</div>
					<h3><?php echo esc_html( $promo_1_title ); ?></h3>
					<a href="<?php echo esc_url( home_url( $promo_1_link ) ); ?>" class="btn-pill"><?php _e( 'Shop Collection', 'kurtis-boutique' ); ?></a>
				</div>
			</div>
			<div class="promo-banner-card" style="background-image: url('<?php echo esc_url( $promo_2_image ); ?>');">
				<div class="promo-banner-content">
					<div class="heading-eyebrow" style="color: #FFFFFF; opacity: 0.9;">Curated Sets</div>
					<h3><?php echo esc_html( $promo_2_title ); ?></h3>
					<a href="<?php echo esc_url( home_url( $promo_2_link ) ); ?>" class="btn-pill"><?php _e( 'Explore Co-ords', 'kurtis-boutique' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<!-- 6. Best Sellers Grid -->
	<section style="padding: 40px 0 60px;">
		<div class="container">
			<div style="text-align: center; margin-bottom: 30px;">
				<div class="heading-eyebrow"><?php _e( 'Loved by Thousands', 'kurtis-boutique' ); ?></div>
				<h2 class="heading-section"><?php _e( 'Best Sellers', 'kurtis-boutique' ); ?></h2>
			</div>

			<div class="product-grid">
				<?php
				$best_args = array(
					'post_type'      => 'product',
					'posts_per_page' => 4,
					'offset'         => 4,
					'orderby'        => 'title',
					'order'          => 'ASC',
				);
				$best_loop = new WP_Query( $best_args );
				if ( ! $best_loop->have_posts() ) {
					// Fallback to first 4 if less than 8 products
					$best_args['offset'] = 0;
					$best_loop = new WP_Query( $best_args );
				}
				if ( $best_loop->have_posts() ) :
					while ( $best_loop->have_posts() ) : $best_loop->the_post();
						global $product;
						?>
						<div class="kurtis-card">
							<div class="kurtis-card-media">
								<span class="card-badge badge-hot">SELLING FAST</span>
								<a href="<?php the_permalink(); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'kurtis-card-img' ) ); ?>
									<?php else : ?>
										<img src="https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=600&q=80" class="kurtis-card-img" alt="<?php the_title_attribute(); ?>">
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
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- 7. Customer Testimonials Section -->
	<section class="reviews-section">
		<div class="container">
			<div class="reviews-header">
				<div class="reviews-rating-badge">★ 4.85 / 5 Rating (8,200+ Reviews)</div>
				<h2 class="heading-section"><?php _e( 'Loved by Women Across India', 'kurtis-boutique' ); ?></h2>
			</div>

			<div class="reviews-grid">
				<div class="review-card">
					<div class="review-stars">★★★★★</div>
					<p class="review-text">"The pure cotton fabric is extraordinarily soft! I wore the Corset Back Kurti for an entire day at work in Mumbai humidity, and it stayed crisp and comfortable. Absolutely ordering more."</p>
					<div class="review-author">Ananya Sharma <span style="color:#888; font-weight:400;">· Mumbai (Verified Buyer)</span></div>
				</div>
				<div class="review-card">
					<div class="review-stars">★★★★★</div>
					<p class="review-text">"The stitching and fit are pure perfection. The size chart was 100% accurate. Delivered in Delhi in just 2 days. The tiered discount made it such great value!"</p>
					<div class="review-author">Pooja Mehra <span style="color:#888; font-weight:400;">· New Delhi (Verified Buyer)</span></div>
				</div>
				<div class="review-card">
					<div class="review-stars">★★★★★</div>
					<p class="review-text">"Finally a kurti brand that understands modern ethnic fashion. Clean cuts, beautiful patterns, no itchy synthetic mixes. Pure 100% breathable cotton as promised."</p>
					<div class="review-author">Dr. Sneha Rao <span style="color:#888; font-weight:400;">· Bengaluru (Verified Buyer)</span></div>
				</div>
			</div>
		</div>
	</section>

	<!-- 8. Instagram Showcase Feed -->
	<section class="container" style="padding-top: 60px;">
		<div style="text-align: center; margin-bottom: 24px;">
			<div class="heading-eyebrow"><?php _e( 'Our Beautiful Community', 'kurtis-boutique' ); ?></div>
			<h2 class="heading-section"><?php _e( 'Shop The Gram', 'kurtis-boutique' ); ?></h2>
			<p style="color: var(--color-text-muted); font-size: 0.95rem;">
				Tag us on Instagram <a href="<?php echo esc_url( $insta_url ); ?>" target="_blank" style="color: var(--color-primary); font-weight: 700;"><?php echo esc_html( $insta_handle ); ?></a> to get featured!
			</p>
		</div>

		<div class="insta-grid">
			<div class="insta-item">
				<img src="https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=400&q=80" alt="Instagram Style 1">
			</div>
			<div class="insta-item">
				<img src="https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=400&q=80" alt="Instagram Style 2">
			</div>
			<div class="insta-item">
				<img src="https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=400&q=80" alt="Instagram Style 3">
			</div>
			<div class="insta-item">
				<img src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=400&q=80" alt="Instagram Style 4">
			</div>
			<div class="insta-item">
				<img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80" alt="Instagram Style 5">
			</div>
			<div class="insta-item">
				<img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=400&q=80" alt="Instagram Style 6">
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
