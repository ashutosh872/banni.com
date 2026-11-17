const fs = require('fs');
const path = require('path');

const BASE_URL = 'http://localhost:8000';
const DOCS_DIR = path.resolve(__dirname, '..', 'docs');
const THEME_DIR = path.resolve(__dirname, '..', 'wp-content', 'themes', 'kurtis-boutique');
const WC_CSS_DIR = path.resolve(__dirname, '..', 'wp-content', 'plugins', 'woocommerce', 'assets', 'css');

// Ensure directories exist
fs.mkdirSync(path.join(DOCS_DIR, 'assets', 'css'), { recursive: true });
fs.mkdirSync(path.join(DOCS_DIR, 'assets', 'js'), { recursive: true });
fs.mkdirSync(path.join(DOCS_DIR, 'assets', 'fonts'), { recursive: true });
fs.mkdirSync(path.join(DOCS_DIR, 'assets', 'images'), { recursive: true });

// Copy font
const fontSrc = path.join(THEME_DIR, 'assets', 'fonts', 'Samarkan-Normal.ttf');
if (fs.existsSync(fontSrc)) {
    fs.copyFileSync(fontSrc, path.join(DOCS_DIR, 'assets', 'fonts', 'Samarkan-Normal.ttf'));
    console.log('Copied font Samarkan-Normal.ttf');
}

// Copy images
const imagesSrc = path.join(THEME_DIR, 'assets', 'images');
if (fs.existsSync(imagesSrc)) {
    for (const file of fs.readdirSync(imagesSrc)) {
        fs.copyFileSync(path.join(imagesSrc, file), path.join(DOCS_DIR, 'assets', 'images', file));
    }
    console.log('Copied theme images');
}

// Copy WooCommerce CSS
const wcFiles = ['woocommerce-layout.css', 'woocommerce-smallscreen.css', 'woocommerce.css'];
for (const f of wcFiles) {
    const src = path.join(WC_CSS_DIR, f);
    if (fs.existsSync(src)) {
        fs.copyFileSync(src, path.join(DOCS_DIR, 'assets', 'css', f));
    }
}
console.log('Copied WooCommerce CSS');

// Copy dossier files
const dossierHtml = path.resolve(__dirname, '..', 'saaj_of_banni_dossier.html');
if (fs.existsSync(dossierHtml)) {
    fs.copyFileSync(dossierHtml, path.join(DOCS_DIR, 'dossier.html'));
    console.log('Copied dossier.html');
}
const dossierPdf = path.resolve(__dirname, '..', 'saaj_of_banni_master_dossier.pdf');
if (fs.existsSync(dossierPdf)) {
    fs.copyFileSync(dossierPdf, path.join(DOCS_DIR, 'saaj_of_banni_master_dossier.pdf'));
    console.log('Copied saaj_of_banni_master_dossier.pdf');
}

// Copy and adjust style.css
let styleCss = fs.readFileSync(path.join(THEME_DIR, 'style.css'), 'utf8');
styleCss = styleCss.replace(/assets\/fonts\/Samarkan-Normal\.ttf/g, '../fonts/Samarkan-Normal.ttf');
fs.writeFileSync(path.join(DOCS_DIR, 'assets', 'css', 'style.css'), styleCss, 'utf8');
console.log('Written adjusted style.css');

// Copy main.js
fs.copyFileSync(path.join(THEME_DIR, 'assets', 'js', 'main.js'), path.join(DOCS_DIR, 'assets', 'js', 'main.js'));
console.log('Copied main.js');

// Create .nojekyll
fs.writeFileSync(path.join(DOCS_DIR, '.nojekyll'), '', 'utf8');

const demoBannerHtml = `
<!-- Demo Top Navigation Banner -->
<div id="demoGlobalBar" style="background: linear-gradient(90deg, #1f1f1f, #2c2c2c); color: #fff; padding: 8px 16px; font-size: 12px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #E5520A; z-index: 99999; position: relative;">
  <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
    <span style="background: #E5520A; color: #fff; font-weight: 700; padding: 2px 8px; border-radius: 4px; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px;">Live Demo</span>
    <span style="font-weight: 600;">Saaj of Banni</span>
    <span style="color: #999;">|</span>
    <nav style="display: inline-flex; gap: 12px; align-items: center;">
      <a href="index.html" style="color: #fff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#E5520A'" onmouseout="this.style.color='#fff'">🏠 Home</a>
      <a href="shop.html" style="color: #fff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#E5520A'" onmouseout="this.style.color='#fff'">🛍️ All Kurtis</a>
      <a href="collections.html" style="color: #fff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#E5520A'" onmouseout="this.style.color='#fff'">📂 Collections Hub</a>
      <a href="product.html" style="color: #fff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#E5520A'" onmouseout="this.style.color='#fff'">👗 Product View (PDP)</a>
      <a href="about-us.html" style="color: #fff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#E5520A'" onmouseout="this.style.color='#fff'">📖 Our Story</a>
      <a href="track-order.html" style="color: #fff; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#E5520A'" onmouseout="this.style.color='#fff'">📦 Track Order</a>
    </nav>
  </div>
  <div style="display: flex; align-items: center; gap: 12px;">
    <a href="dossier.html" target="_blank" style="background: #333; color: #fff; text-decoration: none; padding: 3px 10px; border-radius: 4px; border: 1px solid #555; transition: all 0.2s;" onmouseover="this.style.borderColor='#E5520A'" onmouseout="this.style.borderColor='#555'">📄 Technical Dossier</a>
    <a href="https://github.com/ashutosh872/banni.com" target="_blank" style="background: #E5520A; color: #fff; text-decoration: none; padding: 3px 10px; border-radius: 4px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
      <svg height="12" width="12" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path></svg>
      GitHub
    </a>
  </div>
</div>
`;

const demoInteractiveJs = `
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="assets/js/main.js"></script>
<script>
// Mock wc_add_to_cart_params and kurtis_ajax
window.kurtis_ajax = { ajax_url: '#' };
window.wc_add_to_cart_params = { ajax_url: '#', wc_ajax_url: '#', i18n_view_cart: 'View cart', cart_url: '#', is_cart: '', cart_redirect_after_add: 'no' };

// Client-side products list
window.kurtis_demo_products = [
  { name: 'Nazia Square Neck Printed Cotton Kurti', price: '₹1,199', original: '₹1,499', discount: '20% OFF', url: 'product.html', img: 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=600&q=80' },
  { name: 'Aanya Corset Back Pure Cotton Kurti', price: '₹1,249', original: '₹1,599', discount: '22% OFF', url: 'product.html', img: 'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=600&q=80' },
  { name: 'Vrishti Flared Bell Sleeves Kurti', price: '₹1,399', original: '₹1,749', discount: '20% OFF', url: 'product.html', img: 'https://images.unsplash.com/photo-1617627143750-d86bc21e42bb?auto=format&fit=crop&w=600&q=80' },
  { name: 'Meera Classic Boat Neck Kurti', price: '₹1,099', original: '₹1,299', discount: '15% OFF', url: 'product.html', img: 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&w=600&q=80' },
  { name: 'Tara Everyday Solid Linen-Blend Kurti', price: '₹999', original: '₹1,199', discount: '17% OFF', url: 'product.html', img: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80' },
  { name: 'Rhea Halter Neck Bohemian Kurti', price: '₹1,449', original: '₹1,799', discount: '19% OFF', url: 'product.html', img: 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=600&q=80' },
  { name: 'Diya Sleeveless Summer Short Kurti', price: '₹899', original: '₹1,099', discount: '18% OFF', url: 'product.html', img: 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=600&q=80' },
  { name: 'Kavya Festive Printed Co-ord Kurti Set', price: '₹1,799', original: '₹2,299', discount: '22% OFF', url: 'product.html', img: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80' },
  { name: 'Off-White Pure Cotton Straight Pants', price: '₹699', original: '₹899', discount: '22% OFF', url: 'product.html', img: 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=600&q=80' }
];

// Interactive cart state
window.kurtis_cart = [
  { name: 'Nazia Square Neck Printed Cotton Kurti', size: 'M', qty: 1, price: 1199, img: 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=150&q=80' }
];
window.kurtis_coupon_applied = false;

function renderCartDrawer() {
  const container = $('#cartDrawerItems');
  const countEl = $('.kurtis-cart-count');
  let subtotal = 0;
  let totalQty = 0;

  if (container.length) {
    if (window.kurtis_cart.length === 0) {
      container.html('<div style="text-align:center; padding: 40px 20px; color: #888;"><p style="font-size: 1.1rem; margin-bottom: 12px;">Your shopping bag is empty.</p><a href="shop.html" class="kurtis-btn-primary" style="display:inline-block; padding: 10px 24px; text-decoration:none;">Explore Kurtis</a></div>');
    } else {
      let html = '';
      window.kurtis_cart.forEach((item, idx) => {
        subtotal += item.price * item.qty;
        totalQty += item.qty;
        html += '<div style="display: flex; gap: 14px; padding: 14px 0; border-bottom: 1px solid var(--color-border); align-items: center;">';
        html += '<img src="' + item.img + '" style="width: 60px; height: 80px; object-fit: cover; border-radius: 4px;">';
        html += '<div style="flex: 1;">';
        html += '<div style="font-weight: 600; font-size: 0.9rem; color: var(--color-text-main); margin-bottom: 4px;">' + item.name + '</div>';
        html += '<div style="font-size: 0.8rem; color: var(--color-text-muted); margin-bottom: 6px;">Size: ' + item.size + '</div>';
        html += '<div style="display:flex; justify-content:space-between; align-items:center;">';
        html += '<div style="display:flex; align-items:center; border: 1px solid var(--color-border); border-radius: 4px; overflow:hidden;">';
        html += '<button onclick="updateCartQty(' + idx + ', -1)" style="border:none; background:#fff; padding: 2px 8px; cursor:pointer;">-</button>';
        html += '<span style="padding: 0 8px; font-size: 0.85rem; font-weight:600;">' + item.qty + '</span>';
        html += '<button onclick="updateCartQty(' + idx + ', 1)" style="border:none; background:#fff; padding: 2px 8px; cursor:pointer;">+</button>';
        html += '</div>';
        html += '<div style="font-weight:700; color: var(--color-primary);">₹' + (item.price * item.qty).toLocaleString('en-IN') + '</div>';
        html += '<button onclick="removeCartItem(' + idx + ')" style="border:none; background:none; color: #999; cursor:pointer; font-size: 1.1rem; margin-left: 8px;">×</button>';
        html += '</div></div></div>';
      });
      container.html(html);
    }
  }

  // Update Free Shipping Progress Bar (Goal: ₹1999)
  const goal = 1999;
  const progressPercent = Math.min(100, Math.round((subtotal / goal) * 100));
  $('#freeShippingProgressBar').css('width', progressPercent + '%');
  if (subtotal >= goal) {
    $('#freeShippingTierMsg').html('🎉 <strong>Congratulations!</strong> You qualify for <strong>FREE PANTS</strong> + Free Express Delivery!');
  } else {
    const diff = goal - subtotal;
    $('#freeShippingTierMsg').html('Add ₹' + diff.toLocaleString('en-IN') + ' more to unlock <strong>FREE PANTS</strong>!');
  }

  // Subtotal & Coupons
  let finalTotal = subtotal;
  if (window.kurtis_coupon_applied) {
    const discount = Math.round(subtotal * 0.1);
    finalTotal -= discount;
    $('#cartDrawerDiscountRow').show().find('#cartDrawerDiscountAmount').text('-₹' + discount.toLocaleString('en-IN'));
  } else {
    $('#cartDrawerDiscountRow').hide();
  }
  $('#cartDrawerSubtotal').text('₹' + finalTotal.toLocaleString('en-IN'));
  countEl.text(totalQty);
}

function updateCartQty(idx, delta) {
  if (window.kurtis_cart[idx]) {
    window.kurtis_cart[idx].qty += delta;
    if (window.kurtis_cart[idx].qty <= 0) {
      window.kurtis_cart.splice(idx, 1);
    }
    renderCartDrawer();
  }
}

function removeCartItem(idx) {
  if (window.kurtis_cart[idx]) {
    window.kurtis_cart.splice(idx, 1);
    renderCartDrawer();
  }
}

function applyDemoCoupon() {
  const code = $('#couponInput').val().trim().toUpperCase();
  if (code === 'WELCOME10') {
    window.kurtis_coupon_applied = true;
    alert('Coupon WELCOME10 applied! 10% discount deducted from your cart total.');
    renderCartDrawer();
  } else if (code) {
    alert('Code "' + code + '" not recognized. Try promo code: WELCOME10');
  }
}

// Live Search in Static Mode
$(document).on('input', '#searchModalInput', function() {
  const query = $(this).val().toLowerCase().trim();
  const resultsBox = $('#searchLiveResults');
  if (query.length < 2) {
    resultsBox.slideUp(150).empty();
    return;
  }
  const matches = window.kurtis_demo_products.filter(p => p.name.toLowerCase().includes(query));
  if (matches.length > 0) {
    let html = '<div style="display: grid; gap: 10px; padding: 10px;">';
    matches.forEach(m => {
      html += '<a href="' + m.url + '" style="display: flex; gap: 12px; align-items:center; text-decoration: none; padding: 8px; border-radius: 6px; background: #FAF8F5; transition: background 0.2s;" onmouseover="this.style.background=\\'#F5F0E8\\'" onmouseout="this.style.background=\\'#FAF8F5\\'">';
      html += '<img src="' + m.img + '" style="width: 44px; height: 56px; object-fit: cover; border-radius: 4px;">';
      html += '<div><div style="font-weight: 600; font-size: 0.85rem; color: #1F1F1F;">' + m.name + '</div>';
      html += '<div style="font-size: 0.8rem; color: #E5520A; font-weight:700;">' + m.price + ' <span style="font-size: 0.75rem; color:#888; text-decoration:line-through; font-weight:normal;">' + m.original + '</span></div></div>';
      html += '</a>';
    });
    html += '</div>';
    resultsBox.html(html).slideDown(150);
  } else {
    resultsBox.html('<div style="text-align:center; padding: 16px; font-size: 0.85rem; color: #888;">No matching kurtis found for "' + query + '".</div>').slideDown(150);
  }
});

// Pincode Checker in Static Mode
$(document).on('click', '#checkPincodeBtn', function() {
  const pin = $('#pincodeInput').val().trim();
  const resultEl = $('#pincodeResult');
  if (/^\\d{6}$/.test(pin)) {
    resultEl.html('<div style="color: #2E7D32; font-weight: 600; padding: 8px 12px; background: #E8F5E9; border-radius: 6px; margin-top: 8px;">✓ Delivery available to ' + pin + '! Express 2-3 Day Shipping via Delhivery. Cash on Delivery available.</div>').show();
  } else {
    resultEl.html('<div style="color: #C62828; font-weight: 600; padding: 8px 12px; background: #FFEBEE; border-radius: 6px; margin-top: 8px;">Please enter a valid 6-digit Indian Postal Pincode.</div>').show();
  }
});

// Order Tracker in Static Mode
$(document).on('submit', '#trackOrderForm, .kurtis-track-form', function(e) {
  e.preventDefault();
  const orderId = $('#orderIdInput').val() || '35';
  const resultBox = $('#trackOrderResult');
  if (resultBox.length) {
    resultBox.html('<div style="background: #FAF8F5; border: 1px solid #E8E2D8; border-radius: 8px; padding: 20px; margin-top: 20px;">' +
      '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 14px; border-bottom: 1px solid #eee; padding-bottom: 10px;">' +
      '<span style="font-weight:700; font-size: 1.1rem; color: #1F1F1F;">Order #' + orderId + ' Details</span>' +
      '<span style="background: #E8F5E9; color: #2E7D32; font-weight:700; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem;">IN TRANSIT</span></div>' +
      '<p><strong>Courier:</strong> Delhivery Air Express (AWB: DEL83921849)</p>' +
      '<p><strong>Estimated Delivery:</strong> Tomorrow by 7:00 PM</p>' +
      '<p><strong>Shipping To:</strong> Customer at Sector 62, Noida, Uttar Pradesh - 201309</p>' +
      '<p style="margin-top: 10px; font-weight:600; color: #E5520A;">Item: 1x Nazia Square Neck Printed Cotton Kurti (Size: M, ₹1,199)</p>' +
      '</div>').slideDown(200);
  }
});

// Global Add to Cart interceptor for demo
$(document).on('click', '.kurtis-add-to-cart-btn, .single_add_to_cart_button', function(e) {
  e.preventDefault();
  const title = $('.kurtis-pdp-title').text() || 'Nazia Square Neck Printed Cotton Kurti';
  const size = $('.kurtis-size-pill.selected').text() || 'M';
  window.kurtis_cart.push({
    name: title.trim(),
    size: size.trim(),
    qty: 1,
    price: 1199,
    img: 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=150&q=80'
  });
  renderCartDrawer();
  $('#cartDrawer').addClass('active');
  $('#cartDrawerOverlay').addClass('active');
});

// Checkout Button Demo Alert
$(document).on('click', '#cartCheckoutBtn', function(e) {
  e.preventDefault();
  alert('🎉 Demo Simulation: Order validated! In production, this proceeds to Razorpay / Cash on Delivery checkout.');
});

// Initialize on DOM ready
$(document).ready(function() {
  renderCartDrawer();
});
</script>
`;

async function fetchAndProcess(url, outFileName) {
  console.log('Fetching', url, '->', outFileName);
  const resp = await fetch(url);
  if (!resp.ok) {
    throw new Error('Failed to fetch ' + url + ': ' + resp.status);
  }
  let html = await resp.text();

  // Replace WooCommerce CSS links
  html = html.replace(/http:\/\/localhost:8000\/wp-content\/plugins\/woocommerce\/assets\/css\/woocommerce-layout\.css[^\"]*/g, 'assets/css/woocommerce-layout.css');
  html = html.replace(/\/wp-content\/plugins\/woocommerce\/assets\/css\/woocommerce-layout\.css[^\"]*/g, 'assets/css/woocommerce-layout.css');
  html = html.replace(/http:\/\/localhost:8000\/wp-content\/plugins\/woocommerce\/assets\/css\/woocommerce-smallscreen\.css[^\"]*/g, 'assets/css/woocommerce-smallscreen.css');
  html = html.replace(/\/wp-content\/plugins\/woocommerce\/assets\/css\/woocommerce-smallscreen\.css[^\"]*/g, 'assets/css/woocommerce-smallscreen.css');
  html = html.replace(/http:\/\/localhost:8000\/wp-content\/plugins\/woocommerce\/assets\/css\/woocommerce\.css[^\"]*/g, 'assets/css/woocommerce.css');
  html = html.replace(/\/wp-content\/plugins\/woocommerce\/assets\/css\/woocommerce\.css[^\"]*/g, 'assets/css/woocommerce.css');

  // Replace Theme assets
  html = html.replace(/http:\/\/localhost:8000\/wp-content\/themes\/kurtis-boutique\/style\.css[^\"]*/g, 'assets/css/style.css');
  html = html.replace(/\/wp-content\/themes\/kurtis-boutique\/style\.css[^\"]*/g, 'assets/css/style.css');
  html = html.replace(/http:\/\/localhost:8000\/wp-content\/themes\/kurtis-boutique\/assets\//g, 'assets/');
  html = html.replace(/\/wp-content\/themes\/kurtis-boutique\/assets\//g, 'assets/');

  // Replace backend scripts and APIs
  html = html.replace(/http:\/\/localhost:8000\/wp-includes\/js\/jquery\/jquery\.min\.js[^\"]*/g, 'https://code.jquery.com/jquery-3.7.1.min.js');
  html = html.replace(/http:\/\/localhost:8000\/wp-includes\/js\/jquery\/jquery-migrate\.min\.js[^\"]*/g, 'https://code.jquery.com/jquery-migrate-3.4.1.min.js');
  html = html.replace(/http:\/\/localhost:8000\/wp-json\/[^\"]*/g, '#');
  html = html.replace(/http:\/\/localhost:8000\/cart\/[^\"]*/g, '#');
  html = html.replace(/http:\/\/localhost:8000\/checkout\/[^\"]*/g, '#');
  html = html.replace(/http:\/\/localhost:8000\/my-account\/[^\"]*/g, '#');
  html = html.replace(/<link rel="EditURI"[^>]*>/g, '');
  html = html.replace(/<link rel='https:\/\/api\.w\.org\/'[^>]*>/g, '');
  html = html.replace(/<link rel="alternate" type="application\/json\+oembed"[^>]*>/g, '');
  html = html.replace(/<link rel="alternate" type="text\/xml\+oembed"[^>]*>/g, '');
  html = html.replace(/<script[^>]*src="http:\/\/localhost:8000\/wp-content\/plugins\/woocommerce\/assets\/js\/[^>]*><\/script>/g, '');
  html = html.replace(/<link rel='shortlink'[^>]*>/g, '');

  // Footer & Policy Links
  html = html.replace(/http:\/\/localhost:8000\/product-category\/[a-zA-Z0-9-]+\/?/g, 'shop.html');
  html = html.replace(/http:\/\/localhost:8000\/faq\/?/g, 'about-us.html#faq');
  html = html.replace(/http:\/\/localhost:8000\/privacy-policy\/?/g, 'about-us.html#privacy');
  html = html.replace(/http:\/\/localhost:8000\/shipping-policy\/?/g, 'about-us.html#shipping');
  html = html.replace(/http:\/\/localhost:8000\/refund-policy\/?/g, 'about-us.html#refund');
  html = html.replace(/http:\/\/localhost:8000\/terms\/?/g, 'about-us.html#terms');
  html = html.replace(/http:\/\/localhost:8000\/\?post_type=product[^\"]*/g, 'shop.html');
  html = html.replace(/action="http:\/\/localhost:8000\/?"/g, 'action="shop.html"');

  // Replace internal navigation links
  html = html.replace(/http:\/\/localhost:8000\/collections\/all\/?/g, 'shop.html');
  html = html.replace(/"\/collections\/all\/?"/g, '"shop.html"');
  html = html.replace(/http:\/\/localhost:8000\/collections\/?/g, 'collections.html');
  html = html.replace(/"\/collections\/?"/g, '"collections.html"');
  html = html.replace(/http:\/\/localhost:8000\/about-us\/?/g, 'about-us.html');
  html = html.replace(/"\/about-us\/?"/g, '"about-us.html"');
  html = html.replace(/http:\/\/localhost:8000\/track-order\/?/g, 'track-order.html');
  html = html.replace(/"\/track-order\/?"/g, '"track-order.html"');
  html = html.replace(/http:\/\/localhost:8000\/product\/[a-zA-Z0-9-]+\/?/g, 'product.html');
  html = html.replace(/"\/product\/[a-zA-Z0-9-]+\/?"/g, '"product.html"');
  html = html.replace(/http:\/\/localhost:8000\/collections\/[a-zA-Z0-9-]+\/?/g, 'shop.html');
  html = html.replace(/"\/collections\/[a-zA-Z0-9-]+\/?"/g, '"shop.html"');
  html = html.replace(/href="http:\/\/localhost:8000\/?"/g, 'href="index.html"');
  html = html.replace(/href="\/"/g, 'href="index.html"');

  // Replace remaining leftover localhost strings
  html = html.replace(/http:\/\/localhost:8000\/wp-admin\/admin-ajax\.php/g, '#');
  html = html.replace(/http:\/\/localhost:8000\/wp-includes\/js\/wp-emoji-release\.min\.js[^\"]*/g, 'https://s.w.org/images/core/emoji/17.0.2/svg/');
  html = html.replace(/http:\/\/localhost:8000\/wp-includes\/js\/wp-emoji-loader\.min\.js[^\"]*/g, '');
  html = html.replace(/http:\/\/localhost:8000\/?/g, 'index.html');

  // Insert Demo Global Banner right after <body>
  html = html.replace(/<body([^>]*)>/i, '<body$1>\n' + demoBannerHtml);

  // Insert interactive scripts right before </body>
  html = html.replace(/<\/body>/i, demoInteractiveJs + '\n</body>');

  fs.writeFileSync(path.join(DOCS_DIR, outFileName), html, 'utf8');
  console.log('Saved', outFileName, '(' + html.length + ' bytes)');
}

async function main() {
  await fetchAndProcess(BASE_URL + '/', 'index.html');
  await fetchAndProcess(BASE_URL + '/collections/', 'collections.html');
  await fetchAndProcess(BASE_URL + '/collections/all/', 'shop.html');
  await fetchAndProcess(BASE_URL + '/product/nazia-square-neck-printed-cotton-kurti/', 'product.html');
  await fetchAndProcess(BASE_URL + '/about-us/', 'about-us.html');
  await fetchAndProcess(BASE_URL + '/track-order/', 'track-order.html');
  console.log('Static export completed successfully!');
}

main().catch(err => {
  console.error(err);
  process.exit(1);
});
