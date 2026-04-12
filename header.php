<?php
/**
 * The header for our theme
 * @package PlaygroundTheme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'playgroundtheme' ); ?></a>

<header id="masthead" class="site-header">
	<div class="nav-container">

		<!-- LEFT: Logo -->
		<div class="nav-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					echo '<span class="nav-logo-text">KOMPAN*</span>';
				}
				?>
			</a>
		</div>

		<!-- CENTER: Menu -->
		<nav id="site-navigation" class="main-navigation" aria-label="Primary Navigation">
		


			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nav-menu',
					'container'      => false,
				)
			);
			?>
		</nav>

		<!-- RIGHT: Search + Button -->
		<div class="nav-actions">
			<!-- Search Icon -->
			<button class="nav-search-toggle" aria-label="Search">
				<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><path fill="currentColor" d="M20.031 20.79c.46.46 1.17-.25.71-.7l-3.75-3.76a7.9 7.9 0 0 0 2.04-5.31c0-4.39-3.57-7.96-7.96-7.96s-7.96 3.57-7.96 7.96s3.57 7.96 7.96 7.96c1.98 0 3.81-.73 5.21-1.94zM4.11 11.02c0-3.84 3.13-6.96 6.96-6.96c3.84 0 6.96 3.12 6.96 6.96s-3.12 6.96-6.96 6.96c-3.83 0-6.96-3.12-6.96-6.96"/></svg>
			</button>

			<!-- Search Bar (hidden by default) -->
			<div class="nav-search-bar" id="navSearchBar">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" placeholder="<?php esc_attr_e( 'Keresés...', 'playgroundtheme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
					<button type="submit">→</button>
				</form>
			</div>

			<!-- Kapcsolat Button -->
			<a href="/kapcsolat" class="btn btn-nav">Kapcsolat</a>

			<!-- Mobile Hamburger -->
			<button class="nav-hamburger" id="navHamburger" aria-label="Menu" aria-expanded="false">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>

	</div><!-- .nav-container -->

	<!-- Mobile Menu -->
	<div class="mobile-menu" id="mobileMenu">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'mobile-primary-menu',
				'menu_class'     => 'mobile-nav-menu',
				'container'      => false,
			)
		);
		?>
		<a href="/kapcsolat" class="btn btn-nav mobile-kapcsolat">Kapcsolat</a>
	</div>

</header><!-- #masthead -->
