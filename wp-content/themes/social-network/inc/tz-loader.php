<?php

if ( ! defined( 'TZ_THEME_VERSION' ) ) {
	define( 'TZ_THEME_VERSION', '2.1.0' );
}

if ( ! defined( 'TZ_DEBUG' ) ) {
	define( 'TZ_DEBUG', false );
}

if ( ! defined( 'TZ_TEMP_DIR' ) ) {
	define( 'TZ_INC_DIR', trailingslashit( get_template_directory() . '/inc/' ) );
}

if ( ! defined( 'TZ_ENQUEUE_DIR' ) ) {
	define( 'TZ_ENQUEUE_DIR', trailingslashit( get_template_directory_uri() . '/assets/' ) );
}


// Functions files include
require_once TZ_INC_DIR . 'functions/template-functions.php'; // Template functions
require_once TZ_INC_DIR .'functions/tz-enqueue-scripts.php';
require_once TZ_INC_DIR .'functions/woocommerce-funtcions.php';

// Hooks files include
require_once TZ_INC_DIR . 'hooks/header-hooks.php'; // Header Hooks
require_once TZ_INC_DIR . 'hooks/footer-hooks.php'; // Footer Hooks

// Customize Hooks
require_once  TZ_INC_DIR.'customizer/customizer.php';

// Widgets
require_once TZ_INC_DIR.'widgets/widgets.php';