<?php
/**
 * Single Product Template - Kurtis Boutique
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) : the_post();
	global $product;
	$post_id = get_the_ID();
	$attachment_ids = $product->get_gallery_image_ids();
	$main_img_url   = has_post_thumbnail() ? get_the_post_thumbnail_url( $post_id, 'full' ) : 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=1200&q=80';
	$regular_price  = $product->get_regular_price();
	$sale_price     = $product->get_price();
	$discount_pct   = ( $regular_price && $sale_price && $regular_price > $sale_price ) ? round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 ) : 17;
?>

<!-- Sticky Add to Cart Top Bar -->
<div class="sticky-add-bar" id="stickyAddBar">
	<div class="container">
		<div class="sticky-add-inner">
			<div class="sticky-prod-info">
				<div class="sticky-prod-thumb">
					<img src="<?php echo esc_url( $main_img_url ); ?>" alt="<?php the_title_attribute(); ?>">
				</div>
				<div>
					<div class="sticky-prod-name"><?php the_title(); ?></div>
					<div class="sticky-prod-price"><?php echo wc_price( $sale_price ); ?></div>
				</div>
			</div>
			<button type="button" class="sticky-btn-add" id="stickyAddToCartBtn">
				<?php _e( 'Add to Cart', 'kurtis-boutique' ); ?>
			</button>
		</div>
	</div>
</div>

<main id="primary" class="site-main pdp-wrap">
	<div class="container">
		
		<!-- Breadcrumbs -->
		<div style="font-size: 0.8125rem; color: var(--color-text-muted); margin-bottom: 24px;">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / 
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Kurtis</a> / 
			<span style="color: var(--color-text-main); font-weight: 600;"><?php the_title(); ?></span>
		</div>

		<div class="pdp-grid">
			
			<!-- Left Column: Image Gallery -->
			<div class="pdp-gallery">
				<div class="pdp-main-image">
					<img id="pdpMainImg" src="<?php echo esc_url( $main_img_url ); ?>" alt="<?php the_title_attribute(); ?>">
				</div>
				<div class="pdp-thumbs">
					<div class="pdp-thumb active" data-img-url="<?php echo esc_url( $main_img_url ); ?>">
						<img src="<?php echo esc_url( $main_img_url ); ?>" alt="View 1">
					</div>
					<?php if ( ! empty( $attachment_ids ) ) : ?>
						<?php foreach ( $attachment_ids as $attachment_id ) : ?>
							<?php $thumb_url = wp_get_attachment_url( $attachment_id ); ?>
							<div class="pdp-thumb" data-img-url="<?php echo esc_url( $thumb_url ); ?>">
								<img src="<?php echo esc_url( $thumb_url ); ?>" alt="View Extra">
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<!-- Dummy Lifestyle Gallery Shots -->
						<div class="pdp-thumb" data-img-url="https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=1200&q=80">
							<img src="https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=200&q=80" alt="View 2">
						</div>
						<div class="pdp-thumb" data-img-url="https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=1200&q=80">
							<img src="https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=200&q=80" alt="View 3">
						</div>
						<div class="pdp-thumb" data-img-url="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=1200&q=80">
							<img src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=200&q=80" alt="View 4">
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Right Column: Product Information & Purchase Controls -->
			<div class="pdp-info">
				<h1 class="pdp-title"><?php the_title(); ?></h1>
				
				<div class="pdp-price-wrap">
					<span class="pdp-price-current"><?php echo wc_price( $sale_price ); ?></span>
					<?php if ( $regular_price && $regular_price > $sale_price ) : ?>
						<span class="pdp-price-old"><?php echo wc_price( $regular_price ); ?></span>
						<span class="pdp-badge-discount"><?php echo esc_html( $discount_pct ); ?>% OFF</span>
					<?php endif; ?>
				</div>
				<div class="pdp-tax-note"><?php _e( 'Inclusive of all taxes · Cash on Delivery available across India', 'kurtis-boutique' ); ?></div>

				<!-- Snapmint / 0% EMI Widget -->
				<div class="pdp-emi-box">
					<div style="font-size: 0.8125rem;">
						<span style="background-color: var(--color-badge-green); color:#FFF; font-weight:700; font-size:0.65rem; padding: 2px 6px; border-radius:3px;">NEW</span>
						<strong>₹1 now + ₹499/month</strong> (2 months) · 0% EMI on UPI
					</div>
					<div class="emi-btn-pill">Buy On EMI</div>
				</div>

				<!-- Size Selector -->
				<div class="pdp-size-header">
					<label><?php _e( 'Size:', 'kurtis-boutique' ); ?> <span id="selectedSizeLabel" style="font-weight:700; color:var(--color-primary);">Select</span></label>
					<button type="button" class="size-chart-trigger" id="sizeChartOpenBtn"><?php _e( 'Size chart', 'kurtis-boutique' ); ?></button>
				</div>
				
				<div class="size-boxes" id="sizeSelectorWrap">
					<div class="size-box" data-size="XS">XS</div>
					<div class="size-box" data-size="S">S</div>
					<div class="size-box" data-size="M">M</div>
					<div class="size-box" data-size="L">L</div>
					<div class="size-box" data-size="XL">XL</div>
					<div class="size-box" data-size="XXL">XXL</div>
				</div>

				<div class="size-error-msg" id="sizeErrorMsg">
					⚠️ <?php _e( 'Please select a size to continue', 'kurtis-boutique' ); ?>
				</div>

				<div class="size-hint">
					💡 <?php _e( 'Not sure about your size? Go one size up for comfort.', 'kurtis-boutique' ); ?>
				</div>

				<!-- Tiered Volume Discounts -->
				<div class="tiered-promos">
					<div class="tiered-title">✨ <?php _e( 'Your festive wardrobe deserves more. ✨', 'kurtis-boutique' ); ?></div>
					<div class="tiered-cards-grid">
						<div class="tier-card">
							<div class="tier-items">Buy <strong>2</strong> items</div>
							<div class="tier-discount">10% OFF</div>
							<div class="tier-sub">A little festive treat</div>
						</div>
						<div class="tier-card" style="border-color: var(--color-primary);">
							<span class="tier-badge">POPULAR</span>
							<div class="tier-items">Buy <strong>3</strong> items</div>
							<div class="tier-discount">15% OFF</div>
							<div class="tier-sub">Most loved deal</div>
						</div>
						<div class="tier-card">
							<span class="tier-badge" style="background-color: #000;">BEST VALUE</span>
							<div class="tier-items">Buy <strong>4+</strong> items</div>
							<div class="tier-discount">20% OFF</div>
							<div class="tier-sub">Maximum savings</div>
						</div>
					</div>
					
					<div class="shipping-pill-callout">
						🚚 <?php _e( 'FREE SHIPPING ON 2+ ITEMS', 'kurtis-boutique' ); ?>
					</div>
					
					<div class="express-shipping-note">
						🚀 <?php _e( 'Orders within Delhi NCR & major metros delivered in just 1–2 working days!', 'kurtis-boutique' ); ?>
					</div>
				</div>

				<!-- Quantity Selector & Action Buttons -->
				<div style="display: flex; gap: 12px; margin-bottom: 12px; align-items: stretch;">
					<div class="pdp-qty-stepper" style="display: inline-flex; align-items: center; border: 1.5px solid var(--color-border); border-radius: var(--radius-sm); background: #FFF; padding: 0 4px;">
						<button type="button" id="pdpQtyMinus" style="background: none; border: none; padding: 10px 14px; font-size: 1.2rem; cursor: pointer; color: var(--color-text-main); font-weight: 700;">−</button>
						<span id="pdpQtyVal" style="padding: 0 10px; font-weight: 700; font-size: 1rem; min-width: 28px; text-align: center;">1</span>
						<button type="button" id="pdpQtyPlus" style="background: none; border: none; padding: 10px 14px; font-size: 1.2rem; cursor: pointer; color: var(--color-text-main); font-weight: 700;">+</button>
					</div>

					<button type="button" class="btn-add-to-cart" id="mainAddToCartBtn" data-product-id="<?php echo esc_attr( $post_id ); ?>" style="flex: 1; margin: 0;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
						<span><?php _e( 'Add to Bag', 'kurtis-boutique' ); ?></span>
					</button>
				</div>

				<!-- Buy It Now Express Checkout Button -->
				<button type="button" class="btn-buy-now" id="buyNowBtn" data-product-id="<?php echo esc_attr( $post_id ); ?>" style="width: 100%; background: #1F1F1F; color: #FFF; padding: 15px; border: none; border-radius: var(--radius-sm); font-size: 0.9375rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; cursor: pointer; margin-bottom: 24px; transition: var(--transition);">
					⚡ <?php _e( 'Buy It Now · Express Checkout', 'kurtis-boutique' ); ?>
				</button>

				<!-- Pincode Delivery Estimator Box -->
				<div class="pdp-pincode-box">
					<label style="font-size: 0.8125rem; font-weight: 700; text-transform: uppercase;">
						📍 <?php _e( 'Check Delivery & Cash on Delivery', 'kurtis-boutique' ); ?>
					</label>
					<div class="pincode-input-row">
						<input type="text" class="pincode-input" id="pincodeInput" placeholder="Enter 6-digit pincode" maxlength="6">
						<button type="button" class="pincode-btn" id="pincodeBtn"><?php _e( 'Check', 'kurtis-boutique' ); ?></button>
					</div>
					<div class="pincode-result" id="pincodeResult">
						✓ Delivery available by Tuesday | Cash on Delivery eligible!
					</div>
				</div>

				<!-- Collapsible Accordions -->
				<div class="pdp-accordions">
					<div class="accordion-item active">
						<button type="button" class="accordion-header">
							<span><?php _e( 'Description & Style Notes', 'kurtis-boutique' ); ?></span>
							<svg class="accordion-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
						</button>
						<div class="accordion-body">
							<?php the_content(); ?>
							<p>Designed with a flattering feminine silhouette, clean tailored finish, and versatile everyday neckline. Perfect for college, office, festive gatherings, and weekend cafe dates.</p>
						</div>
					</div>

					<div class="accordion-item">
						<button type="button" class="accordion-header">
							<span><?php _e( 'Fabric & Wash Care', 'kurtis-boutique' ); ?></span>
							<svg class="accordion-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
						</button>
						<div class="accordion-body">
							<ul>
								<li><strong>Fabric:</strong> 100% Pure Breathable Cotton.</li>
								<li><strong>Weave:</strong> Premium natural yarn, pre-washed for extra softness.</li>
								<li><strong>Care:</strong> Machine wash cold gentle cycle with like colors. Do not bleach. Warm iron on reverse.</li>
							</ul>
						</div>
					</div>

					<div class="accordion-item">
						<button type="button" class="accordion-header">
							<span><?php _e( 'Shipping & Easy 7-Day Exchange', 'kurtis-boutique' ); ?></span>
							<svg class="accordion-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
						</button>
						<div class="accordion-body">
							<p>We dispatch all orders within 24 hours. Enjoy free shipping on orders of 2 or more items. If the fit isn't 100% perfect, request an exchange within 7 days of delivery for seamless doorstep exchange across India.</p>
						</div>
					</div>
				</div>

			</div>

		</div>

		<!-- You May Also Like Section -->
		<div style="margin-top: 80px;">
			<div style="text-align: center; margin-bottom: 30px;">
				<div class="heading-eyebrow"><?php _e( 'Complete Your Wardrobe', 'kurtis-boutique' ); ?></div>
				<h2 class="heading-section"><?php _e( 'You May Also Like', 'kurtis-boutique' ); ?></h2>
			</div>
			
			<div class="product-grid">
				<?php
				$related_args = array(
					'post_type'      => 'product',
					'posts_per_page' => 4,
					'post__not_in'   => array( $post_id ),
					'orderby'        => 'rand',
				);
				$related_loop = new WP_Query( $related_args );
				if ( $related_loop->have_posts() ) :
					while ( $related_loop->have_posts() ) : $related_loop->the_post();
						global $product;
						?>
						<div class="kurtis-card">
							<div class="kurtis-card-media">
								<a href="<?php the_permalink(); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'kurtis-card-img' ) ); ?>
									<?php else : ?>
										<img src="https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=600&q=80" class="kurtis-card-img" alt="<?php the_title_attribute(); ?>">
									<?php endif; ?>
								</a>
							</div>
							<div class="kurtis-card-info">
								<h3 class="kurtis-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="kurtis-price-wrap">
									<span class="kurtis-price-current"><?php echo wc_price( $product->get_price() ); ?></span>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>

	</div>
</main>

<?php
endwhile;

get_footer();
