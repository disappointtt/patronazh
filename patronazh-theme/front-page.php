<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

get_template_part( 'template-parts/section', 'hero' );
get_template_part( 'template-parts/section', 'about' );
get_template_part( 'template-parts/section', 'services' );
get_template_part( 'template-parts/section', 'pricing' );
get_template_part( 'template-parts/section', 'staff' );
get_template_part( 'template-parts/section', 'faq' );
get_template_part( 'template-parts/section', 'contacts' );

get_footer();
