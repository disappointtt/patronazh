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
			<p><?php echo esc_html( $contact['work_hours'] ); ?></p>
		</div>
		<div class="contact-card">
			<h2>Телеграм</h2>
			<a class="contact-link contact-link--tg" href="https://t.me/77775700947" target="_blank" rel="noopener noreferrer">
				<svg class="contact-link__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
					<path d="M21.5 3.6c.4-.2.8.2.7.6l-3.4 16.1c-.1.5-.7.7-1.1.4l-4.8-3.5-2.3 2.2c-.3.3-.8.2-.9-.2l-1.5-5.6L3.2 11c-.5-.2-.5-.9.1-1.1L21.5 3.6zM9.6 13.7l1.2 4.3.2-2.1 7.1-8.1-8.5 5.9z"/>
				</svg>
				<span>Написать в Telegram</span>
			</a>
		</div>
		<div class="contact-card">
			<h2>Инстаграм</h2>
			<a class="contact-link contact-link--ig" href="https://www.instagram.com/eurasia_med/" target="_blank" rel="noopener noreferrer">
				<svg class="contact-link__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
					<path d="M16.8 3H7.2A4.2 4.2 0 0 0 3 7.2v9.6A4.2 4.2 0 0 0 7.2 21h9.6a4.2 4.2 0 0 0 4.2-4.2V7.2A4.2 4.2 0 0 0 16.8 3zm2.2 13.8a2.2 2.2 0 0 1-2.2 2.2H7.2A2.2 2.2 0 0 1 5 16.8V7.2A2.2 2.2 0 0 1 7.2 5h9.6A2.2 2.2 0 0 1 19 7.2v9.6z"/>
					<path d="M12 7.4a4.6 4.6 0 1 0 0 9.2 4.6 4.6 0 0 0 0-9.2zm0 7.2a2.6 2.6 0 1 1 0-5.2 2.6 2.6 0 0 1 0 5.2z"/>
					<circle cx="16.7" cy="7.3" r="1.1"/>
				</svg>
				<span>Перейти в Instagram</span>
			</a>
		</div>
		<div class="contact-card">
			<h2>Ватсап</h2>
			<a class="contact-link contact-link--wa" href="https://wa.me/87084369660" target="_blank" rel="noopener noreferrer">
				<svg class="contact-link__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
					<path d="M12 4.1a7.9 7.9 0 0 0-6.8 11.9L4 20l4.1-1.1A7.9 7.9 0 1 0 12 4.1zm0 14.1a6.2 6.2 0 0 1-3.1-.8l-.2-.1-2.4.6.6-2.3-.1-.2A6.2 6.2 0 1 1 12 18.2zm3.5-4.4c-.2-.1-1.1-.6-1.3-.7-.2-.1-.3-.1-.4.1l-.6.7c-.1.1-.2.2-.4.1-.2-.1-.8-.3-1.5-.9-.6-.5-.9-1.1-1-1.3-.1-.2 0-.3.1-.4l.3-.3c.1-.1.1-.2.2-.3.1-.1 0-.2 0-.3l-.6-1.4c-.2-.4-.3-.3-.4-.3h-.3c-.1 0-.3 0-.5.2-.2.2-.6.6-.6 1.5 0 .9.7 1.8.8 1.9.1.1 1.4 2.1 3.3 2.9.5.2.9.3 1.2.4.5.1.9.1 1.2.1.4-.1 1.1-.5 1.3-.9.2-.4.2-.8.2-.9 0-.1-.2-.2-.4-.3z"/>
				</svg>
				<span>Написать в WhatsApp</span>
			</a>
		</div>
		<div class="contact-card">
			<h2>2ГИС</h2>
			<a class="contact-link contact-link--gis" href="https://2gis.kz/karaganda/geo/70000001022213916" target="_blank" rel="noopener noreferrer">
				<svg class="contact-link__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
					<path d="M12 2a8.2 8.2 0 0 0-8.2 8.2c0 5.6 7 11.2 7.3 11.4.5.4 1.1.4 1.6 0 .3-.2 7.3-5.8 7.3-11.4A8.2 8.2 0 0 0 12 2zm0 11.5a3.3 3.3 0 1 1 0-6.6 3.3 3.3 0 0 1 0 6.6z"/>
				</svg>
				<span>Открыть на карте 2ГИС</span>
			</a>
		</div>
		<div class="contact-card">
			<h2>Почта</h2>
			<?php if ( ! empty( $contact['email'] ) ) : ?>
				<p><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p>
			<?php endif; ?>
		</div>
		<div class="contact-card">
			<h2>Адрес</h2>
			<p><?php echo esc_html( $contact['address'] ); ?></p>
			<!-- TODO: Добавить карту/точный адрес при наличии -->
		</div>
	</div>
</section>

<?php
get_footer();
