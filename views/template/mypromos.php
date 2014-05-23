<div class="container">
	<div class="jumbotron">
	
	<h2>Promoções</h2>
		<div class="promo-buttons">
			<a href="<?php echo site_url('promo/validateVoucher/'); ?>" class="btn btn-primary" style="margin-right:5px;">Validar Voucher</a>
			<a href="<?php echo site_url('promo/insertPromo/'); ?>" class="btn btn-default" style="margin-right:5px;">Inserir Promoção</a>
			<a href="<?php echo site_url('promo/checkHistory/'); ?>" class="btn btn-default" style="margin-right:5px;">Consultar Histórico</a>
		</div>
		</br>
		<?php if(count($promos)>0): ?>
		<?php foreach($promos as $p){ ?>		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Promoção - Resumo</h3>
			</div>
			<div class="panel-body">	
				<div>
					<table class="table table-striped" style=" margin-bottom: 0px; margin-top: 20px;">
						<tr>
							<th>Descrição Resumida</th>
							<td><?php echo $p['desc_resumida'];?></td>						
						</tr>
						<tr>
							<th>Data Lançamento</th>
							<td><?php echo $p['inicio_promo'];?></td>						
						</tr>
						<tr>
							<th>Data Limite</th>
							<td><?php echo $p['fim_promo'];?></td>						
						</tr>
						<tr>
							<th>Categoria</th>
							<td><?php echo $p['categoria'];?></td>
						</tr>
						<tr>
							<th>Preço por Voucher</th>
							<td><?php echo $p['valor_voucher'];?></td>
						</tr>
						<tr>
							<th>Destacada</th>
							<td><?php if($p['destaque']=='0') $result='Não'; else $result='Sim'; echo $result; ?></td>
						</tr>
					</table>
				</div>
				</br>
				<a href="<?php echo site_url('promo/seeMoreInfo/'.$p['id_promo']); ?>" class="btn btn-default">Ver Mais Informação</a>
				<a href="<?php echo site_url('promo/editPromo/'.$p['id_promo']); ?>" class="btn btn-default">Editar Promoção</a>
				<a href="<?php echo site_url('promo/deletePromo/'.$p['id_promo']); ?>" class="btn btn-default">Eliminar Promoção</a>				
			</div>
		</div>
		</br>
		<?php } ?>
		<?php else: ?>
			<h4>Não possui qualquer promoção criada.</h4>
		<?php endif; ?>
	</div>
</div>