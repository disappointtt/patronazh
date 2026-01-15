<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
$contact = patronazh_get_contact_info();
$notice = isset( $_GET['request'] ) ? sanitize_text_field( wp_unslash( $_GET['request'] ) ) : '';
?>
<section class="section section--page">
	<div class="container">
		<h1 class="page-title">Контакты</h1>
		<p class="section-lead">Мы на связи и готовы ответить на ваши вопросы.</p>
	</div>
</section>

<section class="section section--light">
	<div class="container contact-grid">
		<div class="contact-card">
			<h2>Телефоны</h2>
			<?php if ( ! empty( $contact['phones'] ) ) : ?>
				<ul>
					<?php foreach ( $contact['phones'] as $phone ) : ?>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="contact-card">
			<h2>Почта</h2>
			<?php if ( ! empty( $contact['email'] ) ) : ?>
				<p><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p>
			<?php endif; ?>
			<p><?php echo esc_html( $contact['work_hours'] ); ?></p>
		</div>
		<div class="contact-card">
			<h2>Адрес</h2>
			<p><?php echo esc_html( $contact['address'] ); ?></p>
			<!-- TODO: Добавить карту/точный адрес при наличии -->
		</div>
	</div>
</section>

<?php if ( patronazh_forms_enabled() ) : ?>
	<section class="section">
		<div class="container">
			<h2 class="section-title">Оставить заявку</h2>
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
	</section>
<?php endif; ?>
<?php
get_footer();
