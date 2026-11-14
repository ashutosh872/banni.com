<?php
define( 'DB_NAME', 'kurtis_store' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

$table_prefix = 'wp_';

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_MEMORY_LIMIT', '256M' );
// Dynamic Home & Site URL for Localhost and Public Tunnels
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
	$proto = ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) || ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http';
	define( 'WP_SITEURL', $proto . '://' . $_SERVER['HTTP_HOST'] );
	define( 'WP_HOME', $proto . '://' . $_SERVER['HTTP_HOST'] );
} else {
	define( 'WP_SITEURL', 'http://localhost:8000' );
	define( 'WP_HOME', 'http://localhost:8000' );
}

// Authentication Unique Keys and Salts.
define( 'AUTH_KEY',         'bZ0*2@m8s%Lq01^k#9xP$z1!90QW@ER#TY$UI%OP^1234' );
define( 'SECURE_AUTH_KEY',  'cV7#3@n9t%Mr12^l#0yQ%a2!01ER#TY$UI%OP^AS&DF*5678' );
define( 'LOGGED_IN_KEY',    'dW8$4@o0u%Ns23^m#1zR&b3!12TY$UI%OP^AS&DF*GH(9012' );
define( 'NONCE_KEY',        'eX9%5@p1v%Ot34^n#2aS*c4!23UI%OP^AS&DF*GH(JK)3456' );
define( 'AUTH_SALT',        'fY0^6@q2w%Pu45^o#3bT(d5!34OP^AS&DF*GH(JK)LZ_7890' );
define( 'SECURE_AUTH_SALT', 'gZ1&7@r3x%Qv56^p#4cU)e6!45AS&DF*GH(JK)LZ_XCV+1234' );
define( 'LOGGED_IN_SALT',   'hA2*8@s4y%Rw67^q#5dV_f7!56DF*GH(JK)LZ_XCV+BNM=5678' );
define( 'NONCE_SALT',       'iB3(9@t5z%Sx78^r#6eW+g8!67GH(JK)LZ_XCV+BNM=QWE~9012' );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
