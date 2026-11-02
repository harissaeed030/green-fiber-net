<?php
/**
 * Green Fiber Net theme functions.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GFN_VERSION', '1.0.0' );

/* ---------- Business data (single source for structured data and FAQ) ---------- */
function gfn_packages() {
	return array(
		array( '6 Mbps IPT + 12 Mbps CDN (18 Mbps total)', 1300 ),
		array( '8 Mbps IPT + 16 Mbps CDN (24 Mbps total)', 1500 ),
		array( '10 Mbps IPT + 20 Mbps CDN (30 Mbps total)', 2000 ),
		array( '6 Mbps IPT', 1000 ),
		array( '10 Mbps IPT', 1200 ),
		array( '15 Mbps IPT', 1500 ),
		array( '20 Mbps IPT', 2000 ),
		array( '25 Mbps IPT', 2500 ),
		array( '30 Mbps IPT', 3000 ),
		array( '35 Mbps IPT', 3500 ),
		array( '40 Mbps IPT', 4000 ),
		array( '50 Mbps IPT', 5000 ),
	);
}

function gfn_areas() {
	return array( 'Block B-1', 'Block B-2', 'Block C-2', 'Khawaja Colony', 'Eidgah Colony', 'Unit No. 8' );
}

function gfn_faqs() {
	return array(
		array( 'What fiber internet packages do you offer?', 'IPT + CDN mixed packages run from Rs. 1,300 to Rs. 2,000 per month, and IPT-only packages from Rs. 1,000 (6 Mbps) to Rs. 5,000 (50 Mbps). The most popular is 8 Mbps IPT + 16 Mbps CDN (24 Mbps total) at Rs. 1,500.' ),
		array( 'What do IPT, CDN and total speed mean?', 'IPT is your main internet speed and CDN is extra speed on top of it. Total speed is IPT plus CDN added together. For example, 8 Mbps IPT + 16 Mbps CDN = 24 Mbps total.' ),
		array( 'How do I get a new connection?', 'Fill in the application form on this page. Your request opens in WhatsApp and our team confirms your booking.' ),
		array( 'Where is your office?', 'Lajpal General Store, Ayesha Clinic, Khawaja Colony, Block B-2, Unit No. 8, Latifabad, Hyderabad.' ),
		array( 'Which areas of Latifabad, Hyderabad do you cover?', 'Block B-1, Block B-2, Block C-2, Khawaja Colony, Eidgah Colony and Unit No. 8, Latifabad. If your area is not listed, call or WhatsApp 0306-1035806 to ask.' ),
		array( 'How can I contact you?', 'Helpline and WhatsApp: 0306-1035806.' ),
	);
}

function gfn_front_description() {
	return 'High-speed fiber internet in Latifabad, Hyderabad, Sindh. 8 Mbps IPT + 16 Mbps CDN (24 Mbps) for Rs. 1,500/month. Helpline 0306-1035806.';
}

/** True when a dedicated SEO plugin is active, so the theme does not output duplicate meta or schema. */
function gfn_has_seo_plugin() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'THE_SEO_FRAMEWORK_VERSION' );
}

/* ---------- Setup ---------- */
function gfn_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'gfn_setup' );

function gfn_widgets() {
	register_sidebar( array(
		'name'          => 'Customer Feedback area',
		'id'            => 'gfn-feedback',
		'description'   => 'Add real customer reviews here (Text or Custom HTML widget). Shown in the Customer Feedback section of the home page.',
		'before_widget' => '<div class="gfn-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'gfn_widgets' );

function gfn_assets() {
	wp_enqueue_style( 'green-fiber-net', get_stylesheet_uri(), array(), GFN_VERSION );
	wp_enqueue_script( 'green-fiber-net', get_template_directory_uri() . '/assets/js/main.js', array(), GFN_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'gfn_assets' );

/* Performance: remove emoji scripts and generator tag. */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );

/* ---------- Titles ---------- */
function gfn_title_sep() {
	return '|';
}
add_filter( 'document_title_separator', 'gfn_title_sep' );

function gfn_title_parts( $parts ) {
	if ( is_front_page() ) {
		$parts['title'] = 'Fiber Internet in Latifabad, Hyderabad';
		$parts['site']  = 'Green Fiber Net';
		unset( $parts['tagline'] );
	}
	return $parts;
}
add_filter( 'document_title_parts', 'gfn_title_parts' );

/* ---------- Head meta (skipped when an SEO plugin is active) ---------- */
function gfn_head_meta() {
	echo '<meta name="theme-color" content="#04140d">' . "\n";
	echo '<meta name="geo.placename" content="Latifabad, Hyderabad">' . "\n";
	echo '<meta name="geo.region" content="PK-SD">' . "\n";

	if ( gfn_has_seo_plugin() ) {
		return;
	}

	$title = wp_get_document_title();
	$url   = '';
	$image = '';
	$type  = 'website';
	$desc  = '';

	if ( is_front_page() ) {
		$desc = gfn_front_description();
		$url  = home_url( '/' );
	} elseif ( is_singular() ) {
		$post = get_queried_object();
		if ( $post ) {
			$desc = wp_trim_words( wp_strip_all_tags( has_excerpt( $post ) ? get_the_excerpt( $post ) : strip_shortcodes( $post->post_content ) ), 30, '' );
		}
		$url  = get_permalink();
		$type = is_single() ? 'article' : 'website';
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( null, 'large' );
		}
	}
	if ( '' === $desc ) {
		$desc = gfn_front_description();
	}
	if ( '' === $image ) {
		$image = get_site_icon_url( 512 );
	}

	if ( ! is_singular() && '' !== $url ) {
		echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	}
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:locale" content="en_US">' . "\n";
	echo '<meta property="og:site_name" content="Green Fiber Net">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	if ( '' !== $url ) {
		echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	}
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	}
	echo '<meta name="twitter:card" content="' . ( $image ? 'summary_large_image' : 'summary' ) . '">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	if ( $image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'gfn_head_meta', 2 );

/* ---------- JSON-LD (one graph on the home page, breadcrumbs on singular pages) ---------- */
function gfn_print_json( $data ) {
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ) . '</script>' . "\n";
}

function gfn_jsonld() {
	if ( gfn_has_seo_plugin() ) {
		return;
	}
	$home = home_url( '/' );

	if ( is_front_page() ) {
		$offers = array();
		foreach ( gfn_packages() as $p ) {
			$offers[] = array( '@type' => 'Offer', 'name' => $p[0], 'price' => (string) $p[1], 'priceCurrency' => 'PKR' );
		}
		$areas = array();
		foreach ( gfn_areas() as $a ) {
			$areas[] = array( '@type' => 'Place', 'name' => $a . ', Latifabad, Hyderabad' );
		}
		$faq = array();
		foreach ( gfn_faqs() as $f ) {
			$faq[] = array( '@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f[1] ) );
		}
		$graph = array(
			'@context' => 'https://schema.org',
			'@graph'   => array(
				array(
					'@type'           => array( 'InternetServiceProvider', 'LocalBusiness' ),
					'@id'             => $home . '#business',
					'name'            => 'Green Fiber Net',
					'url'             => $home,
					'slogan'          => 'Connecting Your World with Fiber Speed.',
					'description'     => 'FTTH fiber internet service provider in Latifabad, Hyderabad, Sindh, Pakistan. IPT + CDN and IPT-only home and business packages from Rs. 1,000 per month.',
					'telephone'       => '+92-306-1035806',
					'priceRange'      => 'Rs. 1,000 - Rs. 5,000 per month',
					'address'         => array(
						'@type'           => 'PostalAddress',
						'streetAddress'   => 'Lajpal General Store, Ayesha Clinic, Khawaja Colony, Block B-2, Unit No. 8',
						'addressLocality' => 'Latifabad, Hyderabad',
						'addressRegion'   => 'Sindh',
						'addressCountry'  => 'PK',
					),
					'hasMap'          => 'https://www.google.com/maps/search/Ayesha+Clinic+Khawaja+Colony+Latifabad+Hyderabad',
					'contactPoint'    => array( '@type' => 'ContactPoint', 'telephone' => '+92-306-1035806', 'contactType' => 'customer support', 'areaServed' => 'PK', 'availableLanguage' => array( 'English', 'Urdu' ) ),
					'areaServed'      => $areas,
					'sameAs'          => array( 'https://www.facebook.com/share/19hUeLEg7k/' ),
					'hasOfferCatalog' => array( '@type' => 'OfferCatalog', 'name' => 'Fiber Internet Packages', 'itemListElement' => $offers ),
				),
				array( '@type' => 'WebSite', '@id' => $home . '#website', 'url' => $home, 'name' => 'Green Fiber Net', 'inLanguage' => 'en', 'publisher' => array( '@id' => $home . '#business' ) ),
				array( '@type' => 'FAQPage', 'mainEntity' => $faq ),
			),
		);
		gfn_print_json( $graph );
	} elseif ( is_singular() ) {
		gfn_print_json( array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => array(
				array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $home ),
				array( '@type' => 'ListItem', 'position' => 2, 'name' => wp_strip_all_tags( get_the_title() ), 'item' => get_permalink() ),
			),
		) );
	}
}
add_action( 'wp_head', 'gfn_jsonld', 5 );
