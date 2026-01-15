<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section section--pattern">
	<div class="container">
		<h2 class="section-title">Цены и условия</h2>
		<p class="section-lead">От 240 тенге. Стоимость зависит от состояния подопечного, веса и графика работы.</p>
		<div class="pricing-highlights">
			<div>
				<h3>Тяжесть состояния</h3>
				<p>Для неподвижных пациентов или при круглосуточном уходе условия рассчитываются отдельно.</p>
			</div>
			<div>
				<h3>Вес подопечного</h3>
				<p>Обычно от 80 кг +10% к оплате, от 100 кг +20% к оплате.</p>
			</div>
			<div>
				<h3>График работы</h3>
				<p>Приходящая, круглосуточная или с проживанием — подбираем оптимальный вариант.</p>
			</div>
		</div>
		<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>">Смотреть цены</a>
	</div>
</section>
