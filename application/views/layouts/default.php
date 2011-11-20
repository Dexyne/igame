<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>iGame <?php if(isset($title)) echo "- {$title}"; ?></title>
		<link rel="stylesheet" href="<?php echo css_url('bootstrap.css') ?>" />
		<link rel="stylesheet" href="<?php echo css_url('style.css') ?>" />
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	</head>

	<body>
		<nav class="topbar">
			<div class="fill">
				<div class="container">
					<?php echo anchor(base_url(), 'iGame', 'class="brand"'); ?>

					<ul class="nav">
						<li class="active"><?php echo anchor('home', "Home"); ?></li>
					<?php if(!$this->session->userdata('email') || !$this->session->userdata('logged')) : ?>
						<li><?php echo anchor('users/register', "S'inscrire"); ?></li>
						<li><?php echo anchor('users/login', "Connexion"); ?></li>
					<?php else : ?>
						<li><?php echo anchor('users/profile/view', "Profil"); ?></li>
						<li><?php echo anchor('users/logout', "Déconnexion"); ?></li>
					<?php endif; ?>
						
					</ul>

					<form action="" class="pull-right">
						<input class="input-small" type="text" placeholder="Email">
						<input class="input-small" type="password" placeholder="Mot de passe">
						<button class="btn" type="submit">Sign in</button>
					</form>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="content">
				{{ content_for_layout }}	
			</div>

			<footer class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</footer>
		</div>

		<script type="text/javascript" src="<?php echo js_url('less'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('bootstrap-alerts'); ?>"></script>
	</body>
</html>