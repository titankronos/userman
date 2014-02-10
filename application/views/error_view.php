<div class="span9">
	<div class="hero-unit">
		<h1>Oh No!</h1>
		<p>
			<?php if($this->session->flashdata('message')) : ?>
				<div class="alert">
					<a class="close" data-dismiss="alert">×</a>
					<?=$this->session->flashdata('message')?>
				</div>
      <?php endif; ?>
			There has been an error. If this is not the first time you have seen this message,
			 please report it. 
		</p>
	</div>
</div><!--/span-->
</div><!--/row-->
