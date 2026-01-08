<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items = patronazh_get_faq_items();
?>
<section class="section section--light">
	<div class="container">
		<h2 class="section-title">FAQ</h2>
		<div class="faq">
			<?php foreach ( $items as $index => $item ) : ?>
				<div class="faq-item">
					<button class="faq-question" type="button" aria-expanded="false">
						<?php echo esc_html( $item['question'] ); ?>
					</button>
					<div class="faq-answer">
						<p><?php echo esc_html( $item['answer'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
