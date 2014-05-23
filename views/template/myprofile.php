<div class="container">
	<div class="jumbotron">
		<h2>O Meu Perfil</h2>
		<hr>
		</br>
		<table class="table table-striped table-hover">
			<tr>
				<th>Nome</th>
				<td><?php echo $userinfo['nome'];?></td>
			</tr>
			<tr>
				<th>Descrição</th>
				<td><?php echo $userinfo['descricao'];?></td>
			</tr>
			<tr>
				<th>Morada</th>
				<td><?php echo $userinfo['morada'];?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $userinfo['email'];?></td>
			</tr>
			<tr>
				<th>Nome do Responsável</th>
				<td><?php echo $userinfo['nome_prop'];?></td>
			</tr>
			<tr>
				<th>NIF</th>
				<td><?php echo $userinfo['nif'];?></td>
			</tr>
			<tr>
				<th>Créditos Disponíveis</th>
				<td><?php echo $userinfo['creditos'];?></td>
			</tr>
		</table>
		
		<a href="<?php echo site_url('user/editProfile/'.$userinfo['id_entidade']); ?>" class="btn btn-default">Editar Perfil</a>
		<a href="<?php echo site_url('user/getCredits/'.$userinfo['id_entidade']); ?>" class="btn btn-default">Adquirir Créditos</a>
	</div>
</div>