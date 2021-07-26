<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astrid
 */

get_header(); ?>
	<div id="primary">
		<main id="main" class="site-main" role="main">
			<?php
				if( is_page('home') ) {
					get_template_part( 'template-parts/content', 'home' );
				}
				if( is_page('a-casa') ) {
					get_template_part( 'template-parts/content', 'a-casa' );
				}
				if( is_page('garotas') ) {
					get_template_part( 'template-parts/content', 'garotas' );
				}
				if( is_page('contato') ) {
					get_template_part( 'template-parts/content', 'contato' );
				}
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
