<div class="container">

	<div class="jumbotron">
		<h3>O Voucher foi validado com sucesso!</h3>
		
		<h4>Promoção</h4>
		<h5><?php echo $voucherinfo['desc_resumida'];?></h5>
		<h4>Email Utilizador</h4>
		<h5><?php echo $voucherinfo['email'];?></h5>
		
		<p><?php echo anchor('user/showPersonalArea', 'Voltar à página pessoal'); ?></p>
	</div>
	
</div><!-- /.container -->