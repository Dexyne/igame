<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Home</title>
		<link rel="stylesheet" href="<?php echo css_url('bootstrap.css') ?>" />
	</head>

	<body>

		<nav class="topbar" data-scrollspy="scrollspy">
			<div class="topbar-inner">
				<div class="container">
					<?php echo anchor(base_url(), 'iGame', 'class="brand"'); ?>

					<ul class="nav">
						<li class="active"><?php echo anchor('home', "Home"); ?></li>
						<li><?php echo anchor('users/register', "S'inscrire"); ?></li>
					</ul>
				</div>
			</div>
		</nav>

		<div id="container">