<?php
require_once( 'wp-load.php' );

// Add rewrite rule for collections/all
add_rewrite_rule( '^collections/all/?$', 'index.php?post_type=product', 'top' );
flush_rewrite_rules();

echo "Rewrite rules flushed. Checking match for collections/all...\n";
$rules = get_option('rewrite_rules');
foreach ($rules as $pattern => $query) {
    if (strpos($pattern, 'collections/all') !== false) {
        echo "Found rule: $pattern => $query\n";
    }
}
