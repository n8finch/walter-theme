<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.0.1' );

//* Enqueue Lato Google font
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:300,700', array(), CHILD_THEME_VERSION );
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// Home page widgets
  genesis_register_sidebar( array(
		'id'			=> 'home-featured-full',
		'name'			=> __( 'Home Featured Full', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the featured area if you want full width.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-left',
		'name'			=> __( 'Home Featured Left', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the featured area left side.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-right',
		'name'			=> __( 'Home Featured Right', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the featured area right side.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-left2',
		'name'			=> __( 'Home Featured Left2', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the featured area left2 side.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-right2',
		'name'			=> __( 'Home Featured Right2', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the featured area right2 side.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-1',
		'name'			=> __( 'Home Middle 1', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the home middle left area.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-2',
		'name'			=> __( 'Home Middle 2', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the home middle center area.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-3',
		'name'			=> __( 'Home Middle 3', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the home middle right area.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-reviews',
		'name'			=> __( 'Home Reviews', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the home reviews area.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-bottom',
		'name'			=> __( 'Home Bottom', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the home bottom area.', 'CHILD_THEME_NAME' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'after-entry',
		'name'			=> __( 'After Entry', 'CHILD_THEME_NAME' ),
		'description'	=> __( 'This is the after entry area.', 'CHILD_THEME_NAME' ),
	) );

	
	
//* Enqueue sticky menu script
add_action( 'wp_enqueue_scripts', 'sp_enqueue_script' );
function sp_enqueue_script() {
	wp_enqueue_script( 'sample-sticky-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/sticky-menu.js', array( 'jquery' ), '1.0.0' );
}
 
//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before', 'genesis_do_subnav' );

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
	?>
	<p>&copy; Copyright 2014 <a href="https://walterdanley.com/">Walter Danley</a> &middot; All Rights Reserved &middot; In partnership with ThrillerNovels.net <a href="http://thrillernovels.net/">ThrillerNovels.net</a> &middot; Customized Theme Handiwork by <a href="http://finchproservices.com/">Finch Professional Services</a> </p>
	<?php
}

//* Hook after post widget after the entry content
add_action( 'genesis_entry_footer', 'walter_after_entry', 1 );
function walter_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry widget-area">',
			'after'  => '</div>',
		) );

}


/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array(
	'width'	 => 550,
	'height' => 100
) );
// Remove the site title and description
remove_action( 'genesis_site_title', 'genesis_seo_site_title');
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );




/**********************************
 *
 * Replace Header Site Title with Inline Logo
 *
 * Fixes Genesis bug - when using static front page and blog page (admin reading settings) Home page is <p> tag and Blog page is <h1> tag
 *
 * Replaces "is_home" with "is_front_page" to correctly display Home page wit <h1> tag and Blog page with <p> tag
 *
 * @author AlphaBlossom / Tony Eppright
 * @link http://www.alphablossom.com/a-better-wordpress-genesis-responsive-logo-header/
 *
 * @edited by Sridhar Katakam
 * @link http://www.sridharkatakam.com/use-inline-logo-instead-background-image-genesis/
 *
************************************/
// add_filter( 'genesis_seo_title', 'custom_header_inline_logo', 10, 3 );
// function custom_header_inline_logo( $title, $inside, $wrap ) {
 
// 	$logo = '<img src="' . get_stylesheet_directory_uri() . '/images/logo.png" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="300" height="60" />';
 
// 	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $logo );
 
// 	// Determine which wrapping tags to use - changed is_home to is_front_page to fix Genesis bug
// 	$wrap = is_front_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';
 
// 	// A little fallback, in case an SEO plugin is active - changed is_home to is_front_page to fix Genesis bug
// 	$wrap = is_front_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;
 
// 	// And finally, $wrap in h1 if HTML5 & semantic headings enabled
// 	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;
 
// 	return sprintf( '<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr( 'site-title' ), $inside );
 
// }



