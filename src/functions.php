<?php

function featured_image_in_feed( $content ) {
	global $post;
	if( is_feed() ) {
		if ( has_post_thumbnail( $post->ID ) ){
			$output = get_the_post_thumbnail( $post->ID, 'medium');
			$content = $output . $content;
		}
	}
	return $content;
}
// add_filter( 'the_content', 'featured_image_in_feed' );

if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}

// Code below added by Jacob Charles Wilson to allow for custom logo
function paperjournal_custom_logo_setup() {
    $defaults = array(
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'paperjournal_custom_logo_setup' );

if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
  add_theme_support( 'post-thumbnails' );
}

add_image_size( 'mobile-home', 300, 300, true ); // Adds mobile-home cropped thumbnail
add_image_size( 'mobile-single', 300, 0, false ); // Adds mobile-single image
add_image_size( 'tablet-home', 230, 230, true ); // Adds tablet-home cropped thumbnail

// Sets responsive image size attributes
function paperjournal_set_image_sizes_attr( $sizes, $size ) {
	$sizes = '(max-width: 768px) 300px, (max-width: 1259px) 500px, 855px';
	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'paperjournal_set_image_sizes_attr', 10 , 2 );

// Add loading attribute to all images
function paperjournal_set_image_loading_attr($content) {
    $content = str_replace('<img','<img loading="lazy"', $content);
    return $content;
}
add_filter('the_content','paperjournal_set_image_loading_attr');

// 100% quality of jpgs
add_filter('jpeg_quality', function($arg){return 100;});

// Enqueue tag manager for all pages 
function paperjournal_include_js() {
	wp_enqueue_script( 'tag-manager', get_stylesheet_directory_uri() . '/js/tag-manager.js', array(), null, false);
}
add_action('wp_enqueue_scripts', 'paperjournal_include_js');

// Enqueue other scripts on certain pages
function paperjournal_conditional_js() {
	// if is singular
	if(is_singular()) {
		wp_enqueue_script( 'noframe', get_stylesheet_directory_uri() . '/js/noframe.min.js', array(), '2.2.5', true);
	}
	// if is index page
	if( is_home() || is_archive() || is_search() ) {
		wp_enqueue_script( 'infinite-scroll', get_stylesheet_directory_uri() . '/js/infinite-scroll.pkgd.min.js', array(), null, true);
		wp_enqueue_script( 'infinite-init', get_stylesheet_directory_uri() . '/js/infinite-scroll.init.js', array(), null, true);
	}
}
add_action('wp_enqueue_scripts', 'paperjournal_conditional_js');

function paperjournal_remove_js( ){
//    wp_dequeue_script( 'jquery');
//    wp_deregister_script( 'jquery');   
}
add_filter( 'wp_enqueue_scripts', 'paperjournal_remove_js', PHP_INT_MAX );

// Remove Post Formats
function paperjournal_remove_formats() {
   remove_theme_support('post-formats');
}
add_action('after_setup_theme', 'paperjournal_remove_formats', 100);

// Remove prepended categories from archive titles
function paperjournal_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
add_filter( 'get_the_archive_title', 'paperjournal_archive_title' );

// Disable Emoji, cut down page load time
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

// Filter function used to remove the tinymce emoji plugin.

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function paperjournal_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Dynamic Footer', 'paperjournal' ),
        'id' => 'footer-bar',
        'description' => __( 'This appears in the footer', 'paperjournal' ),
        'before_widget' => '<section id="%1$s" class="footer_box %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="footer_box_title">',
        'after_title' => '</h2>',
    ) );
} 
add_action( 'widgets_init', 'paperjournal_widgets_init' );

//hook into the init action and call create_writers_taxonomy when it fires
 
function create_writers_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Writers', 'taxonomy general name' ),
    'singular_name' => _x( 'Writer', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Writers' ),
    'popular_items' => __( 'Popular Writers' ),
    'all_items' => __( 'All Writers' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Writer' ), 
    'update_item' => __( 'Update Writer' ),
    'add_new_item' => __( 'Add New Writer' ),
    'new_item_name' => __( 'New Writer Name' ),
    'separate_items_with_commas' => __( 'Separate writers with commas' ),
    'add_or_remove_items' => __( 'Add or remove writers' ),
    'choose_from_most_used' => __( 'Choose from the most used writers' ),
    'menu_name' => __( 'Writers' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('writers','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => false,
	'show_in_menu' => true,
	'show_in_rest' => true,
	'meta_box_cb' => false,
	'public' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'writer' ),
   	'show_in_nav_menus' => true,
  ));
}
add_action( 'init', 'create_writers_taxonomy', 0 );

// Adds support for Woocommerce
function paperjournal_add_woocommerce_support() {
	// add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'paperjournal_add_woocommerce_support' );

// Unload WooCommerce assets on non WooCommerce pages.
function paperjournal_conditionally_remove_wc_assets() {
    // if WooCommerce is not active, abort.
    if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }

    // if this is a WooCommerce related page, abort.
    if ( is_woocommerce() || is_cart() || is_checkout() || is_page( array( 'my-account' ) ) ) {
        return;
    }

    remove_action( 'wp_enqueue_scripts', [ WC_Frontend_Scripts::class, 'load_scripts' ] );
    remove_action( 'wp_print_scripts', [ WC_Frontend_Scripts::class, 'localize_printed_scripts' ], 5 );
    remove_action( 'wp_print_footer_scripts', [ WC_Frontend_Scripts::class, 'localize_printed_scripts' ], 5 );

}
add_action( 'get_header', 'paperjournal_conditionally_remove_wc_assets' );
// Ends WooCommerce conditional

// Remove WooCommerce Feedback tab
function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );

// Remove breadcrumbs
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'woo_remove_wc_breadcrumbs' );

// Remove product zoom
function paperjournal_remove_zoom_theme_support() { 
    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'after_setup_theme', 'paperjournal_remove_zoom_theme_support', 100 );

/**
 * Show cart contents / total Ajax
 */

function paperjournal_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="pj-woocommerce__cart-count" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'paperjournal_header_add_to_cart_fragment' );

// Dollar Sign Switcher
function paperjournal_currency_symbol( $currency_symbol, $currency ) {
    switch( $currency ) {
        case 'USD':
            $currency_symbol = 'USD $';
            break;
        case 'NZD':
            $currency_symbol = 'NZD $';
            break;
        case 'AUD':
            $currency_symbol = 'AUD $';
            break;
    }
    return $currency_symbol;
}
add_filter('woocommerce_currency_symbol', 'paperjournal_currency_symbol', 30, 2);

/**
 * Plugin Name: WooCommerce Enable Free Shipping on a Per Product Basis
 * Plugin URI: https://gist.github.com/BFTrick/d4a21524a8f7b25ec296
 * Description: Enable free shipping for certain products
 * Author: Patrick Rauland & eugenf
 * Author URI: http://speakinginbytes.com/
 * Version: 1.0.2
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */
if ( ! class_exists( 'WC_Enable_Free_Shipping' ) ) :
class WC_Enable_Free_Shipping {
	protected static $instance = null;
	/**
	 * Initialize the plugin.
	 *
	 * @since 1.0
	 */
	private function __construct() {
		// add our check
		add_filter( 'woocommerce_shipping_free_shipping_is_available', array( $this, 'patricks_enable_free_shipping' ), 20 );
	}
	/**
	 * Enable free shipping for orders with products that have the free-shipping shipping class slug
	 *
	 * @param  bool $is_available
	 * @return bool
	 * @since  1.0
	 */
	public function patricks_enable_free_shipping( $is_available ) {
		global $woocommerce;
		// set the shipping classes that are eligible
		$eligible = array( 'free-shipping' );
		// get cart contents
		$cart_items = $woocommerce->cart->get_cart();
		// loop through the items checking to make sure they all have the right class
		foreach ( $cart_items as $key => $item ) {
			if ( ! in_array( $item['data']->get_shipping_class(), $eligible ) ) {
				// this item doesn't have the right class. return default availability
				return $is_available;
			}
		}
		// nothing out of the ordinary return true
		return true;
	}
	/**
	 * Return an instance of this class.
	 *
	 * @return object A single instance of this class.
	 * @since  1.0
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
}
add_action( 'init', array( 'WC_Enable_Free_Shipping', 'get_instance' ), 0 );
endif;
// ENDS enable free shipping

// Remove comments entirely
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

?>
