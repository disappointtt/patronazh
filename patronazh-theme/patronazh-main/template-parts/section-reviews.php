<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$fallback_reviews = array(
	array(
		'name' => 'Ахтаева Гульден',
		'rating' => 5,
		'text' => 'Милые вы наши спасители! Нет слов, чтобы выразить вам благодарность за все, что вы сделали для нас, нашей мамы... Спасибо за заботу!',
	),
	array(
		'name' => 'Семья Березиных',
		'rating' => 5,
		'text' => 'Выражаем глубокую искреннюю благодарность замечательной команде патронажной службы! Добрые, улыбчивые лица помогли вернуть надежду.',
	),
	array(
		'name' => 'Вера Ивановна Русских',
		'rating' => 5,
		'text' => 'Спасибо за такой нелегкий труд, за отлично отобранную команду. Девочки профессионалы, деликатные и внимательные.',
	),
);
?>
<section class="section">
	<div class="container">
		<div class="section-header">
			<h2 class="section-title">Отзывы</h2>
			<a class="link" href="<?php echo esc_url( home_url( '/reviews/' ) ); ?>">Все отзывы</a>
		</div>
		<div class="review-grid">
			<?php
			$query = new WP_Query(
				array(
					'post_type' => 'review',
					'post_status' => 'publish',
					'posts_per_page' => 3,
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
