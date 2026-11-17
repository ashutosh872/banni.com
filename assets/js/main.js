/**
 * Kurtis Boutique Theme Main JavaScript
 */

(function($) {
    'use strict';

    let selectedSize = '';

    $(document).ready(function() {

        // 1. Mobile Menu Drawer
        $('.mobile-menu-toggle').on('click', function(e) {
            e.preventDefault();
            $('#mobileNavDrawer').addClass('active');
            $('#mobileNavOverlay').addClass('active');
        });

        $('#mobileNavClose, #mobileNavOverlay').on('click', function(e) {
            e.preventDefault();
            $('#mobileNavDrawer').removeClass('active');
            $('#mobileNavOverlay').removeClass('active');
        });

        // 2. Search Modal
        $(document).on('click', '.search-modal-toggle', function(e) {
            e.preventDefault();
            $('#searchModal').addClass('active');
            $('body').addClass('modal-open');
            setTimeout(function() {
                $('#searchModalInput').focus();
            }, 100);
        });

        $(document).on('click', '#searchModalClose, #searchModal', function(e) {
            if (e.target === this || $(e.target).closest('#searchModalClose').length) {
                $('#searchModal').removeClass('active');
                $('body').removeClass('modal-open');
            }
        });

        // Live Instant Search Auto-Suggest
        let searchDebounceTimer;
        $(document).on('input', '#searchModalInput', function() {
            const query = $(this).val().trim();
            const resultsBox = $('#searchLiveResults');
            clearTimeout(searchDebounceTimer);

            if (query.length < 2) {
                resultsBox.slideUp(150).empty();
                return;
            }

            searchDebounceTimer = setTimeout(function() {
                resultsBox.html('<div style="text-align:center; padding: 12px; font-size: 0.85rem; color: var(--color-text-muted);">Searching kurtis...</div>').slideDown(150);

                $.ajax({
                    url: kurtis_ajax.ajax_url,
                    type: 'GET',
                    data: {
                        action: 'kurtis_live_search',
                        s: query
                    },
                    success: function(resp) {
                        if (resp.success && resp.data.html) {
                            resultsBox.html(resp.data.html).slideDown(150);
                        } else {
                            resultsBox.html('<div style="text-align:center; padding: 12px; font-size: 0.85rem; color: var(--color-text-muted);">No matching kurtis found. Press Enter to view full search page.</div>');
                        }
                    },
                    error: function() {
                        resultsBox.slideUp(150);
                    }
                });
            }, 250);
        });

        // 3. Size Chart Modal
        $(document).on('click', '#sizeChartOpenBtn, .size-chart-trigger', function(e) {
            e.preventDefault();
            $('#sizeChartModal').addClass('active');
            $('body').addClass('modal-open');
        });

        $(document).on('click', '#sizeChartCloseBtn, #sizeChartModal', function(e) {
            if (e.target === this || $(e.target).closest('#sizeChartCloseBtn').length) {
                $('#sizeChartModal').removeClass('active');
                $('body').removeClass('modal-open');
            }
        });

        // Close all on Escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                $('#sizeChartModal').removeClass('active');
                $('#searchModal').removeClass('active');
                $('#cartDrawer').removeClass('active');
                $('#cartDrawerOverlay').removeClass('active');
                $('#mobileNavDrawer').removeClass('active');
                $('#mobileNavOverlay').removeClass('active');
                $('body').removeClass('cart-drawer-open modal-open');
            }
        });

        // 4. Single Product Gallery Thumbnail Switcher
        $('.pdp-thumb').on('click', function() {
            $('.pdp-thumb').removeClass('active');
            $(this).addClass('active');
            const imgUrl = $(this).data('img-url');
            if (imgUrl) {
                $('#pdpMainImg').attr('src', imgUrl);
            }
        });

        // 5. Size Selector Radio Simulation
        $('#sizeSelectorWrap .size-box').on('click', function() {
            $('#sizeSelectorWrap .size-box').removeClass('active');
            $(this).addClass('active');
            selectedSize = $(this).data('size');
            $('#selectedSizeLabel').text(selectedSize);
            $('#sizeErrorMsg').slideUp(150);
        });

        // 6. Sticky Add to Cart Top Bar on Scroll
        const mainBtn = $('#mainAddToCartBtn');
        const stickyBar = $('#stickyAddBar');

        if (mainBtn.length && stickyBar.length) {
            $(window).on('scroll', function() {
                const triggerPoint = mainBtn.offset().top + mainBtn.outerHeight();
                if ($(window).scrollTop() > triggerPoint) {
                    stickyBar.addClass('visible');
                } else {
                    stickyBar.removeClass('visible');
                }
            });

            $('#stickyAddToCartBtn').on('click', function() {
                mainBtn.trigger('click');
            });
        }

        // 7. Cart Drawer Open & Close
        $('.cart-drawer-trigger').on('click', function(e) {
            e.preventDefault();
            openCartDrawer();
        });

        $(document).on('click', '.cart-drawer-close, #cartDrawerOverlay', function(e) {
            e.preventDefault();
            closeCartDrawer();
        });

        function openCartDrawer() {
            $('#cartDrawer').addClass('active');
            $('#cartDrawerOverlay').addClass('active');
            $('body').addClass('cart-drawer-open');
        }

        function closeCartDrawer() {
            $('#cartDrawer').removeClass('active');
            $('#cartDrawerOverlay').removeClass('active');
            $('body').removeClass('cart-drawer-open');
        }

        // 8. PDP Quantity Stepper
        let pdpQty = 1;
        $(document).on('click', '#pdpQtyPlus', function(e) {
            e.preventDefault();
            pdpQty++;
            $('#pdpQtyVal').text(pdpQty);
        });
        $(document).on('click', '#pdpQtyMinus', function(e) {
            e.preventDefault();
            if (pdpQty > 1) {
                pdpQty--;
                $('#pdpQtyVal').text(pdpQty);
            }
        });

        // 9. Main Product Add to Cart Action
        $('#mainAddToCartBtn').on('click', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = btn.data('product-id');

            // Validate Size Selection
            if (!selectedSize) {
                $('#sizeErrorMsg').slideDown(150);
                $('html, body').animate({
                    scrollTop: $('#sizeSelectorWrap').offset().top - 120
                }, 300);
                return;
            }

            btn.css('opacity', '0.7').text('Adding to Bag...');

            $.ajax({
                url: kurtis_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'kurtis_add_to_cart',
                    nonce: kurtis_ajax.nonce,
                    product_id: productId,
                    quantity: pdpQty,
                    size: selectedSize
                },
                success: function(response) {
                    btn.css('opacity', '1').html('<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg> <span>Add to Bag</span>');
                    if (response.success) {
                        $('#cartDrawerContent').html(response.data.html);
                        $('.header-cart-count').text(response.data.cart_count);
                        openCartDrawer();
                    } else {
                        alert(response.data.message || 'Error adding product');
                    }
                },
                error: function() {
                    btn.css('opacity', '1').text('Add to Bag');
                    alert('Network error adding to bag');
                }
            });
        });

        // Buy It Now Express Checkout
        $('#buyNowBtn').on('click', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = btn.data('product-id');

            if (!selectedSize) {
                $('#sizeErrorMsg').slideDown(150);
                $('html, body').animate({
                    scrollTop: $('#sizeSelectorWrap').offset().top - 120
                }, 300);
                return;
            }

            btn.css('opacity', '0.7').text('Proceeding to Checkout...');

            $.ajax({
                url: kurtis_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'kurtis_add_to_cart',
                    nonce: kurtis_ajax.nonce,
                    product_id: productId,
                    quantity: pdpQty,
                    size: selectedSize
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = '/checkout/';
                    } else {
                        btn.css('opacity', '1').text('⚡ Buy It Now · Express Checkout');
                        alert(response.data.message || 'Error processing express checkout');
                    }
                },
                error: function() {
                    btn.css('opacity', '1').text('⚡ Buy It Now · Express Checkout');
                    window.location.href = '/checkout/';
                }
            });
        });

        // 9. Quick Add to Cart from Catalog Cards
        $(document).on('click', '.ajax-add-to-cart-quick', function(e) {
            e.preventDefault();
            const btn = $(this);
            const productId = btn.data('product-id');
            const size = btn.data('size') || 'M';

            btn.css('opacity', '0.5');

            $.ajax({
                url: kurtis_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'kurtis_add_to_cart',
                    nonce: kurtis_ajax.nonce,
                    product_id: productId,
                    quantity: 1,
                    size: size
                },
                success: function(response) {
                    btn.css('opacity', '1');
                    if (response.success) {
                        $('#cartDrawerContent').html(response.data.html);
                        $('.header-cart-count').text(response.data.cart_count);
                        openCartDrawer();
                    }
                },
                error: function() {
                    btn.css('opacity', '1');
                }
            });
        });

        // 10. Cart Item Stepper & Remove inside Drawer
        $(document).on('click', '.btn-qty-plus', function(e) {
            e.preventDefault();
            updateCartItem($(this).data('key'), 'plus');
        });

        $(document).on('click', '.btn-qty-minus', function(e) {
            e.preventDefault();
            updateCartItem($(this).data('key'), 'minus');
        });

        $(document).on('click', '.btn-remove-item', function(e) {
            e.preventDefault();
            updateCartItem($(this).data('key'), 'remove');
        });

        function updateCartItem(cartItemKey, updateAction) {
            $('#cartDrawerContent').css('opacity', '0.6');

            $.ajax({
                url: kurtis_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'kurtis_update_cart',
                    nonce: kurtis_ajax.nonce,
                    cart_item_key: cartItemKey,
                    update_action: updateAction
                },
                success: function(response) {
                    $('#cartDrawerContent').css('opacity', '1');
                    if (response.success) {
                        $('#cartDrawerContent').html(response.data.html);
                        $('.header-cart-count').text(response.data.cart_count);
                    }
                },
                error: function() {
                    $('#cartDrawerContent').css('opacity', '1');
                }
            });
        }

        // 11. Pincode Delivery Estimator
        $('#pincodeBtn').on('click', function(e) {
            e.preventDefault();
            const val = $('#pincodeInput').val().trim();
            if (/^\d{6}$/.test(val)) {
                $('#pincodeResult')
                    .html('✓ <strong>Eligible for Express Delivery to ' + val + '!</strong><br>Delivery in 2–3 business days · Cash on Delivery available.')
                    .css('color', 'var(--color-badge-green)')
                    .slideDown(150);
            } else {
                $('#pincodeResult')
                    .html('⚠️ Please enter a valid 6-digit Indian postal code.')
                    .css('color', '#C0392B')
                    .slideDown(150);
            }
        });

        // 12. Cart Drawer Coupon Apply Handler
        $(document).on('click', '#btnApplyDrawerCoupon', function(e) {
            e.preventDefault();
            const btn = $(this);
            const code = $('#drawerCouponCode').val().trim();
            const msgEl = $('#drawerCouponMsg');

            if (!code) {
                msgEl.text('Please enter a coupon code').css('color', '#C0392B').slideDown();
                return;
            }

            btn.text('Applying...').prop('disabled', true);

            $.ajax({
                url: kurtis_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'kurtis_apply_coupon',
                    nonce: kurtis_ajax.nonce,
                    coupon_code: code
                },
                success: function(resp) {
                    btn.text('Apply').prop('disabled', false);
                    if (resp.success) {
                        $('#cartDrawerContent').html(resp.data.html);
                        $('.header-cart-count').text(resp.data.cart_count);
                    } else {
                        $('#drawerCouponMsg').text(resp.data.message || 'Invalid coupon code').css('color', '#C0392B').slideDown();
                    }
                },
                error: function() {
                    btn.text('Apply').prop('disabled', false);
                    $('#drawerCouponMsg').text('Network error applying coupon').css('color', '#C0392B').slideDown();
                }
            });
        });

        // Accordion Toggle
        $(document).on('click', '.accordion-header', function() {
            const item = $(this).closest('.accordion-item');
            item.toggleClass('active');
        });

        // 13. Category Pills Horizontal Scroll & Drag Engine
        function initCategoryPills() {
            $('.category-pills-wrapper').each(function() {
                const wrapper = $(this);
                const bar = wrapper.find('.category-pills-bar')[0];
                if (!bar) return;

                function updateOverflow() {
                    if (bar.scrollWidth > bar.clientWidth + 5) {
                        wrapper.addClass('has-overflow');
                    } else {
                        wrapper.removeClass('has-overflow');
                    }
                }

                updateOverflow();
                $(window).on('resize', updateOverflow);

                wrapper.find('.pills-scroll-prev').on('click', function(e) {
                    e.preventDefault();
                    bar.scrollBy({ left: -260, behavior: 'smooth' });
                });

                wrapper.find('.pills-scroll-next').on('click', function(e) {
                    e.preventDefault();
                    bar.scrollBy({ left: 260, behavior: 'smooth' });
                });

                let isDown = false;
                let startX;
                let scrollLeft;

                $(bar).on('mousedown', function(e) {
                    isDown = true;
                    $(bar).addClass('is-dragging');
                    startX = e.pageX - bar.offsetLeft;
                    scrollLeft = bar.scrollLeft;
                });

                $(bar).on('mouseleave mouseup', function() {
                    isDown = false;
                    $(bar).removeClass('is-dragging');
                });

                $(bar).on('mousemove', function(e) {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - bar.offsetLeft;
                    const walk = (x - startX) * 1.6;
                    bar.scrollLeft = scrollLeft - walk;
                });

                const activePill = wrapper.find('.category-pill.active');
                if (activePill.length && bar.scrollWidth > bar.clientWidth) {
                    setTimeout(function() {
                        const pillLeft = activePill.position().left;
                        const pillWidth = activePill.outerWidth();
                        const barWidth = $(bar).width();
                        bar.scrollTo({
                            left: pillLeft - (barWidth / 2) + (pillWidth / 2),
                            behavior: 'smooth'
                        });
                    }, 100);
                }
            });
        }

        initCategoryPills();

    });

})(jQuery);
