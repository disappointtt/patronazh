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
			<a class="btn btn--primary" href="https://wa.me/87084369660">
				<svg class="btn__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
					<path d="M12 4.5a7.5 7.5 0 0 0-6.43 11.33L4.5 20l4.34-1.1A7.5 7.5 0 1 0 12 4.5zm0 13.5a6 6 0 0 1-3.06-.84l-.22-.13-2.56.65.68-2.5-.14-.23A6 6 0 1 1 12 18zm3.28-4.2c-.18-.09-1.05-.52-1.21-.58-.16-.06-.28-.09-.4.09-.12.18-.46.58-.56.7-.1.12-.2.14-.38.05-.18-.09-.75-.28-1.43-.89-.53-.47-.89-1.06-.99-1.23-.1-.18-.01-.27.08-.36.08-.08.18-.2.27-.3.09-.1.12-.18.18-.3.06-.12.03-.23-.02-.32-.05-.09-.4-.96-.55-1.32-.15-.36-.3-.31-.4-.31l-.34-.01c-.12 0-.32.05-.49.23-.17.18-.64.62-.64 1.5 0 .88.66 1.73.75 1.85.09.12 1.29 1.97 3.13 2.76.44.19.79.3 1.06.38.44.14.84.12 1.15.07.35-.05 1.05-.43 1.2-.84.15-.41.15-.76.11-.84-.04-.08-.16-.12-.34-.21z"/>
				</svg>
				Связаться
			</a>
		<?php endif; ?>
	</div>
</div>
<footer class="site-footer">
	<div class="container site-footer__inner">
		<div class="site-footer__brand">
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo-alt.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<p class="site-footer__tagline">Евразия Мед: помощь пожилым людям и людям с инвалидностью.</p>
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
