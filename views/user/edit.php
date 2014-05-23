<div class="container">

	<div class="jumbotron">
		<h1>Editar Perfil</h1>
		
		<?php echo validation_errors(); ?>

		<?php echo form_open('user/editProfile/'.$userinfo['id_entidade']); ?>
		
		</br>
		<h5 class="text-danger">Todos os campos são obrigatórios</h5>
				
		<h5>Descrição</h5>
		<textarea name="desc" class="form-control" rows="4" cols="50"><?php echo set_value('desc',$userinfo['descricao']); ?></textarea>
		<span class="help-block">Neste campo deverá inserir uma breve descrição (até 400 caracteres) do negócio.</span>
		
		<h5>Contacto</h5>
		<input type="text" name="cont" class="form-control" value="<?php echo set_value('cont',$userinfo['contacto']); ?>" size="9" />		
		
		<h5>Endereço E-mail</h5>
		<input type="text" name="email" class="form-control" value="<?php echo set_value('email',$userinfo['email']); ?>" size="50" />
		
		<h5>Morada</h5>
		<input type="text" id="address" name="address" class="form-control" onblur="codeAddress()" value="<?php echo set_value('address',$userinfo['morada']); ?>" size="50" />
		<span class="help-block">Neste campo deverá inserir a morada do estabelecimento. É apenas necessário o nome da rua, número da porta e localidade.</span>
		<span class="text-danger" id="mapsreturn"></span>
				
		<h5>Palavra Passe</h5>
		<input type="password" name="password" class="form-control" value="" size="50" />
		<span class="help-block">A palavra passe deverá possuir pelo menos 6 caracteres.</span>

		<h5>Confirme a Palavra Passe</h5>
		<input type="password" name="passconf" class="form-control" value="" size="50" />
		
		<input type="hidden" id="latitude" name="latitude" />
		<input type="hidden" id="longitude" name="longitude" />
		
		<div id="map-placeholder">
			<div id="map-canvas">
			</div>
			<span class="help-block">Confirme a localização do seu negócio.</span>
		</div>
		
		<div><input type="submit" class="btn btn-primary" id="submit" value="Confirmar"/></div>

		</form>    
	</div>
	
</div><!-- /.container -->