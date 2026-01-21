<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section section--light">
	<div class="container">
		<h2 class="section-title">О нас</h2>
		<p class="section-lead">Мы оказываем патронажные услуги с вниманием к человеку и уважением к семье.</p>
		<div class="feature-grid">
			<article class="feature-card">
				<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon-cert.png' ) ); ?>" alt="Сертифицированный персонал" loading="lazy">
				<h3>Опыт и допуски</h3>
				<p>В патронажной службе весь медперсонал с сертификатами, допуском и многолетним опытом работы по уходу за престарелыми и немощными людьми.</p>
				<div class="certificates">
					<h4 class="certificates__title">О сотрудниках и руководителе</h4>
					<details class="certificates__details">
						<summary class="certificates__summary">Показать сертификаты</summary>
						<div class="certificates__strip">
							<a class="certificates__item" href="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_102805.jpg' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_102805.jpg' ) ); ?>" alt="Сертификат 1" loading="lazy">
							</a>
							<a class="certificates__item" href="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_102821.jpg' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_102821.jpg' ) ); ?>" alt="Сертификат 2" loading="lazy">
							</a>
							<a class="certificates__item" href="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_102842.jpg' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_102842.jpg' ) ); ?>" alt="Сертификат 3" loading="lazy">
							</a>
							<a class="certificates__item" href="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_102851.jpg' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_102851.jpg' ) ); ?>" alt="Сертификат 4" loading="lazy">
							</a>
							<a class="certificates__item" href="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_103148.jpg' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_103148.jpg' ) ); ?>" alt="Сертификат 5" loading="lazy">
							</a>
							<a class="certificates__item" href="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_103156.jpg' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/certificates/20160316_103156.jpg' ) ); ?>" alt="Сертификат 6" loading="lazy">
							</a>
						</div>
						<div class="certificate-viewer" aria-hidden="true">
							<div class="certificate-viewer__backdrop" data-action="close"></div>
							<div class="certificate-viewer__content" role="dialog" aria-modal="true" aria-label="Сертификат">
								<button class="certificate-viewer__close" type="button" data-action="close" aria-label="Назад">&larr;</button>
								<img class="certificate-viewer__image" src="" alt="">
							</div>
						</div>
					</details>
				</div>
			</article>
			<article class="feature-card">
				<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon-quality.png' ) ); ?>" alt="Качество услуг" loading="lazy">
				<h3>Гибкие условия</h3>
				<p>У нас только качественные услуги, оплата зависит от различных показателей и поэтому гибкая.</p>
			</article>
			<article class="feature-card">
				<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/icon-contract.png' ) ); ?>" alt="Договор" loading="lazy">
				<h3>Договор и прозрачность</h3>
				<p>Услуги сиделки предоставляются только после заключения договора, в котором прописывается количество выходов на дежурство, срок, состояние больного и иные пожелания заказчика.</p>
			</article>
		</div>
	</div>
</section>
