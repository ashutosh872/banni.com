<?php
/**
 * Kurtis Boutique Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1. Theme Setup
function kurtis_boutique_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 280,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation Menu', 'kurtis-boutique' ),
		'footer'  => __( 'Footer Navigation Menu', 'kurtis-boutique' ),
	) );
}
add_action( 'after_setup_theme', 'kurtis_boutique_setup' );

// 2. Enqueue Styles & Scripts
function kurtis_boutique_scripts() {
	// Google Fonts: Playfair Display + Inter
	wp_enqueue_style( 'google-fonts-kurtis', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap', array(), null );

	// Theme Stylesheet
	wp_enqueue_style( 'kurtis-boutique-style', get_stylesheet_uri(), array(), '1.0.9' );

	// Theme JavaScript
	wp_enqueue_script( 'kurtis-boutique-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.9', true );

	// Pass Ajax URL & Nonce to JavaScript
	wp_localize_script( 'kurtis-boutique-main', 'kurtis_ajax', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => wp_create_nonce( 'kurtis_cart_nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'kurtis_boutique_scripts' );

// 3. Customizer GUI Controls for Non-Technical Admin
function kurtis_boutique_customize_register( $wp_customize ) {
	// Panel: Store Customizer
	$wp_customize->add_panel( 'kurtis_store_panel', array(
		'title'       => __( '✨ Kurtis Store Settings (GUI Look)', 'kurtis-boutique' ),
		'description' => __( 'Visual controls to customize announcements, hero banners, promo tiles, and footer without touching code.', 'kurtis-boutique' ),
		'priority'    => 20,
	) );

	// Section 1: Marquee Announcement Bar
	$wp_customize->add_section( 'kurtis_announcements_sec', array(
		'title'    => __( '1. Marquee Announcement Bar', 'kurtis-boutique' ),
		'panel'    => 'kurtis_store_panel',
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'kurtis_ticker_text_1', array(
		'default'   => '🪔 FESTIVE SALE IS LIVE! BUY 2 GET 10% OFF',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( 'kurtis_ticker_text_1', array(
		'label'    => __( 'Announcement Message 1', 'kurtis-boutique' ),
		'section'  => 'kurtis_announcements_sec',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'kurtis_ticker_text_2', array(
		'default'   => 'BUY 3 ITEMS GET 15% OFF ✨ · BUY 4+ ITEMS GET 20% OFF ✨ · COD AVAILABLE',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( 'kurtis_ticker_text_2', array(
		'label'    => __( 'Announcement Message 2', 'kurtis-boutique' ),
		'section'  => 'kurtis_announcements_sec',
		'type'     => 'text',
	) );

	// Section 2: Hero Banner
	$wp_customize->add_section( 'kurtis_hero_sec', array(
		'title'    => __( '2. Homepage Hero Banner', 'kurtis-boutique' ),
		'panel'    => 'kurtis_store_panel',
		'priority' => 20,
	) );

	$wp_customize->add_setting( 'kurtis_hero_tagline', array(
		'default'   => 'Saaj of Banni',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( 'kurtis_hero_tagline', array(
		'label'    => __( 'Hero Small Pill Tagline', 'kurtis-boutique' ),
		'section'  => 'kurtis_hero_sec',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'kurtis_hero_headline', array(
		'default'   => "Here's a collection for the days you just want to feel soft.",
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( 'kurtis_hero_headline', array(
		'label'    => __( 'Hero Main Headline', 'kurtis-boutique' ),
		'section'  => 'kurtis_hero_sec',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'kurtis_hero_subheadline', array(
		'default'   => 'Discover breathable, all-day comfortable pure cotton kurtis crafted for effortless elegance, college, office, and celebration.',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( 'kurtis_hero_subheadline', array(
		'label'    => __( 'Hero Subtitle Description', 'kurtis-boutique' ),
		'section'  => 'kurtis_hero_sec',
		'type'     => 'textarea',
	) );

	$wp_customize->add_setting( 'kurtis_hero_btn_text', array(
		'default'   => 'Explore the Collection',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( 'kurtis_hero_btn_text', array(
		'label'    => __( 'Hero Button Text', 'kurtis-boutique' ),
		'section'  => 'kurtis_hero_sec',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'kurtis_hero_btn_link', array(
		'default'   => '/shop',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( 'kurtis_hero_btn_link', array(
		'label'    => __( 'Hero Button Destination Link', 'kurtis-boutique' ),
		'section'  => 'kurtis_hero_sec',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'kurtis_hero_bg_image', array(
		'default'   => 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=1800&q=80',
		'transport' => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kurtis_hero_bg_image', array(
		'label'    => __( 'Hero Background Image', 'kurtis-boutique' ),
		'section'  => 'kurtis_hero_sec',
	) ) );

	// Section 3: Promotional Split Banners
	$wp_customize->add_section( 'kurtis_promos_sec', array(
		'title'    => __( '3. Promotional Split Banners', 'kurtis-boutique' ),
		'panel'    => 'kurtis_store_panel',
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'kurtis_promo_1_title', array( 'default' => 'Corset Back Kurtis' ) );
	$wp_customize->add_control( 'kurtis_promo_1_title', array( 'label' => 'Banner 1 Title', 'section' => 'kurtis_promos_sec' ) );
	$wp_customize->add_setting( 'kurtis_promo_1_link', array( 'default' => '/shop' ) );
	$wp_customize->add_control( 'kurtis_promo_1_link', array( 'label' => 'Banner 1 Link', 'section' => 'kurtis_promos_sec' ) );
	$wp_customize->add_setting( 'kurtis_promo_1_image', array( 'default' => 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=800&q=80' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kurtis_promo_1_image', array( 'label' => 'Banner 1 Image', 'section' => 'kurtis_promos_sec' ) ) );

	$wp_customize->add_setting( 'kurtis_promo_2_title', array( 'default' => 'Festive Co-ord Sets' ) );
	$wp_customize->add_control( 'kurtis_promo_2_title', array( 'label' => 'Banner 2 Title', 'section' => 'kurtis_promos_sec' ) );
	$wp_customize->add_setting( 'kurtis_promo_2_link', array( 'default' => '/shop' ) );
	$wp_customize->add_control( 'kurtis_promo_2_link', array( 'label' => 'Banner 2 Link', 'section' => 'kurtis_promos_sec' ) );
	$wp_customize->add_setting( 'kurtis_promo_2_image', array( 'default' => 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=800&q=80' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'kurtis_promo_2_image', array( 'label' => 'Banner 2 Image', 'section' => 'kurtis_promos_sec' ) ) );

	// Section 4: Instagram & Social Feed
	$wp_customize->add_section( 'kurtis_social_sec', array(
		'title'    => __( '4. Instagram & Social Handles', 'kurtis-boutique' ),
		'panel'    => 'kurtis_store_panel',
		'priority' => 40,
	) );

	$wp_customize->add_setting( 'kurtis_insta_handle', array( 'default' => '@saaj.of.banni' ) );
	$wp_customize->add_control( 'kurtis_insta_handle', array( 'label' => 'Instagram Handle', 'section' => 'kurtis_social_sec' ) );
	$wp_customize->add_setting( 'kurtis_insta_url', array( 'default' => 'https://www.instagram.com/saaj.of.banni/' ) );
	$wp_customize->add_control( 'kurtis_insta_url', array( 'label' => 'Instagram Profile Link', 'section' => 'kurtis_social_sec' ) );

	// Section 5: Footer & Support
	$wp_customize->add_section( 'kurtis_footer_sec', array(
		'title'    => __( '5. Footer & Contact Details', 'kurtis-boutique' ),
		'panel'    => 'kurtis_store_panel',
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'kurtis_about_text', array(
		'default' => 'Rooted in timeless Indian textiles, Saaj of Banni crafts breathable pure cotton kurtis designed for effortless elegance, everyday ease, and enduring grace.',
	) );
	$wp_customize->add_control( 'kurtis_about_text', array( 'label' => 'Footer About Text', 'section' => 'kurtis_footer_sec', 'type' => 'textarea' ) );

	$wp_customize->add_setting( 'kurtis_support_phone', array( 'default' => '+91 98765 43210' ) );
	$wp_customize->add_control( 'kurtis_support_phone', array( 'label' => 'Customer WhatsApp / Phone', 'section' => 'kurtis_footer_sec' ) );

	$wp_customize->add_setting( 'kurtis_support_email', array( 'default' => 'hello@saajofbanni.com' ) );
	$wp_customize->add_control( 'kurtis_support_email', array( 'label' => 'Customer Support Email', 'section' => 'kurtis_footer_sec' ) );

	$wp_customize->add_setting( 'kurtis_gstin', array( 'default' => 'GSTIN: 07AAAAA0000A1Z5' ) );
	$wp_customize->add_control( 'kurtis_gstin', array( 'label' => 'GSTIN / Business Registration', 'section' => 'kurtis_footer_sec' ) );
}
add_action( 'customize_register', 'kurtis_boutique_customize_register' );

// 3.5. Category Filter Pills Component
function kurtis_render_category_pills( $current_term_id = 0 ) {
	$categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'exclude'    => array( get_option( 'default_product_cat' ) ),
	) );

	// On /shop/ (collections/all), all pills are shown in neutral state without selecting any pill
	$is_all_active = '';

	ob_start();
	?>
	<div class="category-pills-wrapper">
		<button type="button" class="pills-scroll-btn pills-scroll-prev" aria-label="<?php esc_attr_e( 'Scroll categories left', 'kurtis-boutique' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
		</button>
		<div class="category-pills-bar" tabindex="0" role="region" aria-label="<?php esc_attr_e( 'Category Filter', 'kurtis-boutique' ); ?>">
			<a href="<?php echo esc_url( home_url( '/collections/all/' ) ); ?>" class="category-pill <?php echo esc_attr( $is_all_active ); ?>">
				<?php _e( 'All Kurtis', 'kurtis-boutique' ); ?>
			</a>
			<?php
			if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
				foreach ( $categories as $cat ) {
					// Only the actively selected category gets the 'active' class
					$active = ( (int) $current_term_id === (int) $cat->term_id ) ? 'active' : '';
					echo '<a href="' . esc_url( get_term_link( $cat ) ) . '" class="category-pill ' . esc_attr( $active ) . '" data-term-id="' . esc_attr( $cat->term_id ) . '">' . esc_html( $cat->name ) . '</a>';
				}
			}
			?>
		</div>
		<button type="button" class="pills-scroll-btn pills-scroll-next" aria-label="<?php esc_attr_e( 'Scroll categories right', 'kurtis-boutique' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
		</button>
	</div>
	<?php
	return ob_get_clean();
}

// 4. Ajax Cart Drawer Functions
function kurtis_get_cart_drawer_html() {
	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		return '';
	}

	$cart_count = WC()->cart->get_cart_contents_count();
	$subtotal   = WC()->cart->get_cart_subtotal();

	// Calculate Milestone Progress (2 items = Level 1, 3 items = Level 2, 4+ items = Level 3)
	$fill_percent = 0;
	$milestone_msg = 'Add <strong>2 items</strong> for Free Shipping + 10% OFF';

	if ( $cart_count == 0 ) {
		$fill_percent = 0;
		$milestone_msg = 'Add <strong>2 items</strong> for Free Shipping + 10% OFF';
	} elseif ( $cart_count == 1 ) {
		$fill_percent = 33;
		$milestone_msg = 'Add <strong>1 more item</strong> for Free Shipping + 10% OFF!';
	} elseif ( $cart_count == 2 ) {
		$fill_percent = 66;
		$milestone_msg = '🎉 Free Shipping Unlocked! Add <strong>1 more item</strong> for 15% OFF!';
	} else {
		$fill_percent = 100;
		$milestone_msg = '✨ MAXIMUM 20% DISCOUNT + FREE SHIPPING UNLOCKED!';
	}

	ob_start();
	?>
	<div class="cart-drawer-header">
		<h3><?php _e( 'Your Shopping Bag', 'kurtis-boutique' ); ?> (<span class="drawer-item-count"><?php echo esc_html( $cart_count ); ?></span>)</h3>
		<button type="button" class="cart-drawer-close" aria-label="Close Cart">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
		</button>
	</div>

	<!-- Tiered Shipping Milestone Bar -->
	<div class="cart-milestone-wrap">
		<div class="milestone-callout"><?php echo wp_kses_post( $milestone_msg ); ?></div>
		<div class="milestone-track-wrap">
			<div class="milestone-progress-line">
				<div class="milestone-progress-fill" style="width: <?php echo esc_attr( $fill_percent ); ?>%;"></div>
			</div>
			<div class="milestone-step <?php echo $cart_count >= 2 ? 'active' : ''; ?>">
				<div class="milestone-step-circle">🚚</div>
				<span class="milestone-step-label">2 Items (10%)</span>
			</div>
			<div class="milestone-step <?php echo $cart_count >= 3 ? 'active' : ''; ?>">
				<div class="milestone-step-circle">✨</div>
				<span class="milestone-step-label">3 Items (15%)</span>
			</div>
			<div class="milestone-step <?php echo $cart_count >= 4 ? 'active' : ''; ?>">
				<div class="milestone-step-circle">👑</div>
				<span class="milestone-step-label">4+ Items (20%)</span>
			</div>
		</div>
	</div>

	<!-- Cart Items List -->
	<div class="cart-drawer-items">
		<?php if ( WC()->cart->is_empty() ) : ?>
			<div style="text-align: center; padding: 48px 20px;">
				<p style="font-size: 1.1rem; color: var(--color-text-muted); margin-bottom: 20px;"><?php _e( 'Your bag is empty.', 'kurtis-boutique' ); ?></p>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-checkout" style="display:inline-flex; width:auto; padding: 12px 30px;">
					<?php _e( 'Explore Kurtis', 'kurtis-boutique' ); ?>
				</a>
			</div>
		<?php else : ?>
			<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) :
					$product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
					$thumbnail = $_product->get_image( array( 76, 96 ) );
					$size_attr = isset( $cart_item['variation']['attribute_pa_size'] ) ? strtoupper( $cart_item['variation']['attribute_pa_size'] ) : ( isset( $cart_item['size'] ) ? esc_html( $cart_item['size'] ) : 'M' );
					?>
					<div class="cart-item-row" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>">
						<div class="cart-item-img">
							<?php echo $thumbnail; ?>
						</div>
						<div class="cart-item-details">
							<div>
								<div class="cart-item-title"><?php echo esc_html( $_product->get_name() ); ?></div>
								<div class="cart-item-variant">Size: <strong><?php echo esc_html( $size_attr ); ?></strong></div>
								<div class="cart-item-price"><?php echo WC()->cart->get_product_price( $_product ); ?></div>
							</div>
							<div class="cart-item-actions">
								<div class="qty-stepper">
									<button type="button" class="qty-btn btn-qty-minus" data-key="<?php echo esc_attr( $cart_item_key ); ?>">−</button>
									<span class="qty-val"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
									<button type="button" class="qty-btn btn-qty-plus" data-key="<?php echo esc_attr( $cart_item_key ); ?>">+</button>
								</div>
								<a href="#" class="btn-remove-item" data-key="<?php echo esc_attr( $cart_item_key ); ?>"><?php _e( 'Remove', 'kurtis-boutique' ); ?></a>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>

			<!-- Complete Your Look Upsell Card -->
			<?php
			$upsell_id = get_option( 'kurtis_upsell_product_id', 31 );
			$upsell_prod = wc_get_product( $upsell_id );
			if ( $upsell_prod && $upsell_prod->is_purchasable() ) :
			?>
			<div class="cart-upsell-box">
				<div class="upsell-title">✨ <?php _e( 'Complete Your Look', 'kurtis-boutique' ); ?></div>
				<div class="upsell-product">
					<div class="upsell-img">
						<img src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=150&q=80" alt="<?php echo esc_attr( $upsell_prod->get_name() ); ?>">
					</div>
					<div class="upsell-info">
						<div class="upsell-prod-name"><?php echo esc_html( $upsell_prod->get_name() ); ?></div>
						<div class="upsell-prod-price"><?php echo wc_price( $upsell_prod->get_price() ); ?> <span style="text-decoration: line-through; color: #888;">₹999</span></div>
					</div>
					<button type="button" class="btn-upsell-add ajax-add-to-cart-quick" data-product-id="<?php echo esc_attr( $upsell_id ); ?>" data-size="Free Size">
						+ <?php _e( 'ADD', 'kurtis-boutique' ); ?>
					</button>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>

	<?php if ( ! WC()->cart->is_empty() ) : ?>
		<div class="cart-drawer-footer">
			<!-- Cart Drawer Coupon Bar -->
			<div class="cart-coupon-wrap" style="margin-bottom: 12px;">
				<div style="display: flex; gap: 6px;">
					<input type="text" id="drawerCouponCode" placeholder="Coupon (e.g. WELCOME10)" style="flex: 1; padding: 8px 12px; border: 1.5px solid var(--color-border); border-radius: var(--radius-sm); font-size: 0.8125rem; outline: none; text-transform: uppercase;">
					<button type="button" id="btnApplyDrawerCoupon" style="background: var(--color-primary); color: #fff; border: none; padding: 8px 14px; border-radius: var(--radius-sm); font-size: 0.8125rem; font-weight: 700; cursor: pointer;">
						<?php _e( 'Apply', 'kurtis-boutique' ); ?>
					</button>
				</div>
				<div id="drawerCouponMsg" style="font-size: 0.75rem; margin-top: 4px; display: none;"></div>
			</div>

			<div class="cart-subtotal-row">
				<span><?php _e( 'Subtotal', 'kurtis-boutique' ); ?></span>
				<span><?php echo $subtotal; ?></span>
			</div>
			<?php if ( WC()->cart->get_coupons() ) : ?>
				<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
					<div class="cart-subtotal-row" style="color: var(--color-accent); font-size: 0.875rem;">
						<span>Discount (<?php echo esc_html( strtoupper( $code ) ); ?>)</span>
						<span>-<?php echo wc_price( WC()->cart->get_coupon_discount_amount( $code ) ); ?></span>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<div class="cart-savings-callout">
				<?php _e( '✓ You are saving extra with volume discounts! Shipping calculated at checkout.', 'kurtis-boutique' ); ?>
			</div>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn-checkout">
				<span><?php _e( 'Proceed to Checkout', 'kurtis-boutique' ); ?></span>
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</a>
			<div style="text-align:center; margin-top: 10px; font-size: 0.75rem; color: #777;">
				🔒 <?php _e( '100% Safe & Secure Checkout · UPI, Cards & Cash on Delivery', 'kurtis-boutique' ); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php
	return ob_get_clean();
}

// 5. Ajax Add to Cart Handler
function kurtis_ajax_add_to_cart() {
	check_ajax_referer( 'kurtis_cart_nonce', 'nonce' );

	$product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
	$quantity   = isset( $_POST['quantity'] ) ? absint( $_POST['quantity'] ) : 1;
	$size       = isset( $_POST['size'] ) ? sanitize_text_field( $_POST['size'] ) : 'M';

	if ( ! $product_id ) {
		wp_send_json_error( array( 'message' => 'Invalid product' ) );
	}

	$cart_item_data = array( 'size' => $size );
	$cart_item_key  = WC()->cart->add_to_cart( $product_id, $quantity, 0, array(), $cart_item_data );

	if ( $cart_item_key ) {
		wp_send_json_success( array(
			'cart_count' => WC()->cart->get_cart_contents_count(),
			'html'       => kurtis_get_cart_drawer_html(),
		) );
	} else {
		wp_send_json_error( array( 'message' => 'Could not add to cart' ) );
	}
}
add_action( 'wp_ajax_kurtis_add_to_cart', 'kurtis_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_kurtis_add_to_cart', 'kurtis_ajax_add_to_cart' );

// 6. Ajax Get Cart Drawer Handler
function kurtis_ajax_get_cart_drawer() {
	check_ajax_referer( 'kurtis_cart_nonce', 'nonce' );

	wp_send_json_success( array(
		'cart_count' => WC()->cart->get_cart_contents_count(),
		'html'       => kurtis_get_cart_drawer_html(),
	) );
}
add_action( 'wp_ajax_kurtis_get_cart_drawer', 'kurtis_ajax_get_cart_drawer' );
add_action( 'wp_ajax_nopriv_kurtis_get_cart_drawer', 'kurtis_ajax_get_cart_drawer' );

// 7. Ajax Update / Remove Cart Item Handler
function kurtis_ajax_update_cart() {
	check_ajax_referer( 'kurtis_cart_nonce', 'nonce' );

	$cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( $_POST['cart_item_key'] ) : '';
	$action        = isset( $_POST['update_action'] ) ? sanitize_text_field( $_POST['update_action'] ) : '';

	if ( ! $cart_item_key ) {
		wp_send_json_error( array( 'message' => 'Invalid key' ) );
	}

	$cart = WC()->cart->get_cart();
	if ( isset( $cart[ $cart_item_key ] ) ) {
		$current_qty = $cart[ $cart_item_key ]['quantity'];

		if ( $action === 'plus' ) {
			WC()->cart->set_quantity( $cart_item_key, $current_qty + 1 );
		} elseif ( $action === 'minus' ) {
			if ( $current_qty > 1 ) {
				WC()->cart->set_quantity( $cart_item_key, $current_qty - 1 );
			} else {
				WC()->cart->remove_cart_item( $cart_item_key );
			}
		} elseif ( $action === 'remove' ) {
			WC()->cart->remove_cart_item( $cart_item_key );
		}
	}

	wp_send_json_success( array(
		'cart_count' => WC()->cart->get_cart_contents_count(),
		'html'       => kurtis_get_cart_drawer_html(),
	) );
}
add_action( 'wp_ajax_kurtis_update_cart', 'kurtis_ajax_update_cart' );
add_action( 'wp_ajax_nopriv_kurtis_update_cart', 'kurtis_ajax_update_cart' );

// 8. Ajax Apply Coupon Handler
function kurtis_ajax_apply_coupon() {
	check_ajax_referer( 'kurtis_cart_nonce', 'nonce' );

	$coupon_code = isset( $_POST['coupon_code'] ) ? sanitize_text_field( $_POST['coupon_code'] ) : '';

	if ( ! $coupon_code ) {
		wp_send_json_error( array( 'message' => 'Please enter a coupon code.' ) );
	}

	if ( WC()->cart->has_discount( $coupon_code ) ) {
		wp_send_json_error( array( 'message' => 'Coupon is already applied.' ) );
	}

	$applied = WC()->cart->apply_coupon( $coupon_code );

	if ( $applied ) {
		WC()->cart->calculate_totals();
		wp_send_json_success( array(
			'message'    => '🎉 Coupon applied successfully!',
			'html'       => kurtis_get_cart_drawer_html(),
			'cart_count' => WC()->cart->get_cart_contents_count(),
		) );
	} else {
		wp_send_json_error( array( 'message' => 'Invalid or expired coupon code.' ) );
	}
}
add_action( 'wp_ajax_kurtis_apply_coupon', 'kurtis_ajax_apply_coupon' );
add_action( 'wp_ajax_nopriv_kurtis_apply_coupon', 'kurtis_ajax_apply_coupon' );

// 9. Instant Live Search Auto-Suggest Handler
function kurtis_ajax_live_search() {
	$search_query = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';
	if ( empty( $search_query ) || strlen( $search_query ) < 2 ) {
		wp_send_json_error( array( 'message' => 'Please enter at least 2 characters.' ) );
	}

	$args = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		's'              => $search_query,
		'posts_per_page' => 5,
	);

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		wp_send_json_error( array( 'message' => 'No products found' ) );
	}

	ob_start();
	?>
	<div class="search-live-list" style="display: flex; flex-direction: column; gap: 8px;">
		<?php while ( $query->have_posts() ) : $query->the_post();
			global $product;
			if ( ! $product ) {
				$product = wc_get_product( get_the_ID() );
			}
			if ( ! $product ) continue;
		?>
			<a href="<?php the_permalink(); ?>" style="display: flex; align-items: center; gap: 12px; padding: 8px 12px; border-radius: 8px; text-decoration: none; color: inherit; background: var(--color-bg-gray); transition: background 0.15s ease;">
				<div style="width: 44px; height: 56px; border-radius: 4px; overflow: hidden; flex-shrink: 0; background: #eee;">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( array( 44, 56 ), array( 'style' => 'width:100%;height:100%;object-fit:cover;' ) ); ?>
					<?php else : ?>
						<img src="https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=100&q=80" style="width:100%;height:100%;object-fit:cover;" alt="<?php the_title_attribute(); ?>">
					<?php endif; ?>
				</div>
				<div style="flex: 1; min-width: 0;">
					<div style="font-size: 0.875rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--color-text-main);"><?php the_title(); ?></div>
					<div style="font-size: 0.8125rem; font-weight: 700; color: var(--color-primary); margin-top: 2px;"><?php echo wc_price( $product->get_price() ); ?></div>
				</div>
				<span style="font-size: 0.75rem; font-weight: 700; color: var(--color-primary); text-transform: uppercase;">View →</span>
			</a>
		<?php endwhile; wp_reset_postdata(); ?>
		<div style="text-align: center; margin-top: 8px;">
			<a href="<?php echo esc_url( home_url( '/?post_type=product&s=' . urlencode( $search_query ) ) ); ?>" style="color: var(--color-primary); font-size: 0.8125rem; font-weight: 700; text-decoration: underline;">
				View all results for "<?php echo esc_html( $search_query ); ?>" →
			</a>
		</div>
	</div>
	<?php
	$html = ob_get_clean();
	wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_kurtis_live_search', 'kurtis_ajax_live_search' );
add_action( 'wp_ajax_nopriv_kurtis_live_search', 'kurtis_ajax_live_search' );

// 6. Evara.me Collections & Shop Permalinks Parity
function kurtis_setup_collections_rewrites() {
	// Map /collections/all/ to WooCommerce Shop product archive
	add_rewrite_rule( '^collections/all/?$', 'index.php?post_type=product', 'top' );
}
add_action( 'init', 'kurtis_setup_collections_rewrites' );

// Filter WooCommerce shop permalink to /collections/all/
function kurtis_filter_shop_permalink( $permalink ) {
	return home_url( '/collections/all/' );
}
add_filter( 'woocommerce_get_shop_page_permalink', 'kurtis_filter_shop_permalink' );

// 301 Redirect old /product-category/ and /shop/ to /collections/
function kurtis_redirect_legacy_catalog_urls() {
	if ( is_admin() || wp_doing_ajax() ) {
		return;
	}

	$uri = $_SERVER['REQUEST_URI'] ?? '';

	// 1. Redirect /shop or /shop/ to /collections/all/
	if ( preg_match( '#^/shop/?$#i', $uri ) ) {
		wp_safe_redirect( home_url( '/collections/all/' ), 301 );
		exit;
	}

	// 2. Redirect /product-category/<slug>/ to /collections/<slug>/
	if ( preg_match( '#^/product-category/(.+)$#i', $uri, $matches ) ) {
		wp_safe_redirect( home_url( '/collections/' . $matches[1] ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'kurtis_redirect_legacy_catalog_urls' );

