<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="section section--page">
	<div class="container">
		<h1 class="page-title">О нас</h1>
		<div class="content">
			<p>В патронажной службе весь медперсонал с сертификатами, допуском и многолетним опытом работы по уходу за престарелыми и немощными людьми.</p>
			<p>У нас только качественные услуги, оплата зависит от различных показателей и поэтому гибкая.</p>
			<p>Услуги сиделки предоставляются только после заключения договора, в котором прописывается количество выходов на дежурство, срок, состояние больного и иные пожелания заказчика.</p>
		</div>
	</div>
</section>

<section class="section section--light">
	<div class="container">
		<h2 class="section-title">Персонал</h2>
		<p class="section-lead">Сиделка — непростая профессия, в ней приживаются только те, кто обладает не только образованием, но и особыми личными качествами — терпением, трудолюбием, чувством юмора, состраданием и искренностью. Данное сочетание — редкость, а мы с гордостью и со всей ответственностью можем заявить, что таковыми качествами обладает каждая наша сиделка!</p>
		<div class="staff-grid">
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/staff-1.jpg' ) ); ?>" alt="Сотрудник патронажной службы">
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/staff-2.jpg' ) ); ?>" alt="Сотрудник патронажной службы">
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/staff-3.jpg' ) ); ?>" alt="Сотрудник патронажной службы">
			<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/staff-4.jpg' ) ); ?>" alt="Сотрудник патронажной службы">
		</div>
	</div>
</section>
<?php
get_footer();
