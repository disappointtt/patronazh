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
		<?php if ( patronazh_forms_enabled() ) : ?>
			<div class="contact-block__form">
				<h3>Оставить заявку</h3>
				<?php if ( 'success' === $notice ) : ?>
					<div class="notice notice--success">Спасибо! Мы свяжемся с вами в ближайшее время.</div>
				<?php elseif ( 'error' === $notice ) : ?>
					<div class="notice notice--error">Пожалуйста, заполните все обязательные поля.</div>
				<?php elseif ( 'limit' === $notice ) : ?>
					<div class="notice notice--error">Слишком много отправок. Попробуйте позже.</div>
				<?php elseif ( 'invalid' === $notice ) : ?>
					<div class="notice notice--error">Не удалось отправить заявку. Попробуйте еще раз.</div>
				<?php endif; ?>
				<?php echo patronazh_render_request_form(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
