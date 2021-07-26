<?php
while ( have_posts() ) : the_post(); ?>
<h1 class="title-page"><?php echo rwmb_meta('rw_title'); ?></h1>
<div class="container garotas">
	<div class="texto-corpo">
		<?php echo the_content(); ?>
	</div>
	<?php endwhile; ?>
	<?php
	$args = array(
		'post_type' => 'garotas',
	);

	$loop = new WP_Query( $args );

 	if($loop -> have_posts() ) { ?>
 		<?php while($loop -> have_posts() ) {
			$loop-> the_post(); ?>
			<div class="col-md-12">
				<div class="card card-style">
					<div class="card-block card-garota">
						<div class="col-md-6">
							<div class="img-responsive"><?php echo the_post_thumbnail(); ?></div>
						</div>
						<div class="col-md-6">
							<p class="nome-garota"><?php echo the_title(); ?></p>
							<div class="texto-garota"><?php echo the_excerpt(); ?></div>
							<a href="<?php the_permalink(); ?>"><span class="acessa-garota card">ACESSAR</span></a>
						</div>
					</div>
				<div class="row"></div>
				</div>
			</div>
		<?php }
	} ?>
</div>