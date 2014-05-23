<div class="container">

	<div class="jumbotron">
		<h1>Editar Promoção</h1>
		
		<?php echo validation_errors(); ?>

		<?php echo form_open('promo/editPromo/'.$promoinfo['id_promo']); ?>
		
		</br>
		<h5 class="text-danger">Todos os campos são obrigatórios. Aconselha-se a revisão do formulário após a inserção dos campos, para evitar erros.</h5>
		
		<h5>Data Lançamento (dd/mm/aaaa)</h5>
		<input type="date" name="launch" class="form-control" value="<?php echo set_value('launch',$promoinfo['inicio_promo']); ?>"/>
		<span class="help-block">Neste campo deverá inserir a data a partir da qual a promoção estará ativa.</span>
		
		<h5>Data Limite (dd/mm/aaaa))</h5>
		<input type="date" name="limit" class="form-control" value="<?php echo set_value('limit',$promoinfo['fim_promo']); ?>"/>
		<span class="help-block">Neste campo deverá inserir a data de expiração da promoção.</span>
		
		<h5>Descrição (Resumida)</h5>
		<input type="text" name="desc" class="form-control" value="<?php echo set_value('desc',$promoinfo['desc_resumida']); ?>" size="150" />
		<span class="help-block">Neste campo deverá inserir uma descrição resumida (até 100 caracteres) da promoção.</span>
	
		<h5>Descrição (Completa)</h5>
		<textarea name="desc_comp" class="form-control" rows="5" cols="50"><?php echo set_value('desc_comp',$promoinfo['desc_completa']); ?></textarea>
		
		<h5>Requer Reserva Prévia</h5> <!--Radio Button here-->
		<div class="radio">
			<label>
				<input type="radio" id="yes" name="reservation" value="yes">
				Sim
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" id="no" name="reservation" value="no" checked="checked">
				Não
			</label>
		</div>
		
		<h5>Condições Especiais</h5>
		<textarea name="cond" class="form-control" rows="4" cols="50"><?php echo set_value('cond',$promoinfo['condicoes']); ?></textarea>
		<span class="help-block">Neste campo deverá inserir condições especiais da promoção (limites de idade, condições de acesso, etc.)</span>		
		
		<h5>Horário</h5>
		<input type="text" name="schedule" class="form-control" value="<?php echo set_value('schedule',$promoinfo['horario']); ?>" size="50" />
		
		<h5>Categoria</h5> <!--Select here-->
		<select name="category" class="form-control">
            <option value="default">-</option>
			<option value="Moda">Moda</option>
            <option value="Restauração">Restauração</option>
            <option value="Desporto">Desporto e Lazer</option>
            <option value="Artes">Artes e Espectáculos</option>
            <option value="Tecnologias">Tecnologias</option>
			<option value="Outros">Outros</option>
        </select>                 
        
		<h5>Número de Vouchers</h5>
		<input type="text" name="num" class="form-control" value="<?php echo set_value('num',$promoinfo['no_vouchers']); ?>" size="50" />
		
		<h5>Preço por Voucher</h5>
		<input type="text" name="price" class="form-control" value="<?php echo set_value('price',$promoinfo['valor_voucher']); ?>" size="50" />
		<span class="help-block">Neste campo deverá inserir o valor (em pontos) que cada voucher irá custar.</span>
		
		<h5>Poupança por Voucher</h5>
		<input type="text" name="discount" class="form-control" value="<?php echo set_value('discount',$promoinfo['poupanca']); ?>" size="50" />
		<span class="help-block">Neste campo deverá a poupança mínima que cada voucher traduz para o cliente.</span>
		
		<h5>Em conjunto com...</h5>
		<input type="text" name="dual" class="form-control" value="<?php echo set_value('dual',$promoinfo['parceria']); ?>" />
		<span class="help-block">Caso a promoção seja realizada em conjunto com outra entidade, insira aqui o nome da mesma. Caso contrário deixe o campo vazio.</span>
		
		<h5>Inclui Bilhete</h5> <!--Radio Button here-->
		<div class="radio">
			<label>
				<input type="radio" id="yes" name="ticket" value="yes">
				Sim
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" id="no" name="ticket" value="no" checked="checked">
				Não
			</label>
		</div>
		
		<h5>Zonas</h5> <!--Select Here-->		
        <select name="tickettype" class="form-control">
                <option value="default">-</option>
				<option value="z2">Z2</option>
                <option value="z3">Z3</option>
                <option value="z4">Z4</option>
                <option value="z5">Z5</option>
                <option value="z6">Z6</option>
		</select>                      
        
		</br>
		
		<div><input type="submit" class="btn btn-primary" id="submit" value="Confirmar"/></div>

		</form>    
	</div>
	
</div><!-- /.container -->