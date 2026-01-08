<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<section class="section section--page">
	<div class="container">
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="content">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	</div>
</section>
<?php
get_footer();
