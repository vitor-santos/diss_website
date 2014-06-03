<div class="container">
	<div class="jumbotron">
	
	<h2>Promoções - Histórico</h2>
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
							<th>Número de Vouchers</th>
							<td><?php echo $p['no_vouchers'];?></td>
						</tr>
						<tr>
							<th>Vouchers Vendidos</th>
							<td><?php echo $p['sold_vouchers'];?></td>
						</tr>
					</table>
				</div>
				</br>
				<a href="<?php echo site_url('promo/seeMoreInfo/'.$p['id_promo']); ?>" class="btn btn-default">Ver Mais Informação</a>								
			</div>
		</div>
		</br>
		<?php } ?>
		<?php else: ?>
			<h4>Não possui qualquer promoção expirada.</h4>
		<?php endif; ?>
	</div>
</div>