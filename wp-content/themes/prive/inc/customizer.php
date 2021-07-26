<?php
/**
 * Astrid Theme Customizer.
 *
 * @package Astrid
 */

function astrid_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_section( 'header_image' )->panel         = 'astrid_header_panel';
    $wp_customize->get_section( 'title_tagline' )->priority     = '9';
    $wp_customize->get_section( 'title_tagline' )->title        = __('Geral', 'astrid');
    $wp_customize->remove_control( 'header_textcolor' );


    //Titles
    class Astrid_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top:30px;border-bottom:1px solid;padding:5px;color:#111;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
    //___Header area___//
    $wp_customize->add_panel( 'astrid_header_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Cabeçalho', 'astrid'),
    ) );
    //___Header type___//
    $wp_customize->add_section(
        'astrid_header_type',
        array(
            'title'         => __('Tipo do Cabeçalho', 'astrid'),
            'priority'      => 10,
            'panel'         => 'astrid_header_panel', 
            'description'   => __('Selecione o tipo do cabeçalho', 'astrid'),
        )
    );
    //Front page
    $wp_customize->add_setting(
        'front_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'astrid_sanitize_header',
        )
    );
    $wp_customize->add_control(
        'front_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Tipo do cabeçalho da home', 'astrid'),
            'section'     => 'astrid_header_type',
            'description' => __('Selecione o tipo de cabeçalho da página inicial', 'astrid'),
            'choices' => array(
                'image'     => __('Imagem', 'astrid'),
                'nothing'   => __('Somente menu', 'astrid')
            ),
        )
    );
    //Site
    $wp_customize->add_setting(
        'site_header_type',
        array(
            'default'           => 'nothing',
            'sanitize_callback' => 'astrid_sanitize_header',
        )
    );
    $wp_customize->add_control(
        'site_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Tipo de cabeçalho do site', 'astrid'),
            'section'     => 'astrid_header_type',
            'description' => __('Selecione o tipo de cabeçalho para todas as páginas, exceto a pagina inicial', 'astrid'),
            'choices' => array(
                'image'     => __('Imagem', 'astrid'),
                'nothing'   => __('Somente Menu', 'astrid')
            ),
        )
    );

    //___Header text___//
    $wp_customize->add_section(
        'astrid_header_text',
        array(
            'title'         => __('Texto do cabeçalho', 'astrid'),
            'priority'      => 14,
            'panel'         => 'astrid_header_panel', 
        )
    );    
    $wp_customize->add_setting(
        'header_text',
        array(
            'default' => '',
            'sanitize_callback' => 'astrid_sanitize_text',
            'transport'     => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'header_text',
        array(
            'label' => __( 'Texto do cabeçalho', 'astrid' ),
            'section' => 'astrid_header_text',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'header_subtext',
        array(
            'default' => '',
            'sanitize_callback' => 'astrid_sanitize_text',
            'transport'     => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'header_subtext',
        array(
            'label' => __( 'Texto pequeno do cabeçalho', 'astrid' ),
            'section' => 'astrid_header_text',
            'type' => 'text',
            'priority' => 10
        )
    );    
    $wp_customize->add_setting(
        'header_button',
        array(
            'default' => '',
            'sanitize_callback' => 'astrid_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'header_button',
        array(
            'label' => __( 'Texto do botão', 'astrid' ),
            'section' => 'astrid_header_text',
            'type' => 'text',
            'priority' => 10
        )
    );
    $wp_customize->add_setting(
        'header_button_url',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'header_button_url',
        array(
            'label' => __( 'Link do botão', 'astrid' ),
            'section' => 'astrid_header_text',
            'type' => 'text',
            'priority' => 11
        )
    );

    //___Mobile header image___//
    $wp_customize->add_setting(
        'mobile_header',
        array(
            'default' => get_template_directory_uri() . '/images/header-mobile.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'mobile_header',
            array(
               'label'          => __( 'Imagem do cabeçalho das telas pequenas', 'astrid' ),
               'type'           => 'image',
               'section'        => 'header_image',
               'settings'       => 'mobile_header',
               'description'    => __( 'Adicionar uma imagem de cabeçalho para largura de tela menor que 1024px', 'astrid' ),
               'priority'       => 10,
            )
        )
    );

    //___Menu style___//
    $wp_customize->add_section(
        'astrid_menu_style',
        array(
            'title'         => __('Estilo do menu', 'astrid'),
            'priority'      => 15,
            'panel'         => 'astrid_header_panel', 
        )
    );
    //Sticky menu
    $wp_customize->add_setting(
        'sticky_menu',
        array(
            'default'           => 'sticky',
            'sanitize_callback' => 'astrid_sanitize_sticky',
        )
    );
    $wp_customize->add_control(
        'sticky_menu',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Menu fixo', 'astrid'),
            'section' => 'astrid_menu_style',
            'choices' => array(
                'sticky'   => __('Fixo', 'astrid'),
                'static'   => __('Estático', 'astrid'),
            ),
        )
    );
    //Menu style
    $wp_customize->add_setting(
        'menu_style',
        array(
            'default'           => 'inline',
            'sanitize_callback' => 'astrid_sanitize_menu_style',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'menu_style',
        array(
            'type'      => 'radio',
            'priority'  => 11,
            'label'     => __('Estilo do menu', 'astrid'),
            'section'   => 'astrid_menu_style',
            'choices'   => array(
                'inline'     => __('Alinhado', 'astrid'),
                'centered'   => __('Centralizado', 'astrid'),
            ),
        )
    );

    //___Fonts___//
    $wp_customize->add_section(
        'astrid_fonts',
        array(
            'title' => __('Fontes', 'astrid'),
            'priority' => 15,
            'description' => __('Você pode usar qualquer fonte do Google que você deseja para o cabeçalho e / ou corpo. Veja as fontes aqui: google.com/fonts.', 'astrid'),
        )
    );

    //Body fonts
    $wp_customize->add_setting(
        'body_font_name',
        array(
            'default' => '//fonts.googleapis.com/css?family=Open+Sans:300,300italic,600,600italic',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'body_font_name',
        array(
            'label' => __( 'Fonte do corpo nome/estilo/conjuntos', 'astrid' ),
            'section' => 'astrid_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );

    //Body fonts family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'sanitize_callback' => 'astrid_sanitize_text',
            'default' => 'font-family: \'Open Sans\', sans-serif;',
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Familia de fontes do corpo', 'astrid' ),
            'section' => 'astrid_fonts',
            'type' => 'text',
            'priority' => 12
        )
    );   
    //Headings fonts
    $wp_customize->add_setting(
        'headings_font_name',
        array(
            'default' => '//fonts.googleapis.com/css?family=Josefin+Sans:300italic,300',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'headings_font_name',
        array(
            'label' => __( 'Fonte do cabeçalho nome/estilo/conjuntos', 'astrid' ),
            'section' => 'astrid_fonts',
            'type' => 'text',
            'priority' => 14
        )
    );
    //Headings fonts family
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'sanitize_callback' => 'astrid_sanitize_text',            
            'default' => 'font-family: \'Josefin Sans\', sans-serif;',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'label' => __( 'Familia de fontes do cabeçalho', 'astrid' ),
            'section' => 'astrid_fonts',
            'type' => 'text',
            'priority' => 15
        )
    );

    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'astrid_fonts',
        'label'       => __('Titulo do site', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 80,
            'step'  => 1,
        ),
    ) ); 
    // Site description
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'astrid_fonts',
        'label'       => __('Descrição do site', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );         
    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'astrid_fonts',
        'label'       => __('Tamanho da fonte H1', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'astrid_fonts',
        'label'       => __('Tamanho da fonte H2', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );

    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '24',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'astrid_fonts',
        'label'       => __('Tamanho da fonte H3', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 20,
        'section'     => 'astrid_fonts',
        'label'       => __('Tamanho da fonte H4', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 21,
        'section'     => 'astrid_fonts',
        'label'       => __('Tamanho da fonte H5', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '12',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'astrid_fonts',
        'label'       => __('Tamanho da fonte H6', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //Body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
            'transport'         => 'postMessage'
        )       
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'astrid_fonts',
        'label'       => __('Tamanho da fonte do corpo', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
        ),
    ) );


    //___Blog options___//
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Opções do site', 'astrid'),
            'priority' => 13,
        )
    );  
    // Blog layout  
    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default'           => 'list',
            'sanitize_callback' => 'astrid_sanitize_blog',
        )
    );
    $wp_customize->add_control(
        'blog_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Layout do site', 'astrid'),
            'section'   => 'blog_options',
            'priority'  => 11,
            'choices'   => array(
                'list'           	=> __( 'Lista', 'astrid' ),
                'fullwidth'         => __( 'Largura total (sem barra lateral)', 'astrid' ),
                'masonry-layout'    => __( 'Masonry (estilo de grade)', 'astrid' )
            ),
        )
    ); 
    //Full width singles
    $wp_customize->add_setting(
        'fullwidth_single',
        array(
            'sanitize_callback' => 'astrid_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'fullwidth_single',
        array(
            'type'      => 'checkbox',
            'label'     => __('Postes únicos de largura total?', 'astrid'),
            'section'   => 'blog_options',
            'priority'  => 12,
        )
    );
    //Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '40',
        )       
    );
    $wp_customize->add_control( 'exc_length', array(
        'type'        => 'number',
        'priority'    => 13,
        'section'     => 'blog_options',
        'label'       => __('Comprimento do resumo', 'astrid'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
        ),
    ) );
    //Meta
    $wp_customize->add_setting(
      'hide_meta',
      array(
        'sanitize_callback' => 'astrid_sanitize_checkbox',
        'default' => 0,     
      )   
    );
    $wp_customize->add_control(
      'hide_meta',
      array(
        'type' => 'checkbox',
        'label' => __('Ocultar postagem meta?', 'astrid'),
        'section' => 'blog_options',
        'priority' => 14,
      )
    ); 
    //Index images
    $wp_customize->add_setting(
        'featured_image',
        array(
            'sanitize_callback' => 'astrid_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'featured_image',
        array(
            'type' => 'checkbox',
            'label' => __('Ocultar imagens em destaque?', 'astrid'),
            'section' => 'blog_options',
            'priority' => 22,
        )
    );

    //___Footer___//
    $wp_customize->add_section(
        'astrid_footer',
        array(
            'title'         => __('Rodapé', 'astrid'),
            'priority'      => 18,
        )
    );
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '3',
            'sanitize_callback' => 'astrid_sanitize_fwidgets',
        )
    );
    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Area de widget do rodape', 'astrid'),
            'section'     => 'astrid_footer',
            'description' => __('Escolha o número de áreas de widget no rodapé, vá para Aparência> Widgets e adicione seus widgets.', 'astrid'),
            'choices' => array(
                '1'     => __('Uma', 'astrid'),
                '2'     => __('Duas', 'astrid'),
                '3'     => __('Três', 'astrid'),
            ),
        )
    );
    //Logo Upload
    $wp_customize->add_setting(
        'footer_logo',
        array(
            'default-image' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'footer_logo',
            array(
               'label'          => __( 'Carregar o logotipo do rodapé', 'astrid' ),
               'type'           => 'image',
               'section'        => 'astrid_footer',
               'priority'       => 11,
            )
        )
    );
    
    //___Colors___//   
    //Primary color
    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#fcd088',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Cor primaria', 'astrid'),
                'section'       => 'colors',
                'priority'      => 12
            )
        )
    );
    //Site title
    $wp_customize->add_setting(
        'site_title',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title',
            array(
                'label'         => __('Titulo do Site', 'astrid'),
                'section'       => 'colors',
                'priority'      => 13
            )
        )
    );
    //Site desc
    $wp_customize->add_setting(
        'site_description',
        array(
            'default'           => '#BDBDBD',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_description',
            array(
                'label'         => __('Descrição do site', 'astrid'),
                'section'       => 'colors',
                'priority'      => 13
            )
        )
    );    
    //Menu
    $wp_customize->add_setting(
        'menu_bg',
        array(
            'default'           => '#202529',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_bg',
            array(
                'label'         => __('Fundo do menu', 'astrid'),
                'section'       => 'colors',
                'priority'      => 13
            )
        )
    );
    //Body
    $wp_customize->add_setting(
        'body_text_color',
        array(
            'default'           => '#656D6D',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label' => __('Texto do corpo', 'astrid'),
                'section' => 'colors',
                'settings' => 'body_text_color',
                'priority' => 14
            )
        )
    );
    //Footer
    $wp_customize->add_setting(
        'footer_bg',
        array(
            'default'           => '#202529',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_bg',
            array(
                'label' => __('Fundo do rodapé', 'astrid'),
                'section' => 'colors',
                'priority' => 15
            )
        )
    );

}
add_action( 'customize_register', 'astrid_customize_register' );


/**
 * Sanitize
 */
//Header type
function astrid_sanitize_header( $input ) {
    if ( in_array( $input, array( 'image', 'shortcode', 'nothing' ), true ) ) {
        return $input;
    }
}
//Text
function astrid_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
//Checkboxes
function astrid_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
//Menu style
function astrid_sanitize_menu_style( $input ) {
    if ( in_array( $input, array( 'inline', 'centered' ), true ) ) {
        return $input;
    }
}
//Menu style
function astrid_sanitize_sticky( $input ) {
    if ( in_array( $input, array( 'sticky', 'static' ), true ) ) {
        return $input;
    }
}
//Footer widget areas
function astrid_sanitize_fwidgets( $input ) {
    if ( in_array( $input, array( '1', '2', '3' ), true ) ) {
        return $input;
    }
}
//Blog layout
function astrid_sanitize_blog( $input ) {
    if ( in_array( $input, array( 'list', 'fullwidth', 'masonry-layout' ), true ) ) {
        return $input;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function astrid_customize_preview_js() {
	wp_enqueue_script( 'astrid_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'astrid_customize_preview_js' );
