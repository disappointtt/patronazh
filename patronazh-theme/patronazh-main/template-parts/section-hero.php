<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$contact = patronazh_get_contact_info();
$primary_phone = isset( $contact['phones'][0] ) ? $contact['phones'][0] : '';
?>
<section class="section hero">
	<div class="container hero__inner">
		<div class="hero__content">
			<p class="hero__eyebrow">Патронажная служба</p>
			<h1>Заботливый уход на дому и в стационаре</h1>
			<p class="hero__lead">Помощь пожилым людям и людям с инвалидностью. Подбираем график и формат ухода с учетом состояния и пожеланий семьи.</p>
			<div class="hero__actions">
				<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>">Оставить заявку</a>
				<?php if ( $primary_phone ) : ?>
					<a class="btn btn--outline" href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $primary_phone ) ); ?>">Позвонить</a>
				<?php endif; ?>
			</div>
			<div class="hero__meta">
				<div>
					<span class="hero__meta-title">Сертифицированный персонал</span>
					<span>Опыт и допуски подтверждены</span>
				</div>
				<div>
					<span class="hero__meta-title">Гибкий график</span>
					<span>Дневные, ночные и круглосуточные смены</span>
				</div>
			</div>
		</div>
		<div class="hero__media">
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/hero.jpg' ) ); ?>" alt="Сиделка помогает пожилому человеку" loading="lazy">
		</div>
	</div>
</section>
