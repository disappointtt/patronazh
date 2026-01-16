<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$contact = patronazh_get_contact_info();
$notice = isset( $_GET['request'] ) ? sanitize_text_field( wp_unslash( $_GET['request'] ) ) : '';
?>
<section class="section section--pattern">
	<div class="container contact-block">
		<div class="contact-block__info">
			<h2 class="section-title">Свяжитесь с нами</h2>
			<p>Мы находимся: <?php echo esc_html( $contact['address'] ); ?></p>
			<?php if ( ! empty( $contact['phones'] ) ) : ?>
				<p>Телефоны:</p>
				<ul>
					<?php foreach ( $contact['phones'] as $phone ) : ?>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if ( ! empty( $contact['email'] ) ) : ?>
				<p>Почта: <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p>
			<?php endif; ?>
			<p><?php echo esc_html( $contact['work_hours'] ); ?></p>
		</div>
	</div>
</section>
