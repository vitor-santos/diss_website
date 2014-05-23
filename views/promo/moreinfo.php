<div class="container">
	<div class="jumbotron">
		<h2>Promoção - Detalhes</h2>
		
				<div>
					<table class="table table-striped" style=" margin-bottom: 0px; margin-top: 20px;">
						<tr>
							<th>Descrição Resumida</th>
							<td><?php echo $promoinfo['desc_resumida'];?></td>						
						</tr>
						<tr>
							<th>Descrição Completa</th>
							<td><?php echo $promoinfo['desc_completa'];?></td>						
						</tr>
						<tr>
							<th>Data Lançamento</th>
							<td><?php echo $promoinfo['inicio_promo'];?></td>						
						</tr>
						<tr>
							<th>Data Limite</th>
							<td><?php echo $promoinfo['fim_promo'];?></td>						
						</tr>
						<tr>
							<th>Categoria</th>
							<td><?php echo $promoinfo['categoria'];?></td>
						</tr>
						<tr>
							<th>Reserva</th>
							<td><?php if($promoinfo['reserva']=='0') $result='Não'; else $result='Sim'; echo $result; ?></td>
						</tr>
						<tr>
							<th>Condições Especiais</th>
							<td><?php echo $promoinfo['condicoes'];?></td>						
						</tr>
						<tr>
							<th>Horário</th>
							<td><?php echo $promoinfo['horario'];?></td>						
						</tr>
						<tr>
							<th>Bilhete</th>
							<td><?php if($promoinfo['bilhete']=='0') $result='Não'; else $result='Sim'; echo $result; ?></td>
						</tr>
						<tr>
							<th>Tipo de Bilhete</th>
							<td><?php if($promoinfo['zonas']==NULL) $result='Não se Aplica'; else $result=$promoinfo['zonas']; echo $result; ?></td>
						</tr>
						<tr>
							<th>Preço por Voucher</th>
							<td><?php echo $promoinfo['valor_voucher'];?></td>
						</tr>
						<tr>
							<th>Número de Vouchers</th>
							<td><?php echo $promoinfo['no_vouchers'];?></td>
						</tr>
						<tr>
							<th>Poupança por Voucher</th>
							<td><?php echo $promoinfo['poupanca'];?></td>						
						</tr>
						<tr>
							<th>Em parceria com...</th>
							<td><?php if($promoinfo['parceria']==NULL) $result='Não se Aplica'; else $result=$promoinfo['parceria']; echo $result; ?></td>
						</tr>
						<tr>
							<th>Destacada</th>
							<td><?php if($promoinfo['destaque']=='0') $result='Não'; else $result='Sim'; echo $result; ?></td>
						</tr>
						<tr>
							<th>Final do Destaque</th>
							<td><?php if($promoinfo['fim_destaque']==NULL) $result='Não se Aplica'; else $result=$promoinfo['fim_destaque']; echo $result; ?></td>
						</tr>
					</table>
				</div>
				</br>
				<div class="modal fade" id="confirmationModal" aria-labelledby="basicModal" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Destacar Promoção</h4>
					  </div>
					  <div class="modal-body">
						<p>Tem a certeza que pretende destacar esta promoção durante uma semana? Esta operação tem o custo de 50 créditos.</p>
						<h5 class="text-danger">Nota: Caso a operação já esteja destacada, será adicionada uma semana à data limite.</h5>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<a href="<?php echo site_url('promo/promote/'.$promoinfo['id_promo']); ?>" class="btn btn-primary">Confirmar</a>						
					  </div>
					</div>
				  </div>
				</div>
				<div>
					<a href="<?php echo site_url('user/showPersonalArea/'); ?>" class="btn btn-default">Retroceder</a>
					<a data-toggle="modal" data-target="#confirmationModal" href="#" class="btn btn-default">Destacar Promoção</a>					
				</div>	
	</div>
</div>