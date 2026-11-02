<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<script>document.documentElement.className+=' js';</script>
<noscript><style>.nav{display:flex!important}.menu-btn{display:none!important}</style></noscript>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Skip to main content</a>
<canvas aria-hidden="true" id="net"></canvas>
<header class='site-header'>
<div class='wrap bar'>
<a aria-label='Green Fiber Net home' class='brand' href="<?php echo esc_url( home_url( '/' ) ); ?>">
<span aria-hidden='true' class='logo'><svg height='36' viewBox='0 0 32 32' width='36'><defs><linearGradient id='lg' x1='0' x2='1' y1='0' y2='1'><stop offset='0' stop-color='#a6ffcb'/><stop offset='1' stop-color='#0b8a4a'/></linearGradient></defs><circle cx='16' cy='16' fill='none' r='13' stroke='url(#lg)' stroke-width='2.4'/><path d='M7 20c5-1 7-9 18-8' fill='none' stroke='url(#lg)' stroke-linecap='round' stroke-width='2.4'/><circle cx='25' cy='12' fill='#39ff88' r='2.6'/></svg></span>
<span class='bt'><strong>Green Fiber Net</strong><small>FTTH Fiber Internet Service Provider</small></span>
</a>
<button aria-controls='nav' aria-expanded='false' class='menu-btn' type='button'><span class='sr'>Open menu</span><i></i></button>
<nav aria-label='Primary navigation' class='nav' id='nav'>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
<a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">About</a>
<a href="<?php echo esc_url( home_url( '/#packages' ) ); ?>">Packages</a>
<a href="<?php echo esc_url( home_url( '/#coverage' ) ); ?>">Coverage</a>
<a href="<?php echo esc_url( home_url( '/#why' ) ); ?>">Why Us</a>
<a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>">FAQs</a>
<a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Contact</a>
<a class='btn btn-sm' href="<?php echo esc_url( home_url( '/#apply' ) ); ?>">New Connection</a>
</nav>
</div>
</header>
<main id="main">
