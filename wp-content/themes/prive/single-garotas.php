<?php get_header(); ?>

<div id="primary">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="row"></div>
				<div><?php echo the_content(); ?></div>
		    <div class="container-fluid garota-single">
		    	<div class="col-md-12 todo-card">
						<div class="card card-style">
							<div class="card-block card-garota">
								<div class="row">
									<div class="col-md-12">
										<p class="nome-desc-garota"><?php echo the_title(); ?></p>
									</div>
								</div>
								<div class="label-garota">
									<div class="col-xs-4">
										<p>TIPO</p>
									</div>
									<div class="col-xs-4">
										<p>IDADE</p>
									</div>
									<div class="col-xs-4">
										<p>ALTURA</p>
									</div>
								</div>
								<div class="desc-garota">
									<div class="col-xs-4">
										<p><?php echo rwmb_meta('gt_tipo'); ?></p>
									</div>
									<div class="col-xs-4">
										<p><?php echo rwmb_meta('gt_idade'); ?></p>
									</div>
									<div class="col-xs-4">
										<p><?php echo rwmb_meta('gt_altura'); ?></p>
									</div>
								</div>
								<div class="label-garota">
									<div class="col-xs-4">
										<p>PESO</p>
									</div>
									<div class="col-xs-4">
										<p>MANEQUIM</p>
									</div>
									<div class="col-xs-4">
										<p>PÉS</p>
									</div>
								</div>
								<div class="desc-garota">
									<div class="col-xs-4">
										<p><?php echo rwmb_meta('gt_peso'); ?></p>
									</div>
									<div class="col-xs-4">
										<p><?php echo rwmb_meta('gt_manequim'); ?></p>
									</div>
									<div class="col-xs-4">
										<p><?php echo rwmb_meta('gt_pes'); ?></p>
									</div>
								</div>
								<div class="label-garota">
									<div class="col-xs-4">
										<p>CABELOS</p>
									</div>
									<div class="col-xs-4">
										<p>OLHOS</p>
									</div>
									<div class="col-xs-4">
										<p>PERFIL</p>
									</div>
								</div>
								<div class="desc-garota">
									<div class="col-xs-4">
										<p><?php echo rwmb_meta('gt_cabelos'); ?></p>
									</div>
									<div class="col-xs-4">
										<p><?php echo rwmb_meta('gt_olhos'); ?></p>
									</div>
									<div class="col-xs-4">
										<p><?php echo rwmb_meta('gt_perfil'); ?></p>
									</div>
								</div>
								<div class="label-garota">
									<div class="row"></div>
									<div class="col-md-12">
										<p>CURIOSIDADE</p>
									</div>
								</div>
								<div class="desc-garota">
									<div class="col-md-12 curiosidade">
										<p><?php echo rwmb_meta('gt_curiosidade'); ?></p>
									</div>
								</div>
							</div>
						<div class="row"></div>
						</div>
					</div>
		    </div>
		  <?php endwhile; ?>
		  	<h1 class="title-page">OUTRAS GAROTAS</h1>
		  	<?php
					$args = array(
						'post_type' => 'garotas',
						'posts_per_page'	=> 3,
						'post__not_in' => array($post->ID),
						'orderby'   => 'rand',
					);
				?>

				<?php $loop = new WP_Query( $args );

				if($loop -> have_posts() ) { ?>
					<section class="container outras-garotas">
					 	<?php while($loop -> have_posts() ) {
							$loop-> the_post(); ?>
								<div class="col-md-4">
									<div class="card card-style">
										<div class="card-block card-garota relacionada">
											<div class="col-md-12">
												<div class="img-responsive"><?php echo the_post_thumbnail(); ?></div>
											</div>
											<div class="col-md-12">
												<p class="nome-garota"><?php echo the_title(); ?></p>
												<div class="texto-garota"><?php echo the_excerpt(); ?></div>
												<div class="row acessar"><a href="<?php the_permalink(); ?>"><span class="acessa-garota card">ACESSAR</span></a></div>
											</div>
										</div>
										<div class="row"></div>
									</div>
								</div>
						<?php } ?>
					</section>
				<?php } ?>
		</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();