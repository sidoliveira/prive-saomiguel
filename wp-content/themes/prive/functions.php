<?php

if ( ! function_exists( 'astrid_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function astrid_setup() {

	// add_action("init","reset_editor");
	// function reset_editor() {
	// 	global $_wp_post_type_features;

	// 	$post_type="page";
	// 	$feature = "editor";
	// 	if ( !isset($_wp_post_type_features[$post_type]) )
	// 	{

	// 	}
	// 	elseif ( isset($_wp_post_type_features[$post_type][$feature]) ){
	// 		unset($_wp_post_type_features[$post_type][$feature]);
	// 	}
	// }

	add_action('do_meta_boxes', 'remove_thumbnail_box');
	function remove_thumbnail_box($post_type) {
	  remove_meta_box( 'postimagediv', 'page.php', 'side' );
	}

	function custom_menu_page_removing() {
	    remove_menu_page('edit.php');
	    remove_menu_page('edit-comments.php');
	}
	add_action( 'admin_menu', 'custom_menu_page_removing' );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Astrid, use a find and replace
	 * to change 'astrid' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'astrid', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('astrid-large-thumb', 700);
	add_image_size('astrid-medium-thumb', 520);
	add_image_size('astrid-small-thumb', 360);
	add_image_size('astrid-project-thumb', 500, 310, true);
	add_image_size('astrid-client-thumb', 250);
	add_image_size('astrid-testimonial-thumb', 100);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' 	=> esc_html__( 'Primary', 'astrid' ),
		'footer' 	=> esc_html__( 'Footer', 'astrid' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'astrid_custom_background_args', array(
		'default-color' => 'f5f9f8',
		'default-image' => '',
	) ) );

	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
	) );
}
endif;
add_action( 'after_setup_theme', 'astrid_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function astrid_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'astrid_content_width', 640 );
}
add_action( 'after_setup_theme', 'astrid_content_width', 0 );

//Homepage widgets
$astrid_widgets = array('services', 'skills', 'facts', 'employees', 'projects', 'testimonials', 'clients', 'posts');
foreach ( $astrid_widgets as $astrid_widget) {
	locate_template( '/inc/framework/widgets/front-' . $astrid_widget . '.php', true, false );
}

/**
 * Enqueue scripts and styles.
 */
function astrid_scripts() {
	wp_enqueue_style( 'astrid-style', get_stylesheet_uri() );

	$body_font 		= get_theme_mod('body_font_name', '//fonts.googleapis.com/css?family=Open+Sans:300,300italic,600,600italic');
	$headings_font 	= get_theme_mod('headings_font_name', '//fonts.googleapis.com/css?family=Josefin+Sans:300italic,300');
	$remove 		= array("<link href='", "' rel='stylesheet' type='text/css'>", "https:", "http:");
	$body_url 		= str_replace($remove, '', $body_font);
	$headings_url 	= str_replace($remove, '', $headings_font);	

	wp_enqueue_style( 'astrid-body-fonts', esc_url($body_url) ); 
	
	wp_enqueue_style( 'astrid-headings-fonts', esc_url($headings_url) ); 	

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );	

	wp_enqueue_script( 'astrid-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );

	wp_enqueue_script( 'astrid-scripts', get_template_directory_uri() . '/js/scripts.min.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( astrid_blog_layout() == 'masonry-layout' && (is_home() || is_archive()) ) {
		wp_enqueue_script( 'astrid-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array('masonry'), '', true );		
	}

	wp_enqueue_script( 'astrid-html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), '', true );
    wp_script_add_data( 'astrid-html5shiv', 'conditional', 'lt IE 9' );

}
add_action( 'wp_enqueue_scripts', 'astrid_scripts' );

/**
 * Enqueue Bootstrap
 */
function astrid_enqueue_bootstrap() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'astrid_enqueue_bootstrap', 9 );


/**
 * Customizer styles
 */
function astrid_customizer_styles($hook) {
	global $post;
	if ($post->post_name == 'home'){
		wp_enqueue_style( 'home-style', get_template_directory_uri() . '/home.css' );
	}
	if ($post->post_name == 'a-casa'){
		wp_enqueue_style( 'a-casa-style', get_template_directory_uri() . '/a-casa.css' );
	}
	if ($post->post_name == 'garotas'){
		wp_enqueue_style( 'garotas-style', get_template_directory_uri() . '/garotas.css' );
	}
	if ($post->post_name == 'contato'){
		wp_enqueue_style( 'contato-style', get_template_directory_uri() . '/contato.css' );
	}


    if ( ( 'customize.php' != $hook ) && ( 'widgets.php' != $hook ) ) {
        return;
    } 	
	wp_enqueue_style( 'astrid-customizer-styles', get_template_directory_uri() . '/inc/framework/css/customizer.css' );	
}
add_action( 'admin_enqueue_scripts', 'astrid_customizer_styles' );

/**
 * Blog layout
 */
function astrid_blog_layout() {
	$layout = get_theme_mod('blog_layout','list');
	return $layout;
}

/**
 * Remove archives labels
 */
function astrid_category_label($title) {
    if ( is_category() ) {
        $title = '<i class="fa fa-folder-o"></i>' . single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = '<i class="fa fa-tag"></i>' . single_tag_title( '', false );    	
    } elseif ( is_author() ) {
		$title = '<span class="vcard"><i class="fa fa-user"></i>' . get_the_author() . '</span>';
	}
    return $title;
}
add_filter('get_the_archive_title', 'astrid_category_label');

/**
 * Header image check
 */
function astrid_has_header() {
	$front_header = get_theme_mod('front_header_type' ,'image');
	$site_header = get_theme_mod('site_header_type', 'nothing');
	global $post;
	if ( !is_404() && !is_search() ) {
		$single_toggle = get_post_meta( $post->ID, '_astrid_header_key', true );
	} else {
		$single_toggle = false;
	}

	if ( get_header_image() && ( $front_header == 'image' && is_front_page() ) || ( $site_header == 'image' && !is_front_page() ) ) {
		if (!$single_toggle)
		return 'has-header';
	} elseif ( ($front_header == 'shortcode' && is_front_page()) || ($site_header == 'shortcode' && !is_front_page()) ) {
		if (!$single_toggle)
		return 'has-shortcode';
	}
}

/**
 * Polylang compatibility
 */
if ( function_exists('pll_register_string') ) :
function astrid_polylang() {
	pll_register_string('Header text', get_theme_mod('header_text'), 'Astrid');
	pll_register_string('Header subtext', get_theme_mod('header_subtext'), 'Astrid');
	pll_register_string('Header button', get_theme_mod('header_button'), 'Astrid');
}
add_action( 'admin_init', 'astrid_polylang' );
endif;

/**
 * Header text
 */
function astrid_header_text() {

	if ( !function_exists('pll_register_string') ) {
		$header_text 		= get_theme_mod('header_text');
		$header_subtext 	= get_theme_mod('header_subtext');
		$header_button		= get_theme_mod('header_button');
	} else {
		$header_text 		= pll__(get_theme_mod('header_text'));
		$header_subtext 	= pll__(get_theme_mod('header_subtext'));
		$header_button		= pll__(get_theme_mod('header_button'));
	}
	$header_button_url	= get_theme_mod('header_button_url');

	echo '<div class="header-info">
			<div class="container">
				<h4 class="header-subtext">' . wp_kses_post($header_subtext) . '</h4>
				<h3 class="header-text">' . wp_kses_post($header_text) . '</h3>';
				if ($header_button_url) {
					echo '<a class="button header-button" href="' . esc_url($header_button_url) . '">' . esc_html($header_button) . '</a>';
				}
	echo 	'</div>';
	echo '</div>';
}

/**
 * Site branding
 */
if ( ! function_exists( 'astrid_branding' ) ) :
function astrid_branding() {
	$site_logo = get_theme_mod('site_logo');	
	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo();
	} elseif ( $site_logo ) {
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr(get_bloginfo('name')) . '"><img class="site-logo" src="' . esc_url($site_logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '" /></a>'; 
	} else {
		echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html(get_bloginfo('name')) . '</a></h1>';
		echo '<p class="site-description">' . esc_html(get_bloginfo( 'description' )) . '</p>';
	}
}
endif;

/**
 * Clearfix posts
 */
function astrid_clearfix_posts( $classes ) {
	$classes[] = 'clearfix';
	return $classes;
}
add_filter( 'post_class', 'astrid_clearfix_posts' );

/**
 * Excerpt length
 */
function astrid_excerpt_length( $length ) {
  $excerpt = get_theme_mod('exc_length', '40');
  return absint($excerpt);
}
add_filter( 'excerpt_length', 'astrid_excerpt_length', 99 );

/**
* Footer credits
*/
function astrid_footer_credits() {
	echo '<a href="' . esc_url( __( 'https://wordpress.org/', 'astrid' ) ) . '">';
		printf( __( 'Powered by %s', 'astrid' ), 'WordPress' );
	echo '</a>';
	echo '<span class="sep"> | </span>';
	printf( __( 'Theme: %2$s by %1$s.', 'astrid' ), 'aThemes', '<a href="http://athemes.com/theme/astrid" rel="designer">Astrid</a>' );
}
add_action( 'astrid_footer', 'astrid_footer_credits' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

add_filter( 'rwmb_meta_boxes', 'geral_pages_register_meta_boxes' );
function geral_pages_register_meta_boxes( $meta_boxes ) {
	wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/admin.css' );

    $prefix = 'rw_';

    $meta_boxes[] = array(
        'id'         => 'adm_title',
        'title'      => __( 'Titulo do Corpo ', 'textdomain' ),
        'post_types' => 'page',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => __( 'Titulo: ', 'textdomain' ),
                'id'    => $prefix . 'title',
                'type'  => 'text',
                'class' => 'title-adm',
            ),
        )
    );

    $meta_boxes[] = array(
		  'id'         => 'adm_image',
		  'title'      => __( 'Imagem do Corpo', 'textdomain' ),
		  'post_types' => 'page',
		  'context'    => 'normal',
		  'priority'   => 'high',
		  'fields' => array(
		      array(
		          'name'  => __( 'Imagem: ', 'textdomain' ),
		          'id'    => $prefix . 'image',
		          'type'  => 'image_advanced',
		          'class' => 'title-adm',
		      ),
		  	)
		);

		$meta_boxes[] = array(
			'id'     		 => 'adm_precos',
			'title'			 => __( 'Preço por Horário', 'preco-horario' ),
			'post_types' => 'page',
			'context'    => 'normal',
		  	'priority'   => 'high',
			'fields' 		 => array(
				array(
					'id'      => $prefix . 'preco',
					'type'    => 'text_list',
					'clone' 	=> true,
					'options' => array(
						'00:00H'  =>	__( '<= Horário', 'preco-horario' ),
						'00,00' 	=>	__( '<= Preço', 'preco-horario' ),
					),
				),
			),
		);

		$meta_boxes[] = array(
	        'id'         => 'adm_precos_casa',
	        'title'      => __( 'Preços Principais', 'preco-casa' ),
	        'post_types' => 'page',
	        'context'    => 'normal',
	        'priority'   => 'high',
	        'fields' => array(
	            array(
	                'name'  => __( 'Horário 1: ', 'preco-casa' ),
	                'id'    => $prefix . 'preco-casa1',
	                'placeholder' => __( '00:00H', 'preco-casa' ),
	                'type'  => 'text',
	                'size'        => 5,
	                'class' => 'preco-casa',
	            ),
	            array(
	                'name'  => __( 'Preço 1: ', 'preco-casa' ),
	                'id'    => $prefix . 'horario-casa1',
	                'placeholder' => __( '00,00', 'preco-casa' ),
	                'type'  => 'text',
	                'size'        => 5,
	                'class' => 'preco-casa',
	            ),
	            array(
	                'name'  => __( 'Horário 2: ', 'preco-casa' ),
	                'id'    => $prefix . 'preco-casa2',
	                'placeholder' => __( '00:00H', 'preco-casa' ),
	                'type'  => 'text',
	                'size'        => 5,
	                'class' => 'preco-casa',
	            ),
	            array(
	                'name'  => __( 'Preço 2: ', 'preco-casa' ),
	                'id'    => $prefix . 'horario-casa2',
	                'placeholder' => __( '00,00', 'preco-casa' ),
	                'type'  => 'text',
	                'size'        => 5,
	                'class' => 'preco-casa',
	            ),
	        )
	    );

		$meta_boxes[] = array(
		  'id'         => 'adm_ambientes',
		  'title'      => __( 'Ambientes', 'textdomain' ),
		  'post_types' => 'page',
		  'context'    => 'normal',
		  'priority'   => 'high',
			'fields' 		 => array(
				array(
					'id'      => $prefix . 'ambientes',
					'type'    => 'text_list',
					'clone' 	=> true,
					'options' => array(
						'icone'  =>	__( '<= Nome do ícone', 'ambientes' ),
						'titulo' 	=>	__( '<= Título', 'ambientes' ),
						'descrição' 	=>	__( '<= Descrição', 'ambientes' ),
					),
				),
			),
		);

		$meta_boxes[] = array(
	        'id'         => 'adm_contato',
	        'title'      => __( 'Informações de Contato', 'textdomain' ),
	        'post_types' => 'page',
	        'context'    => 'normal',
	        'priority'   => 'high',
	        'fields' => array(
	            array(
	                'name'  => __( 'Endereço: ', 'textdomain' ),
	                'id'    => $prefix . 'endereco',
	                'type'  => 'text',
	                'class' => 'preco-casa',
	            ),
	            array(
	                'name'  => __( 'Telefone: ', 'textdomain' ),
	                'id'    => $prefix . 'telefone',
	                'type'  => 'text',
	                'class' => 'preco-casa',
	                'size'	=> 13,
	            ),
	            array(
	                'name'  => __( 'Whatsapp: ', 'textdomain' ),
	                'id'    => $prefix . 'whatsapp',
	                'type'  => 'text',
	                'class' => 'preco-casa',
	                'size'	=> 13,
	            ),
	            array(
	                'name'  => __( 'Funcionamento: ', 'textdomain' ),
	                'id'    => $prefix . 'horario-func',
	                'type'  => 'text',
	                'class' => 'preco-casa',
	            ),
	            array(
	                'name'  => __( 'Domingo: ', 'textdomain' ),
	                'id'    => $prefix . 'horario-func-dom',
	                'type'  => 'text',
	                'class' => 'preco-casa',
	            ),
	        )
	    );

	  return $meta_boxes;
}

// Registro do Custom Post Garotas
add_action( 'init', 'custom_post_type_garotas', 0 );
function custom_post_type_garotas() {

	$labels = array(
		'name'                  => 'Garotas',
		'singular_name'         => 'Garota',
		'menu_name'             => 'Garotas',
		'all_items'             => 'Todas as garotas',
		'add_new_item'          => 'Adicionar nova garota',
		'add_new'               => 'Adicionar nova garota',
		'new_item'              => 'Nova garota',
		'edit_item'             => 'Editar garota',
		'update_item'           => 'Alterar garota',
		'view_item'             => 'Ver garota',
		'view_items'            => 'Ver garotas',
		'search_items'          => 'Procurar garota',
		'not_found'             => 'Garota não encontrada',
		'featured_image'        => 'Adicionar imagem da garota',
		'set_featured_image'    => 'Adicionar imagem da garota',
		'remove_featured_image' => 'Remover imagem da garota',
		'items_list'            => 'Listar Garotas',
	);
	$args = array(
		'label'                 => 'Garota',
		'description'           => 'Pos Type de Garotas',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields',),
		'public'                => true,
		'menu_position'         => 5,
		'capability_type'       => 'page',
		'menu_icon'   => 'dashicons-id',
	);
	register_post_type( 'garotas', $args );

}

add_filter( 'rwmb_meta_boxes', 'garotas_register_meta_boxes' );
function garotas_register_meta_boxes( $meta_boxes ) {
    $prefix = 'gt_';

    $meta_boxes[] = array(
        'id'         => 'fields_garotas',
        'title'      => __( 'Informações da Garota', 'garota' ),
        'post_types' => 'garotas',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => __( 'Tipo: ', 'garota' ),
                'id'    => $prefix . 'tipo',
                'type'  => 'text',
                'class' => 'preco-casa',
            ),
            array(
                'name'  => __( 'Idade: ', 'garota' ),
                'id'    => $prefix . 'idade',
                'type'  => 'number',
                'size'  => 5,
                'class' => 'preco-casa',
            ),
            array(
                'name'  => __( 'Altura: ', 'garota' ),
                'id'    => $prefix . 'altura',
                'type'  => 'text',
                'size'  => 5,
                'class' => 'preco-casa',
            ),
            array(
                'name'  => __( 'Peso: ', 'garota' ),
                'id'    => $prefix . 'peso',
                'type'  => 'text',
                'size'  => 5,
                'class' => 'preco-casa',
            ),
            array(
                'name'  => __( 'Manequim: ', 'garota' ),
                'id'    => $prefix . 'manequim',
                'type'  => 'number',
                'size'  => 5,
                'class' => 'preco-casa',
            ),
            array(
                'name'  => __( 'Pés: ', 'garota' ),
                'id'    => $prefix . 'pes',
                'type'  => 'number',
                'size'  => 5,
                'class' => 'preco-casa',
            ),
            array(
                'name'  => __( 'Cabelos: ', 'garota' ),
                'id'    => $prefix . 'cabelos',
                'type'  => 'text',
                'class' => 'preco-casa',
            ),
            array(
                'name'  => __( 'Olhos: ', 'garota' ),
                'id'    => $prefix . 'olhos',
                'type'  => 'text',
                'class' => 'preco-casa',
            ),
            array(
                'name'  => __( 'Perfil: ', 'garota' ),
                'id'    => $prefix . 'perfil',
                'type'  => 'text',
                'class' => 'preco-casa',
            ),
            array(
                'name'  => __( 'Curiosidade: ', 'garota' ),
                'id'    => $prefix . 'curiosidade',
                'type'  => 'textarea',
                'class' => 'preco-casa',
            ),
        )
    );

	return $meta_boxes;
}