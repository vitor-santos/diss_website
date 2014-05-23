<div class="container">
	<div class="jumbotron">
		<h1>Contactar</h1>
		
		<?php echo validation_errors(); ?>

		<?php echo form_open('main/contactUs'); ?>
		
		<h5>Nome</h5>
		<input type="text" name="nome" class="form-control" value="<?php echo set_value('nome'); ?>" size="150" />
				
		<h5>E-mail de Contacto</h5>
		<input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" size="150" />
				
		<h5>Assunto</h5>
		<input type="subject" name="subject" class="form-control" value="<?php echo set_value('subject'); ?>" size="150" />
			
		<h5>Mensagem</h5>
		<textarea name="message" class="form-control" rows="5" cols="150"><?php echo set_value('message'); ?></textarea>
		
		</br>
		
		<div><input type="submit" class="btn btn-primary" id="submit" value="Enviar"/></div>
		
		</form>
	</div>
</div>
