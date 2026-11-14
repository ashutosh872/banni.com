<?php
/**
 * Footer Template - Kurtis Boutique
 */

$about_text    = get_theme_mod( 'kurtis_about_text', 'Handcrafted pure cotton kurtis designed for effortless elegance, all-day comfort, and modern Indian living.' );
$support_phone = get_theme_mod( 'kurtis_support_phone', '+91 98765 43210' );
$support_email = get_theme_mod( 'kurtis_support_email', 'support@kurtisboutique.com' );
$gstin         = get_theme_mod( 'kurtis_gstin', 'GSTIN: 07AAAAA0000A1Z5' );
$insta_url     = get_theme_mod( 'kurtis_insta_url', 'https://instagram.com' );
?>

<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<!-- Column 1: Brand Story & Support Details -->
			<div class="footer-col">
				<div style="margin-bottom: 12px;">
					<?php if ( file_exists( get_template_directory() . '/assets/images/banni-logo.png' ) ) : ?>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/banni-logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="max-height: 48px; width: auto;">
					<?php else : ?>
						<h4 style="font-family: var(--font-brand); color: var(--color-primary); font-size: 2rem; margin-bottom: 8px;"><?php bloginfo( 'name' ); ?></h4>
					<?php endif; ?>
				</div>
				<p style="margin-bottom: 16px;"><?php echo esc_html( $about_text ); ?></p>
				<p style="font-size: 0.8125rem; color: #555; margin-bottom: 6px;">
					📞 <strong>WhatsApp / Support:</strong> <?php echo esc_html( $support_phone ); ?>
				</p>
				<p style="font-size: 0.8125rem; color: #555; margin-bottom: 6px;">
					✉️ <strong>Email:</strong> <?php echo esc_html( $support_email ); ?>
				</p>
				<p style="font-size: 0.75rem; color: #888; margin-top: 10px;">
					<?php echo esc_html( $gstin ); ?> · Registered in India
				</p>
			</div>

			<!-- Column 2: Quick Links -->
			<div class="footer-col">
				<h4><?php _e( 'Explore', 'kurtis-boutique' ); ?></h4>
				<ul class="footer-links">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
					<li><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">All Kurtis</a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/corset-back/' ) ); ?>">Corset Back Kurtis</a></li>
					<li><a href="<?php echo esc_url( home_url( '/product-category/festive-co-ords/' ) ); ?>">Festive Co-ords</a></li>
					<li><a href="<?php echo esc_url( home_url( '/track-order/' ) ); ?>">Track Your Order</a></li>
					<li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">About Our Brand</a></li>
				</ul>
			</div>

			<!-- Column 3: Store Policies -->
			<div class="footer-col">
				<h4><?php _e( 'Policies', 'kurtis-boutique' ); ?></h4>
				<ul class="footer-links">
					<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
					<li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a></li>
					<li><a href="<?php echo esc_url( home_url( '/shipping-policy/' ) ); ?>">Shipping & Delivery</a></li>
					<li><a href="<?php echo esc_url( home_url( '/refund-policy/' ) ); ?>">Refund & Exchange</a></li>
					<li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms of Service</a></li>
				</ul>
			</div>

			<!-- Column 4: Newsletter -->
			<div class="footer-col">
				<h4><?php _e( 'Join The Club', 'kurtis-boutique' ); ?></h4>
				<p><?php _e( 'Be the first to know when new kurtis drop. No spam, ever.', 'kurtis-boutique' ); ?></p>
				<form class="footer-newsletter-input" onsubmit="event.preventDefault(); alert('Thank you for subscribing! Use code WELCOME10 for 10% off.');">
					<input type="email" class="footer-input" placeholder="Enter your email" required>
					<button type="submit" class="footer-btn-sub"><?php _e( 'Subscribe', 'kurtis-boutique' ); ?></button>
				</form>
				<div style="margin-top: 18px; display: flex; gap: 12px;">
					<a href="<?php echo esc_url( $insta_url ); ?>" target="_blank" aria-label="Instagram" style="color: var(--color-primary); font-size: 1.2rem;">📸</a>
					<a href="#" aria-label="Facebook" style="color: var(--color-primary); font-size: 1.2rem;">📘</a>
					<a href="#" aria-label="Pinterest" style="color: var(--color-primary); font-size: 1.2rem;">📌</a>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div>
				© <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved. Crafted for comfort.
			</div>
			<div class="footer-payments">
				<span class="pay-badge">UPI</span>
				<span class="pay-badge">GPay</span>
				<span class="pay-badge">PhonePe</span>
				<span class="pay-badge">Paytm</span>
				<span class="pay-badge">Cards</span>
				<span class="pay-badge">Cash on Delivery</span>
			</div>
		</div>
	</div>
</footer>

<!-- 4. Interactive Size Chart Modal -->
<div class="modal-overlay" id="sizeChartModal" style="display: none;">
	<div class="modal-dialog">
		<button type="button" class="modal-close" id="sizeChartCloseBtn" aria-label="Close Size Guide">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
		</button>
		<div class="heading-eyebrow" style="text-align: center;"><?php _e( 'Fit & Measurement Guide', 'kurtis-boutique' ); ?></div>
		<h3 class="modal-title"><?php _e( 'Size Guide', 'kurtis-boutique' ); ?></h3>
		<p style="text-align: center; font-size: 0.875rem; color: var(--color-text-muted);">
			Finding your perfect fit is easy. All measurements are in inches and taken on the body — not the garment. When in doubt, size up.
		</p>
		
		<table class="size-table">
			<thead>
				<tr>
					<th>Size</th>
					<th>Chest (in)</th>
					<th>Waist (in)</th>
					<th>Hip (in)</th>
					<th>Kurti Length (in)</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><strong>XS</strong></td>
					<td>32"</td>
					<td>32"</td>
					<td>34"</td>
					<td>44"</td>
				</tr>
				<tr>
					<td><strong>S</strong></td>
					<td>34"</td>
					<td>34"</td>
					<td>36"</td>
					<td>44"</td>
				</tr>
				<tr>
					<td><strong>M</strong></td>
					<td>36"</td>
					<td>36"</td>
					<td>38"</td>
					<td>44"</td>
				</tr>
				<tr>
					<td><strong>L</strong></td>
					<td>38"</td>
					<td>38"</td>
					<td>40"</td>
					<td>45"</td>
				</tr>
				<tr>
					<td><strong>XL</strong></td>
					<td>40"</td>
					<td>40"</td>
					<td>42"</td>
					<td>45"</td>
				</tr>
				<tr>
					<td><strong>XXL</strong></td>
					<td>42"</td>
					<td>42"</td>
					<td>44"</td>
					<td>46"</td>
				</tr>
			</tbody>
		</table>

		<div style="font-size: 0.8125rem; color: var(--color-text-muted); line-height: 1.6;">
			<h4 style="color: var(--color-text-main); font-size: 0.875rem; margin-bottom: 6px; text-transform: uppercase;">How to Measure?</h4>
			<p>• <strong>Bust:</strong> Measure around the fullest part of your chest, keeping tape parallel to the floor.</p>
			<p>• <strong>Waist:</strong> Measure around your natural waistline, the narrowest part of your torso.</p>
			<p>• <strong>Hip:</strong> Measure around the fullest part of your hips, about 8 inches below waist.</p>
			<p>• <strong>Kurti Length:</strong> Measured from highest shoulder point straight down to the bottom hem.</p>
		</div>
	</div>
</div>

<!-- 5. Slide-Out Ajax Cart Drawer -->
<div class="cart-drawer-overlay" id="cartDrawerOverlay"></div>
<aside class="cart-drawer" id="cartDrawer" aria-label="Shopping Cart Drawer">
	<div id="cartDrawerContent">
		<?php echo kurtis_get_cart_drawer_html(); ?>
	</div>
</aside>

<!-- 6. Search Overlay Modal -->
<div class="modal-overlay" id="searchModal" style="display: none;">
	<div class="modal-dialog" style="max-width: 520px;">
		<button type="button" class="modal-close" id="searchModalClose" aria-label="Close Search">
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
		</button>
		<div class="heading-eyebrow" style="text-align: center; margin-bottom: 4px;"><?php _e( 'Find Your Perfect Kurti', 'kurtis-boutique' ); ?></div>
		<h3 class="modal-title" style="margin-bottom: 18px;"><?php _e( 'Search Catalog', 'kurtis-boutique' ); ?></h3>
		<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchModalForm">
			<input type="hidden" name="post_type" value="product">
			<div style="display: flex; gap: 8px;">
				<input type="search" class="footer-input" id="searchModalInput" placeholder="Search cotton, corset, square neck..." name="s" autocomplete="off" required style="font-size: 1rem; border: 1.5px solid var(--color-border); border-radius: var(--radius-sm); padding: 12px 16px;">
				<button type="submit" class="footer-btn-sub" style="padding: 0 24px; font-weight: 700; border-radius: var(--radius-sm);"><?php _e( 'Search', 'kurtis-boutique' ); ?></button>
			</div>
		</form>
		<div id="searchLiveResults" style="margin-top: 16px; max-height: 320px; overflow-y: auto; display: none;"></div>
		<div style="margin-top: 20px; text-align: center; font-size: 0.8125rem; color: var(--color-text-muted);">
			Popular: 
			<a href="<?php echo esc_url( home_url( '/?post_type=product&s=cotton' ) ); ?>" style="color: var(--color-primary); text-decoration: underline; margin: 0 4px;">Cotton</a> · 
			<a href="<?php echo esc_url( home_url( '/?post_type=product&s=corset' ) ); ?>" style="color: var(--color-primary); text-decoration: underline; margin: 0 4px;">Corset</a> · 
			<a href="<?php echo esc_url( home_url( '/?post_type=product&s=square+neck' ) ); ?>" style="color: var(--color-primary); text-decoration: underline; margin: 0 4px;">Square Neck</a> · 
			<a href="<?php echo esc_url( home_url( '/?post_type=product&s=bell+sleeves' ) ); ?>" style="color: var(--color-primary); text-decoration: underline; margin: 0 4px;">Bell Sleeves</a>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
