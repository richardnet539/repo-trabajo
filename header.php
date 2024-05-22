<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package liga-de-debate
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700&display=swap" rel="stylesheet">
	<!-- CookiePro Cookies Consent Notice start for uneatlantico.es -->
	<script type="text/javascript" src="https://cookie-cdn.cookiepro.com/consent/018e9a60-e772-7722-82c3-98dae004d75e/OtAutoBlock.js" ></script>
	<script src="https://cookie-cdn.cookiepro.com/scripttemplates/otSDKStub.js" data-language="es" type="text/javascript" charset="UTF-8" data-domain-script="018e9a60-e772-7722-82c3-98dae004d75e" ></script>
	<script type="text/javascript">
	function OptanonWrapper() { }
	</script>
	<!-- CookiePro Cookies Consent Notice end for uneatlantico.es -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ligaDebate' ); ?></a>
<div class="container-global">
	<?php get_template_part( 'template-parts/header', 'top' ); ?>
	<header id="masthead" class="site-header">
		<div class="container">
		<nav class="region region-header navbar navbar-expand-xl" role="navigation">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
					<?php
				else :
					?>
					<div class="site-title">
						<span><?php bloginfo( 'name' ); ?></span>
					</div>
					<?php
				endif;
				$ligaDebate_description = get_bloginfo( 'description', 'display' );
				if ( $ligaDebate_description || is_customize_preview() ) :
					?>
					<span class="site-description"><?php echo $ligaDebate_description; /* WPCS: xss ok. */ ?></span>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<a class="btn-bar navbar-toggler menu-toggle" data-toggle="collapse" data-target=".js-main-navigation" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></a>

			<div class="collapse navbar-collapse js-main-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'depth'       => 2, // 1 = no dropdowns, 2 = with dropdowns.
						'container'     => 'div',
						// 'container_class' => '',
						'container_id'    => 'main-navigation',
						'menu_class'    => 'navbar-nav ml-auto text-uppercase fz-11',
					'fallback_cb'   => 'WP_Bootstrap_Navwalker::fallback',
					'walker'      => new WP_Bootstrap_Navwalker()

				) );
				?>
				<div><?php dynamic_sidebar( 'menu-header' ); ?></div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php
	if( ( is_front_page() ) ) {
	  dynamic_sidebar( 'slider-home' );
	}
	?>

	<div id="content" class="site-content">
