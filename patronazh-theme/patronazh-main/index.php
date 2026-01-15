<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="section section--page">
	<div class="container">
		<h1 class="page-title"><?php echo esc_html( get_the_archive_title() ); ?></h1>
		<?php if ( have_posts() ) : ?>
			<div class="post-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="post-card">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post-card__excerpt"><?php the_excerpt(); ?></div>
					</article>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<p>Записей пока нет.</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
