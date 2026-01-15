<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$contact = patronazh_get_contact_info();
?><div class="site-cta">
	<div class="container site-cta__inner">
		<div>
			<h2 class="section-title">Нужна помощь?</h2>
			<p>Свяжитесь с нами и получите консультацию по уходу и формату обслуживания.</p>
		</div>
		<?php if ( patronazh_forms_enabled() ) : ?>
			<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>">Оставить заявку</a>
		<?php endif; ?>
	</div>
</div>
<footer class="site-footer">
	<div class="container site-footer__inner">
		<div class="site-footer__brand">
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo-alt.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<p class="site-footer__tagline">Патронажная служба: помощь пожилым людям и людям с инвалидностью.</p>
		</div>
		<div class="site-footer__contacts">
			<h3>Контакты</h3>
			<?php if ( ! empty( $contact['phones'] ) ) : ?>
				<ul>
					<?php foreach ( $contact['phones'] as $phone ) : ?>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if ( ! empty( $contact['email'] ) ) : ?>
				<p><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p>
			<?php endif; ?>
			<?php if ( ! empty( $contact['address'] ) ) : ?>
				<p><?php echo esc_html( $contact['address'] ); ?></p>
			<?php endif; ?>
		</div>
		<div class="site-footer__nav">
			<h3>Разделы</h3>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container' => false,
					'menu_class' => 'footer-nav__list',
					'fallback_cb' => false,
				)
			);
			?>
			<p><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Политика конфиденциальности</a></p>
		</div>
	</div>
	<div class="container site-footer__bottom">
		<p>(c) <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. Все права защищены.</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
