<div class="container">
	<div class="jumbotron">
	
	<h2>Notificações</h2>
		<?php if(count($tempusers)>0): ?>
		<?php foreach($tempusers as $user){ ?>		
			<div>
				<table class="table table-striped" style=" margin-bottom: 0px; margin-top: 20px;">
					<tr>
						<th>Nome</th>
						<td><?php echo $user['nome'];?></td>						
					</tr>
					<tr>
						<th>Nome Responsável</th>
						<td><?php echo $user['nome_prop'];?></td>						
					</tr>
					<tr>
						<th>Contacto</th>
						<td><?php echo $user['contacto'];?></td>						
					</tr>
					<tr>
						<th>Email</th>
						<td><?php echo $user['email'];?></td>
					</tr>
					<tr>
						<th>Morada</th>
						<td><?php echo $user['morada'];?></td>
					</tr>
					<tr>
						<th>Descrição</th>
						<td><?php echo $user['descricao'];?></td>
					</tr>
				</table>
				<a href="<?php echo site_url('user/approveRegistration/'.$user['id_entidade']); ?>" class="btn btn-default">Aprovar Registo</a>
				<a href="<?php echo site_url('user/rejectRegistration/'.$user['id_entidade']); ?>" class="btn btn-default">Rejeitar Registo</a>
				<a href="<?php echo site_url('user/contact/'.$user['id_entidade']); ?>" class="btn btn-default">Contactar</a>
			</div>	
			</br>
		<?php } ?>
		<?php else: ?>
			<h5>Não existem notificações neste momento.</h5>
		<?php endif; ?>
		<!--Poderão haver outros tipos de notificação. Com outros foreach etc -->
	</div>
</div>