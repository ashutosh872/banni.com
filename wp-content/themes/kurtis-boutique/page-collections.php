<?php
/**
 * Template Name: Collections Hub Template
 * Template for displaying all collections / categories grid (ref: https://evara.me/collections)
 */

get_header();

$categories = get_terms( array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => true,
	'exclude'    => array( get_option( 'default_product_cat' ) ),
) );

$cat_images = array(
	'corset-back'       => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=800&q=80',
	'square-neck'       => 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=800&q=80',
	'boat-neck'         => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=800&q=80',
	'bell-sleeves'      => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=800&q=80',
	'halter-neck'       => 'https://images.unsplash.com/photo-1609357605129-26f69add5d6e?auto=format&fit=crop&w=800&q=80',
	'festive-co-ords'   => 'https://images.unsplash.com/photo-1598532163257-ae3c6b2524b6?auto=format&fit=crop&w=800&q=80',
	'essential-solids'  => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?auto=format&fit=crop&w=800&q=80',
	'sleeveless'        => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=800&q=80',
	'bottoms-pants'     => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=800&q=80',
	'a-line-kurtis'     => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&w=800&q=80',
	'anarkali-sets'     => 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=800&q=80',
	'embroidered-kurtis'=> 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=800&q=80',
	'handblock-prints'  => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=800&q=80',
	'office-wear-kurtis'=> 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?auto=format&fit=crop&w=800&q=80',
	'short-kurtis'      => 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=800&q=80',
);
?>

<main id="primary" class="site-main" style="padding: 40px 0 90px; background-color: var(--color-bg-base, #FFFDF9);">
	<div class="container">

		<!-- Page Header (Evara.me style) -->
		<div style="text-align: center; margin-bottom: 36px;">
			<div class="heading-eyebrow" style="color: var(--color-primary); letter-spacing: 0.16em; font-size: 0.8125rem;">
				<?php _e( 'SIGNATURE COLLECTIONS', 'kurtis-boutique' ); ?>
			</div>
			<h1 class="heading-section" style="font-size: 2.2rem; margin-bottom: 10px;">
				<?php _e( 'Explore All Collections', 'kurtis-boutique' ); ?>
			</h1>
			<p style="color: var(--color-text-muted); font-size: 0.95rem; max-width: 620px; margin: 0 auto; line-height: 1.6;">
				<?php _e( 'Discover artisanal silhouettes crafted in 100% breathable pure cotton. From flattering corset backs to relaxed everyday solids, find your perfect expression of grace.', 'kurtis-boutique' ); ?>
			</p>
		</div>

		<!-- Collections Grid (ref: https://evara.me/collections) -->
		<div class="collections-hub-grid">
			<?php
			if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
				foreach ( $categories as $cat ) :
					$cat_link = get_term_link( $cat );
					$img_url = isset( $cat_images[ $cat->slug ] ) ? $cat_images[ $cat->slug ] : 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=800&q=80';
					
					// Check if WooCommerce category thumbnail exists
					$thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
					if ( $thumb_id ) {
						$wc_img = wp_get_attachment_image_url( $thumb_id, 'large' );
						if ( $wc_img ) {
							$img_url = $wc_img;
						}
					}
					?>
					<div class="collection-hub-card">
						<a href="<?php echo esc_url( $cat_link ); ?>" class="collection-card-link" aria-label="<?php echo esc_attr( $cat->name ); ?>">
							<div class="collection-card-media">
								<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $cat->name ); ?>" class="collection-card-img" loading="lazy">
								<div class="collection-card-overlay"></div>
								<div class="collection-card-meta">
									<span class="collection-card-count">
										<?php printf( _n( '%s Kurti', '%s Kurtis', $cat->count, 'kurtis-boutique' ), number_format_i18n( $cat->count ) ); ?>
									</span>
									<h2 class="collection-card-title"><?php echo esc_html( $cat->name ); ?></h2>
									<span class="collection-card-cta">
										<?php _e( 'Explore Collection →', 'kurtis-boutique' ); ?>
									</span>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<!-- Bottom Banner to Full Shop -->
		<div style="text-align: center; margin-top: 54px; padding: 36px 20px; background: #FFFFFF; border-radius: var(--radius-lg); border: 1px solid var(--color-border);">
			<h3 style="font-family: var(--font-serif); font-size: 1.4rem; margin-bottom: 8px;">
				<?php _e( 'Looking for all designs together?', 'kurtis-boutique' ); ?>
			</h3>
			<p style="color: var(--color-text-muted); font-size: 0.9375rem; margin-bottom: 20px;">
				<?php _e( 'Browse our entire catalog of handcrafted cotton kurtis in one place.', 'kurtis-boutique' ); ?>
			</p>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-checkout" style="display: inline-flex; width: auto; padding: 14px 36px;">
				<?php _e( 'Shop All Kurtis', 'kurtis-boutique' ); ?>
			</a>
		</div>

	</div>
</main>

<?php
get_footer();
