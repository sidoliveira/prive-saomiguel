<?php
	while ( have_posts() ) : the_post(); ?>
		  <?php echo do_shortcode("[metaslider id=39]"); ?>
		  <h1 class="title-page"><?php echo rwmb_meta('rw_title'); ?></h1>
          <div class="container a-casa">
          	<div class="texto-corpo">
          		<?php echo the_content(); ?>
          	</div>
        		<div class="col-md-12">
          		<div class="card card-style">
			    			<div class="card-block card-preco">
			    				<div class="col-xs-5 preco"><span><?php echo rwmb_meta('rw_preco-casa1'); ?> - R$ <?php echo rwmb_meta('rw_horario-casa1'); ?></span></div>
			    				<div class="col-xs-2"><i class="material-icons">monetization_on</i></div>
			    				<div class="col-xs-5 preco"><span><?php echo rwmb_meta('rw_preco-casa2'); ?> - R$ <?php echo rwmb_meta('rw_horario-casa2'); ?></span></div>
			    			</div>
							</div>
          	</div>
          	<?php 
              $ambientes = rwmb_meta('rw_ambientes');
              if ( !empty( $ambientes ) ) {
                  foreach ( $ambientes as $ambiente ) { ?>
                  	<div class="col-md-4 col-sm-6">
				          		<div class="card card-style">
							    			<div class="card-block card-item">
							    				<i class="material-icons"><?php echo $ambiente[0]  ?></i>
							    				<p class="title"><?php echo $ambiente[1]  ?></p>
							    				<p class="content"><?php echo $ambiente[2]  ?></p>
							    			</div>
											</div>
				          	</div>
				      <?php
                  }
              }
            ?>
        	<div class="row"></div>
    <?php
	endwhile;
?>