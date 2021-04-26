<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title('&laquo;', true, 'right'); ?></title>
    <?php wp_head(); ?>
	<style>
		@font-face {
  			font-family: Lato;
  			src: url(<?php bloginfo('stylesheet_directory'); ?>/fonts/Lato-Bold.ttf);
			font-display: swap;
		}
	</style>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=8"/>
	<link rel="alternate" type="application/rss+xml" title="Paper Journal RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="Paper Journal ATOM Feed" href="<?php bloginfo('atom_url'); ?>" />
</head>
<body <?php body_class(); ?>>
<header class="header">
	<div class="header-wrapper">
		<?php if ( function_exists( 'the_custom_logo' ) ) {
    		the_custom_logo();
		} else { ?>
			<a href="<?php bloginfo('url'); ?>"><img src="http://paper-journal.com/wp-content/uploads/2015/06/paper-logo.jpg" class="logo" alt="Paper Journal" /></a>
		<?php } ?>
		<button href="javascript:void(0)" class="openbtn" onclick="openNav()">≡ Menu</button>
		<div id="myNav" class="overlay no-print">
			<div class="overlay-content">
				<div class="button-wrapper">
					<button href="javascript:void(0)" class="closebtn" onclick="closeNav()">× Close</button>
				</div>
				<?php if ( is_active_sidebar( 'overlay-bar' ) ) : ?>
					<div class="overlay-sidebar">
						<?php dynamic_sidebar( 'overlay-bar' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if ( function_exists( 'is_woocommerce' ) ) :
				if ( is_woocommerce() || is_cart() || is_checkout() || is_page( array( 'my-account' ) ) ): ?>
					<h2 class="no-show no-print">Shop</h2>
					<ul class="menu shop-menu no-print">
						<?php if ( is_user_logged_in() ) { ?>
							<li class="shop__account"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a></li>
						<?php } else { ?>
							<li class="shop__account"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a></li>
						<?php } ?>
						<!-- Display categories -->
						<?php $prod_cat_args = array(
						  'taxonomy'     => 'product_cat', //woocommerce
						  'orderby'      => 'name',
						  'empty'        => 0
						);
						$woo_categories = get_categories( $prod_cat_args );
						foreach ( $woo_categories as $woo_cat ) {
							$woo_cat_id = $woo_cat->term_id; //category ID
							$woo_cat_name = $woo_cat->name; //category name
							$woo_cat_slug = $woo_cat->slug; //category slug
							echo '<li class="shop__category"><a href="' . get_term_link( $woo_cat_slug, 'product_cat' ) . '">' . $woo_cat_name . '</a></li>';
						} ?><!-- Ends display categories -->
						<li class="shop__cart"><a class="pj-woocommerce__cart-count" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a></li>
					</ul>
	<?php endif; endif; ?>
    </header>
	<main class="main">