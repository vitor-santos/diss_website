<div class="container">
	<div class="jumbotron">
		<h1>Validar Voucher</h1>
		<?php echo validation_errors(); ?>

		<?php echo form_open('promo/validateVoucher'); ?>
		
		<h5>Código</h5>
		<input type="text" name="code" class="form-control" value="" size="50" />
		<span class="help-block">Neste campo deverá inserir o código a validar.</span>
		
		<div>
			<a href="<?php echo site_url('user/showPersonalArea/'); ?>" class="btn btn-default">Retroceder</a>
			<input type="submit" class="btn btn-primary" id="submit" value="Validar"/>
		</div>
		
		</form>
	</div>
</div>