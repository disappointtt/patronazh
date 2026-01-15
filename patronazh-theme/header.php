<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$contact = patronazh_get_contact_info();
$primary_phone = isset( $contact['phones'][0] ) ? $contact['phones'][0] : '';
$phone_href = preg_replace( '/\s+/', '', $primary_phone );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content">Перейти к содержимому</a>
<header class="site-header">
	<div class="container site-header__inner">
		<div class="site-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				</a>
			<?php endif; ?>
			<div class="site-header__title">
				<span class="site-header__name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				<span class="site-header__tagline"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
			</div>
		</div>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-navigation">
			<span class="menu-toggle__line"></span>
			<span class="menu-toggle__line"></span>
			<span class="menu-toggle__line"></span>
			<span class="screen-reader-text">Открыть меню</span>
		</button>
		<nav class="main-nav" id="site-navigation" aria-label="Основное меню">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container' => false,
					'menu_class' => 'main-nav__list',
					'fallback_cb' => 'patronazh_primary_menu_fallback',
				)
			);
			?>
		</nav>
		<?php if ( $primary_phone ) : ?>
			<a class="btn btn--outline" href="tel:<?php echo esc_attr( $phone_href ); ?>">Позвонить</a>
		<?php endif; ?>
	</div>
</header>
<main id="main-content" class="site-main">
