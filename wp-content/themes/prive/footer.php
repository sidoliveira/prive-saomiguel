	<div class="footer-wrapper">
		<footer class="site-footer">	
			<div class="site-info container-fluid">
				<div class="col-md-3 col-sm-12 primary-col">
					<?php
		        $args = array(
				    	'post_type'=>'page',
				    	'pagename'=>'contato'
						);
						 
						$my_query = new WP_Query( $args );
						 
						if ( $my_query->have_posts() ) {
						 
					    while ( $my_query->have_posts() ) {
					 
					      $my_query->the_post();?>
							
							<p class="title-rodape">Horário</p>
					<p>
						<?php echo rwmb_meta('rw_horario-func'); ?><br>
						<?php echo rwmb_meta('rw_horario-func-dom'); ?>
					</p>
				</div>
				<div class="col-md-6 col-sm-12 primary-col">
					<p class="title-rodape">
						Venha Conhecer
					</p>
					<p class="description-rodape">
						<?php echo rwmb_meta('rw_endereco'); ?><br>
						<i class="fa fa-phone" aria-hidden="true"></i>
						<span> <?php echo rwmb_meta('rw_telefone'); ?></span>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<i class="fa fa-whatsapp" aria-hidden="true"></i>
						<span> <?php echo rwmb_meta('rw_whatsapp'); ?></span>
					</p>
				</div>

					    <?php
					    }
						}
					?>
				<div class="col-md-3 col-sm-12 primary-col">
					<p class="title-rodape">
						Formas de Pagamento
					</p>
					<img src="<?php echo get_template_directory_uri(). '/images/logos-cartoes.png'?>">
				</div>
			</div>
			<hr>
			<div class="site-info container-fluid">
				<div class="col-md-8 col-sm-12">
					<p>Prive 16 - São Miguel Paulista - Todos os direitos reservados ©  </p>
				</div>
				<div class="col-md-4 col-sm-12">
					<p>Desenvolvido por - <a href="https://www.facebook.com/sidneysimpsons" target="_blank">Sidney Oliveira</a></p>
				</div>
			</div>
		</footer>
	</div>

</div><!-- #page -->
<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us19.list-manage.com","uuid":"2aab1dcfce4cc902b7142de80","lid":"b1cfdb2143","uniqueMethods":true}) })</script>

<?php wp_footer(); ?>

</body>
</html>
