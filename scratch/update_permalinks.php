<?php
$p = get_option( 'woocommerce_permalinks', array() );
$p['category_base'] = 'collections';
update_option( 'woocommerce_permalinks', $p );
flush_rewrite_rules();

$term = get_term_by( 'slug', 'square-neck', 'product_cat' );
echo "Square neck URL: " . get_term_link( $term ) . "\n";
