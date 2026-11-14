<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- 1. Top Announcement Marquee Bar -->
<?php
$ticker_1 = get_theme_mod( 'kurtis_ticker_text_1', '🪔 FESTIVE SALE IS LIVE! BUY 2 GET 10% OFF' );
$ticker_2 = get_theme_mod( 'kurtis_ticker_text_2', 'BUY 3 ITEMS GET 15% OFF ✨ · BUY 4+ ITEMS GET 20% OFF ✨ · COD AVAILABLE ACROSS INDIA' );
?>
<div class="marquee-bar">
	<div class="marquee-inner">
		<div class="marquee-item"><?php echo esc_html( $ticker_1 ); ?> <span class="sep">•</span></div>
		<div class="marquee-item"><?php echo esc_html( $ticker_2 ); ?> <span class="sep">•</span></div>
		<div class="marquee-item">🚚 FREE SHIPPING ON ORDERS WITH 2+ ITEMS <span class="sep">•</span></div>
		<div class="marquee-item"><?php echo esc_html( $ticker_1 ); ?> <span class="sep">•</span></div>
		<div class="marquee-item"><?php echo esc_html( $ticker_2 ); ?> <span class="sep">•</span></div>
		<div class="marquee-item">🚚 FREE SHIPPING ON ORDERS WITH 2+ ITEMS <span class="sep">•</span></div>
	</div>
</div>

<!-- 2. Sticky Site Header -->
<header class="site-header">
	<div class="container">
		<div class="header-top">
			<!-- Header Left: Hamburger & Search -->
			<div class="header-left">
				<button type="button" class="header-icon-btn mobile-menu-toggle" aria-label="Open Navigation Menu">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
				</button>
				<button type="button" class="header-icon-btn search-modal-toggle" aria-label="Search Catalog">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
				</button>
			</div>

			<!-- Header Center: Brand Logo -->
			<div class="header-brand">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php elseif ( file_exists( get_template_directory() . '/assets/images/banni-logo.png' ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo-link">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/banni-logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="brand-logo-img">
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo">
						<?php bloginfo( 'name' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- Header Right: Account & Cart Bag -->
			<div class="header-right">
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="header-icon-btn" aria-label="My Account">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
				</a>
				<button type="button" class="header-icon-btn cart-drawer-trigger" aria-label="Open Cart Bag">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
					<span class="cart-count-badge header-cart-count">
						<?php echo function_exists( 'WC' ) && WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?>
					</span>
				</button>
			</div>
		</div>

		<!-- Desktop Navigation Menu -->
		<nav class="header-nav">
			<ul class="nav-menu">
				<li class="nav-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link"><?php _e( 'Home', 'kurtis-boutique' ); ?></a></li>
				<li class="nav-item"><a href="<?php echo esc_url( home_url( '/collections/all/' ) ); ?>" class="nav-link"><?php _e( 'Shop', 'kurtis-boutique' ); ?></a></li>
				<li class="nav-item"><a href="<?php echo esc_url( home_url( '/collections/corset-back/' ) ); ?>" class="nav-link"><?php _e( 'Corset Back', 'kurtis-boutique' ); ?></a></li>
				<li class="nav-item"><a href="<?php echo esc_url( home_url( '/collections/essential-solids/' ) ); ?>" class="nav-link"><?php _e( 'Essential Solids', 'kurtis-boutique' ); ?></a></li>
				<li class="nav-item">
					<a href="<?php echo esc_url( home_url( '/collections/' ) ); ?>" class="nav-link"><?php _e( 'Collections ▾', 'kurtis-boutique' ); ?></a>
					<ul class="sub-menu">
						<li><a href="<?php echo esc_url( home_url( '/collections/' ) ); ?>" style="font-weight: 700; color: var(--color-primary); border-bottom: 1px dashed var(--color-border);">✨ View All Collections</a></li>
						<li><a href="<?php echo esc_url( home_url( '/collections/corset-back/' ) ); ?>">Corset Back Kurtis</a></li>
						<li><a href="<?php echo esc_url( home_url( '/collections/square-neck/' ) ); ?>">Square Neck Kurtis</a></li>
						<li><a href="<?php echo esc_url( home_url( '/collections/boat-neck/' ) ); ?>">Boat Neck Kurtis</a></li>
						<li><a href="<?php echo esc_url( home_url( '/collections/bell-sleeves/' ) ); ?>">Bell Sleeves Kurtis</a></li>
						<li><a href="<?php echo esc_url( home_url( '/collections/halter-neck/' ) ); ?>">Halter Neck Kurtis</a></li>
						<li><a href="<?php echo esc_url( home_url( '/collections/festive-co-ords/' ) ); ?>">Festive Co-ords</a></li>
						<li><a href="<?php echo esc_url( home_url( '/collections/sleeveless/' ) ); ?>">Sleeveless Kurtis</a></li>
						<li><a href="<?php echo esc_url( home_url( '/collections/bottoms-pants/' ) ); ?>">Bottoms & Pants</a></li>
					</ul>
				</li>
				<li class="nav-item"><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" class="nav-link"><?php _e( 'About', 'kurtis-boutique' ); ?></a></li>
				<li class="nav-item"><a href="<?php echo esc_url( home_url( '/track-order/' ) ); ?>" class="nav-link"><?php _e( 'Track Order', 'kurtis-boutique' ); ?></a></li>
			</ul>
		</nav>
	</div>
</header>

<!-- 3. Off-Canvas Mobile Navigation Drawer -->
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
<aside class="mobile-nav-drawer" id="mobileNavDrawer" aria-label="Mobile Navigation">
	<div class="mobile-nav-header">
		<span class="brand-logo" style="font-family: var(--font-brand); font-size: 1.8rem; color: var(--color-primary);"><?php bloginfo( 'name' ); ?></span>
		<button type="button" class="cart-drawer-close" id="mobileNavClose" aria-label="Close Navigation">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
		</button>
	</div>
	<div class="mobile-nav-body">
		<ul class="mobile-nav-list">
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
			<li><a href="<?php echo esc_url( home_url( '/collections/all/' ) ); ?>" style="font-weight: 700; color: var(--color-primary);">Shop (All Kurtis)</a></li>
			<li><a href="<?php echo esc_url( home_url( '/collections/' ) ); ?>">✨ All Collections Hub</a></li>
			<li><a href="<?php echo esc_url( home_url( '/collections/corset-back/' ) ); ?>">Corset Back Kurtis</a></li>
			<li><a href="<?php echo esc_url( home_url( '/collections/square-neck/' ) ); ?>">Square Neck Kurtis</a></li>
			<li><a href="<?php echo esc_url( home_url( '/collections/boat-neck/' ) ); ?>">Boat Neck Kurtis</a></li>
			<li><a href="<?php echo esc_url( home_url( '/collections/bell-sleeves/' ) ); ?>">Bell Sleeves Kurtis</a></li>
			<li><a href="<?php echo esc_url( home_url( '/collections/essential-solids/' ) ); ?>">Essential Solids</a></li>
			<li><a href="<?php echo esc_url( home_url( '/collections/festive-co-ords/' ) ); ?>">Festive Co-ords</a></li>
			<li><a href="<?php echo esc_url( home_url( '/collections/bottoms-pants/' ) ); ?>">Bottoms & Pants</a></li>
			<li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">About Our Brand</a></li>
			<li><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">My Account</a></li>
			<li><a href="<?php echo esc_url( home_url( '/track-order/' ) ); ?>">Track Your Order</a></li>
		</ul>
	</div>
</aside>
