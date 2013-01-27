<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="description" content="CurLink, great app to curl your links">
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url();?>web/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>web/css/main.css"/>
	<link rel="icon" href="<?php echo base_url();?>web/img/favicon.ico"/>
	<title>CurLink&nbsp;-&nbsp;<?php echo $titre; ?></title>
</head>
<body>
	<div id="mainPage">
		<header>
			<a id="title" href="<?php echo base_url(); ?>"><h1>CurLink!</h1><img alt="logo Curlink" src="<?php echo base_url();?>web/img/logo.png"></a>
			<div id="memberBox">
				<?php
				if($this->session):
				
				if($this->session->userdata('logged in')): ?><p id="nomMembre"><?php echo $this->session->userdata('nom'); ?></p>
				<?php echo anchor('membre/logout/','Se déconnecter','id="logout"'); 
				endif; 
				endif; ?>
			</div>
		</header>
		<?php if(isset($message)): ?>
		<div class="feedback"><?php echo $message; ?></div>
		<?php endif ; ?>
		 <div id="content">
		 	<div id="memberConnect">
					 <?php
						if($this->session):
							if(!$this->session->userdata('logged in')):
								echo anchor('membre/log/','Se connecter / ');
								echo anchor('membre/sign/',"S'inscrire");
								if(isset($connect))
								{
								echo $connect;
								}			
							endif; 
						endif; ?>
				</div>
		 <?php 
		 echo $vue;
		 ?>
		</div>
		<?php if(isset($listeMembre)){echo $listeMembre;}?>
	<footer>
		
	</footer>
</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>web/script/main.js"></script>
</body>	
</html>