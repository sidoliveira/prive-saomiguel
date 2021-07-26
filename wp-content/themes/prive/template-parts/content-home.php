<h1 class="title-page"><?php echo rwmb_meta('rw_title'); ?></h1>
<?php
	while ( have_posts() ) : the_post(); ?>
        <div class="container content-pages">
          <p class="texto-corpo"><?php echo the_content(); ?></p>
          <?php 
          	$images = rwmb_meta('rw_image','type=image&limit=1&size=large'); 
          	$image = $images[0];
          ?>
          <a href="<?php echo $image['url'] ?>" rel="lightbox"><div class="img-destaque"><img class="img-responsive" src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" title="<?php echo $image['title'] ?>"></div></a>
          <div class="precos">
          	<p class="title-preco">PREÇOS</p>
              <p class="desc-precos">
              <?php 
                  $precos = rwmb_meta('rw_preco');
                  if ( !empty( $precos ) ) {
                      foreach ( $precos as $preco ) {
                        $resul = $resul.$preco[0]. " - R$". $preco[1]. "&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;";
                      }

                      $resul = substr($resul, 0, -49);
                      echo $resul;
                  }
              ?>
              </p>
          </div>
          <a href="<?php echo get_permalink( get_page_by_path( 'a-casa' ) ) ?>">
          	<div class="card botao-area">
					    <div class="card-block">CONHEÇA A CASA</div>
						</div>
          </a> 
          <div class="row"></div>
    <?php
	endwhile;
?>