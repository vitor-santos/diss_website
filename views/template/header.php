<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mobipag - Parcerias</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('/assets/css/bootstrap.css')?>" rel="stylesheet">
	<link href="<?=base_url('/assets/css/main.css')?>" rel="stylesheet">
	</head>

  <body>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url(''); ?>">MOBIPAG</a>
        </div>
        <div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo site_url('main/conditions'); ?>">Condições</a></li>
				<li><a href="<?php echo site_url('main/advantages'); ?>">Vantagens</a></li>
				<li><a href="<?php echo site_url('main/contactUs'); ?>">Contacte-nos</a></li>				
			</ul>
			<ul class="nav navbar-nav navbar-right">
                  <?php if ($this->session->userdata('logged_in')): ?>				  
						<li><a href="" class="dropdown-toggle" data-toggle="dropdown">Bem Vindo, Utilizador <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo site_url('user/showPersonalArea'); ?>"><i class="icon-envelope"></i>Área Pessoal</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo site_url('user/logout'); ?>"><i class="icon-off"></i>Terminar Sessão</a></li>
							</ul>
						</li>  
				  <?php else: ?>	
					  <li><a href="<?php echo site_url('user/register'); ?>">Registar</a></li>
					  <li class="dropdown">
						 <a href="" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
						 <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
							<li>
							   <div class="row">
								  <div class="col-md-12">
									 <form class="form" role="form" method="post" action="<?php echo site_url('user/login'); ?>" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
										   <label class="sr-only" for="loginemail">Email address</label>
										   <input type="email" class="form-control" name="loginemail" id="loginemail" placeholder="Email address" required>
										</div>
										<div class="form-group">
										   <label class="sr-only" for="loginpass">Password</label>
										   <input type="password" class="form-control" name="loginpass" id="loginpass" placeholder="Password" required>
										</div>
										<div class="form-group">
										   <button type="submit" class="btn btn-success btn-block">Sign in</button>
										</div>
									 </form>
								  </div>
							   </div>
							</li>
						</ul>
					  </li>
				 <?php endif; ?>
               </ul>		
         </div><!--/.nav-collapse -->
      </div>
    </div>

