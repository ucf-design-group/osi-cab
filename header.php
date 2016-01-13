<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package OSI Starter Theme
 * @since OSI Starter Theme 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'osi_starter_theme' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/ie.css">
<![endif]-->


<?php wp_head(); ?>
<meta name="apple-mobile-web-app-capable" content="yes" />
<link href='http://fonts.googleapis.com/css?family=Russo+One|Source+Sans+Pro:400,300,700,300italic' rel='stylesheet' type='text/css'>
<script>
	

function hideAddressBar()
{
  if(!window.location.hash)
  {
      if(document.height < window.outerHeight)
      {
          document.body.style.height = (window.outerHeight + 50) + 'px';
      }

      setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
  }
}

window.addEventListener("load", function(){ if(!window.pageYOffset){ hideAddressBar(); } } );
window.addEventListener("orientationchange", hideAddressBar );

</script>
<?php date_default_timezone_set('America/New_York'); ?>
</head>

<body <?php body_class(); ?>>
<div id="twitter"><a href="https://twitter.com/UCF_CAB"></a></div>
<div id="facebook"><a href="https://www.facebook.com/UCFCAB"></a></div>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-hd.png" alt="Campus Activities Board Logo"/></a></h1>
		</hgroup>

		<nav role="navigation" class="site-navigation main-navigation">
			<h1 class="assistive-text" id="expand-menu" onclick="changeText();"><?php _e( 'Tap for Menu ', 'osi_starter_theme' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'osi_starter_theme' ); ?>"><?php _e( 'Skip to content', 'osi_starter_theme' ); ?></a></div>

			<?php wp_nav_menu( array( 
								'theme_location' => 'primary',
								'container' =>false,
								'menu_class' => 'menu',
								'echo' => true,
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 0,
								'walker' => new description_walker()
							) 
			); ?>
		</nav><!-- .site-navigation .main-navigation -->
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">