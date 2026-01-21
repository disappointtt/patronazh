<?php
define( 'PATRONAZH_THEME_VERSION', '1.0.0' );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function patronazh_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 240, 'flex-height' => true, 'flex-width' => true ) );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'patronazh' ),
			'footer' => __( 'Footer Menu', 'patronazh' ),
		)
	);
}
add_action( 'after_setup_theme', 'patronazh_setup' );

function patronazh_get_page_link_by_slug( $slug, $fallback ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page );
	}

	return $fallback;
}

function patronazh_primary_menu_fallback() {
	$items = array(
		array(
			'label' => 'Главная',
			'url' => home_url( '/' ),
			'is_current' => is_front_page(),
		),
		array(
			'label' => 'Услуги',
			'url' => patronazh_get_page_link_by_slug( 'services', home_url( '/services/' ) ),
			'is_current' => is_page( 'services' ),
		),
		array(
			'label' => 'О нас',
			'url' => patronazh_get_page_link_by_slug( 'about', home_url( '/about/' ) ),
			'is_current' => is_page( 'about' ),
		),
		array(
			'label' => 'Контакты',
			'url' => patronazh_get_page_link_by_slug( 'contacts', home_url( '/contacts/' ) ),
			'is_current' => is_page( 'contacts' ),
		),
	);

	echo '<ul class="main-nav__list">';
	foreach ( $items as $item ) {
		$class = 'menu-item';
		if ( $item['is_current'] ) {
			$class .= ' current-menu-item';
		}
		printf(
			'<li class="%1$s"><a href="%2$s">%3$s</a></li>',
			esc_attr( $class ),
			esc_url( $item['url'] ),
			esc_html( $item['label'] )
		);
	}
	echo '</ul>';
}

function patronazh_ensure_core_pages() {
	$pages = array(
		'services' => array(
			'title' => 'Услуги',
		),
		'about' => array(
			'title' => 'О нас',
		),
		'contacts' => array(
			'title' => 'Контакты',
		),
	);

	$created = false;
	foreach ( $pages as $slug => $data ) {
		if ( get_page_by_path( $slug ) ) {
			continue;
		}

		$page_id = wp_insert_post(
			array(
				'post_title' => $data['title'],
				'post_name' => $slug,
				'post_status' => 'publish',
				'post_type' => 'page',
			)
		);

		if ( $page_id && ! is_wp_error( $page_id ) ) {
			$created = true;
		}
	}

	if ( $created ) {
		flush_rewrite_rules();
	}
}

function patronazh_maybe_create_core_pages() {
	if ( get_option( 'patronazh_core_pages_created' ) ) {
		return;
	}

	patronazh_ensure_core_pages();
	update_option( 'patronazh_core_pages_created', 1 );
}
add_action( 'after_switch_theme', 'patronazh_maybe_create_core_pages' );
add_action( 'init', 'patronazh_maybe_create_core_pages' );

function patronazh_enqueue_assets() {
	wp_enqueue_style(
		'patronazh-fonts',
		'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap',
		array(),
		null
	);

	$style_path = get_theme_file_path( '/assets/css/style.css' );
	$script_path = get_theme_file_path( '/assets/js/main.js' );
	$style_version = file_exists( $style_path ) ? filemtime( $style_path ) : PATRONAZH_THEME_VERSION;
	$script_version = file_exists( $script_path ) ? filemtime( $script_path ) : PATRONAZH_THEME_VERSION;

	wp_enqueue_style(
		'patronazh-style',
		get_theme_file_uri( '/assets/css/style.css' ),
		array( 'patronazh-fonts' ),
		$style_version
	);

	wp_enqueue_script(
		'patronazh-main',
		get_theme_file_uri( '/assets/js/main.js' ),
		array(),
		$script_version,
		true
	);

	wp_localize_script(
		'patronazh-main',
		'patronazhSettings',
		array(
			'formMinSeconds' => 3,
		)
	);
}
add_action( 'wp_enqueue_scripts', 'patronazh_enqueue_assets' );

function patronazh_add_defer_attribute( $tag, $handle ) {
	if ( 'patronazh-main' === $handle ) {
		return str_replace( ' src=', ' defer src=', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'patronazh_add_defer_attribute', 10, 2 );

function patronazh_register_cpts() {
	register_post_type(
		'review',
		array(
			'labels' => array(
				'name' => __( 'Reviews', 'patronazh' ),
				'singular_name' => __( 'Review', 'patronazh' ),
				'add_new_item' => __( 'Add Review', 'patronazh' ),
				'edit_item' => __( 'Edit Review', 'patronazh' ),
				'new_item' => __( 'New Review', 'patronazh' ),
				'view_item' => __( 'View Review', 'patronazh' ),
			),
			'public' => true,
			'show_in_rest' => true,
			'has_archive' => false,
			'menu_icon' => 'dashicons-testimonial',
			'supports' => array( 'title', 'editor' ),
		)
	);

	register_post_type(
		'request',
		array(
			'labels' => array(
				'name' => __( 'Requests', 'patronazh' ),
				'singular_name' => __( 'Request', 'patronazh' ),
				'add_new_item' => __( 'Add Request', 'patronazh' ),
				'edit_item' => __( 'Edit Request', 'patronazh' ),
				'new_item' => __( 'New Request', 'patronazh' ),
				'view_item' => __( 'View Request', 'patronazh' ),
			),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => 'dashicons-email-alt',
			'exclude_from_search' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'supports' => array( 'title', 'editor' ),
		)
	);
}
add_action( 'init', 'patronazh_register_cpts' );

function patronazh_get_contact_info() {
	$info = array(
		'phones' => array(
			'+7 777 570 09 47',
			'+7 708 436 96 60',
			'+7 7212-36 96 60',
		),
		'email' => 'svetik_76s@mail.ru',
		'address' => 'Город Караганда, Бухар Жырау 33',
		'work_hours' => 'Ежедневно, 09:00-20:00',
	);

	return apply_filters( 'patronazh_contact_info', $info );
}

function patronazh_get_faq_items() {
	$items = array(
		array(
			'question' => 'Как формируется стоимость услуг?',
			'answer' => 'Стоимость зависит от тяжести состояния, веса подопечного и графика работы. Подробные условия обсуждаются при консультации.',
		),
		array(
			'question' => 'Можно ли организовать круглосуточное дежурство?',
			'answer' => 'Да, при необходимости мы организуем посменный график наблюдения (день/ночь или сутки через сутки).',
		),
		array(
			'question' => 'Как быстро можно начать обслуживание?',
			'answer' => 'Обычно мы можем приступить после согласования графика и условий. Точные сроки уточняйте по телефону.',
		),
		array(
			'question' => 'Вы работаете с проживанием?',
			'answer' => 'Да, возможен вариант с проживанием. Условия зависят от состояния подопечного и состава семьи.',
		),
	);

	return apply_filters( 'patronazh_faq_items', $items );
}

function patronazh_output_faq_schema() {
	if ( ! is_front_page() ) {
		return;
	}

	$items = patronazh_get_faq_items();
	if ( empty( $items ) ) {
		return;
	}

	$schema = array(
		'@context' => 'https://schema.org',
		'@type' => 'FAQPage',
		'mainEntity' => array(),
	);

	foreach ( $items as $item ) {
		$schema['mainEntity'][] = array(
			'@type' => 'Question',
			'name' => $item['question'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text' => $item['answer'],
			),
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>';
}
add_action( 'wp_head', 'patronazh_output_faq_schema' );

function patronazh_output_open_graph() {
	if ( is_admin() ) {
		return;
	}

	$title = wp_get_document_title();
	$description = get_bloginfo( 'description' );
	$request_path = '';
	if ( isset( $GLOBALS['wp'] ) && is_object( $GLOBALS['wp'] ) ) {
		$request_path = $GLOBALS['wp']->request;
	}
	$url = home_url( add_query_arg( array(), $request_path ) );

	echo '<meta property="og:type" content="website" />';
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />';
	echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />';
	echo '<meta property="og:url" content="' . esc_url( $url ) . '" />';
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />';
}
add_action( 'wp_head', 'patronazh_output_open_graph', 5 );

function patronazh_get_client_ip() {
	$ip = '';
	if ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
		$ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
	}

	return $ip;
}

function patronazh_check_rate_limit( $key, $limit, $window_seconds ) {
	$data = get_transient( $key );
	if ( ! is_array( $data ) ) {
		set_transient( $key, array( 'count' => 1 ), $window_seconds );
		return false;
	}

	if ( $data['count'] >= $limit ) {
		return true;
	}

	$data['count']++;
	set_transient( $key, $data, $window_seconds );
	return false;
}

function patronazh_validate_honeypot_and_time( $form_type ) {
	$honeypot = isset( $_POST['patronazh_hp'] ) ? sanitize_text_field( wp_unslash( $_POST['patronazh_hp'] ) ) : '';
	if ( '' !== $honeypot ) {
		return false;
	}

	$timestamp = isset( $_POST['patronazh_time'] ) ? absint( $_POST['patronazh_time'] ) : 0;
	if ( ! $timestamp ) {
		return false;
	}

	$min_seconds = 3;
	$elapsed = time() - $timestamp;
	if ( $elapsed < $min_seconds ) {
		return false;
	}

	return true;
}

function patronazh_handle_review_form() {
	if ( ! isset( $_POST['patronazh_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['patronazh_nonce'] ) ), 'patronazh_review' ) ) {
		wp_safe_redirect( add_query_arg( 'review', 'invalid', wp_get_referer() ) );
		exit;
	}

	if ( ! patronazh_validate_honeypot_and_time( 'review' ) ) {
		wp_safe_redirect( add_query_arg( 'review', 'invalid', wp_get_referer() ) );
		exit;
	}

	$ip = patronazh_get_client_ip();
	$rate_key = 'patronazh_rl_review_' . md5( $ip );
	if ( patronazh_check_rate_limit( $rate_key, 3, 10 * MINUTE_IN_SECONDS ) ) {
		wp_safe_redirect( add_query_arg( 'review', 'limit', wp_get_referer() ) );
		exit;
	}

	$name = isset( $_POST['patronazh_name'] ) ? sanitize_text_field( wp_unslash( $_POST['patronazh_name'] ) ) : '';
	$rating = isset( $_POST['patronazh_rating'] ) ? absint( $_POST['patronazh_rating'] ) : 0;
	$rating = max( 1, min( 5, $rating ) );
	$comment = isset( $_POST['patronazh_comment'] ) ? sanitize_textarea_field( wp_unslash( $_POST['patronazh_comment'] ) ) : '';
	$consent = isset( $_POST['patronazh_consent'] ) ? 'yes' : 'no';

	if ( '' === $name || '' === $comment || 'yes' !== $consent ) {
		wp_safe_redirect( add_query_arg( 'review', 'error', wp_get_referer() ) );
		exit;
	}

	$review_id = wp_insert_post(
		array(
			'post_type' => 'review',
			'post_status' => 'pending',
			'post_title' => $name,
			'post_content' => $comment,
		)
	);

	if ( $review_id ) {
		update_post_meta( $review_id, 'review_rating', $rating );
		update_post_meta( $review_id, 'review_name', $name );
		update_post_meta( $review_id, 'review_ip', $ip );
		update_post_meta( $review_id, 'review_user_agent', isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '' );
	}

	$admin_email = get_option( 'admin_email' );
	$subject = 'Новый отзыв (требуется модерация)';
	$message = "Имя: {$name}\nРейтинг: {$rating}\nТекст: {$comment}";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	wp_mail( $admin_email, $subject, $message, $headers );

	wp_safe_redirect( add_query_arg( 'review', 'success', wp_get_referer() ) );
	exit;
}
add_action( 'admin_post_nopriv_patronazh_review', 'patronazh_handle_review_form' );
add_action( 'admin_post_patronazh_review', 'patronazh_handle_review_form' );

function patronazh_render_request_form() {
	$action = esc_url( admin_url( 'admin-post.php' ) );
	$timestamp = time();
	ob_start();
	?>
	<form class="form" method="post" action="<?php echo $action; ?>">
		<input type="hidden" name="action" value="patronazh_request" />
		<input type="hidden" name="patronazh_time" value="<?php echo esc_attr( $timestamp ); ?>" />
		<label class="form__label form__label--hp">
			<span>Компания</span>
			<input type="text" name="patronazh_hp" value="" autocomplete="off" tabindex="-1" />
		</label>
		<label class="form__label">
			<span>Имя</span>
			<input type="text" name="patronazh_name" required />
		</label>
		<label class="form__label">
			<span>Телефон</span>
			<input type="tel" name="patronazh_phone" required />
		</label>
		<label class="form__label">
			<span>Комментарий</span>
			<textarea name="patronazh_comment" rows="4"></textarea>
		</label>
		<label class="form__checkbox">
			<input type="checkbox" name="patronazh_consent" required />
			<span>Согласен(на) на обработку персональных данных</span>
		</label>
	<?php wp_nonce_field( 'patronazh_request', 'patronazh_nonce' ); ?>
	<button class="btn btn--primary" type="submit">Связаться</button>
</form>
	<?php
	return ob_get_clean();
}

function patronazh_render_review_form() {
	$action = esc_url( admin_url( 'admin-post.php' ) );
	$timestamp = time();
	ob_start();
	?>
	<form class="form" method="post" action="<?php echo $action; ?>">
		<input type="hidden" name="action" value="patronazh_review" />
		<input type="hidden" name="patronazh_time" value="<?php echo esc_attr( $timestamp ); ?>" />
		<label class="form__label form__label--hp">
			<span>Компания</span>
			<input type="text" name="patronazh_hp" value="" autocomplete="off" tabindex="-1" />
		</label>
		<label class="form__label">
			<span>Имя</span>
			<input type="text" name="patronazh_name" required />
		</label>
		<label class="form__label">
			<span>Рейтинг</span>
			<select name="patronazh_rating" required>
				<option value="5">5 — отлично</option>
				<option value="4">4 — хорошо</option>
				<option value="3">3 — нормально</option>
				<option value="2">2 — удовлетворительно</option>
				<option value="1">1 — плохо</option>
			</select>
		</label>
		<label class="form__label">
			<span>Отзыв</span>
			<textarea name="patronazh_comment" rows="4" required></textarea>
		</label>
		<label class="form__checkbox">
			<input type="checkbox" name="patronazh_consent" required />
			<span>Согласен(на) на обработку персональных данных</span>
		</label>
		<?php wp_nonce_field( 'patronazh_review', 'patronazh_nonce' ); ?>
		<button class="btn btn--primary" type="submit">Отправить отзыв</button>
	</form>
	<?php
	return ob_get_clean();
}

function patronazh_request_form_shortcode() {
	return patronazh_render_request_form();
}
add_shortcode( 'patronazh_request_form', 'patronazh_request_form_shortcode' );

function patronazh_review_form_shortcode() {
	return patronazh_render_review_form();
}
add_shortcode( 'patronazh_review_form', 'patronazh_review_form_shortcode' );

function patronazh_forms_enabled() {
	return apply_filters( 'patronazh_forms_enabled', true );
}
