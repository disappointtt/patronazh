<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
$notice = isset( $_GET['review'] ) ? sanitize_text_field( wp_unslash( $_GET['review'] ) ) : '';
$fallback_reviews = array(
	array(
		'name' => 'Ахтаева Гульден',
		'rating' => 5,
		'text' => 'Милые вы наши спасители! Нет слов, чтобы выразить вам благодарность за все, что вы сделали для нас, нашей мамы. После перелома шейки бедра и операции нас выписали домой, и тут мы и растерялись... Я очень благодарна вам за ваш высокий профессионализм и заботу!',
	),
	array(
		'name' => 'Семья Березиных',
		'rating' => 5,
		'text' => 'Выражаем глубокую искреннюю благодарность замечательной команде патронажной службы! Руководитель Светлана Тамабаевна сразу выехала к нам в стационар, был составлен график дежурств, оформлены все документы. Огромных вам, дорогие, успехов и здоровья!',
	),
	array(
		'name' => 'Мацкевич Наталья Викторовна',
		'rating' => 5,
		'text' => 'Спасибо лично Вам и всему коллективу за искреннее внимание и отличный уход! Низкий поклон вам всем, удачи в непростой работе.',
	),
	array(
		'name' => 'Вера Ивановна Русских',
		'rating' => 5,
		'text' => 'Спасибо за такой нелегкий труд, за отлично отобранную команду. Девочки профессионалы, деликатные и внимательные, создают уют в доме. Низкий вам поклон!',
	),
);
?>
<section class="section section--page">
	<div class="container">
		<h1 class="page-title">Отзывы</h1>
		<p class="section-lead">Мы ценим доверие наших клиентов и бережно относимся к каждому отзыву. Новые отзывы проходят модерацию.</p>
		<?php if ( 'success' === $notice ) : ?>
			<div class="notice notice--success">Спасибо! Ваш отзыв отправлен на модерацию.</div>
		<?php elseif ( 'error' === $notice ) : ?>
			<div class="notice notice--error">Пожалуйста, заполните все обязательные поля.</div>
		<?php elseif ( 'limit' === $notice ) : ?>
			<div class="notice notice--error">Слишком много отправок. Попробуйте позже.</div>
		<?php elseif ( 'invalid' === $notice ) : ?>
			<div class="notice notice--error">Не удалось отправить отзыв. Попробуйте еще раз.</div>
		<?php endif; ?>
	</div>
</section>

<section class="section section--light">
	<div class="container">
		<div class="review-grid">
			<?php
			$query = new WP_Query(
				array(
					'post_type' => 'review',
					'post_status' => 'publish',
					'posts_per_page' => 8,
				)
			);
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();
					$rating = absint( get_post_meta( get_the_ID(), 'review_rating', true ) );
					?>
					<article class="review-card">
						<div class="review-card__rating"><?php echo esc_html( str_repeat( '*', max( 1, $rating ) ) ); ?></div>
						<h3><?php the_title(); ?></h3>
						<p><?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?></p>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			else :
				foreach ( $fallback_reviews as $review ) :
					?>
					<article class="review-card">
						<div class="review-card__rating"><?php echo esc_html( str_repeat( '*', $review['rating'] ) ); ?></div>
						<h3><?php echo esc_html( $review['name'] ); ?></h3>
						<p><?php echo esc_html( $review['text'] ); ?></p>
					</article>
					<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>

<?php if ( patronazh_forms_enabled() ) : ?>
	<section class="section">
		<div class="container">
			<h2 class="section-title">Оставить отзыв</h2>
			<?php echo patronazh_render_review_form(); ?>
		</div>
	</section>
<?php endif; ?>
<?php
get_footer();
