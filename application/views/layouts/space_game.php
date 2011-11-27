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
		<?php require_once '_navigator.php' ?>

		<div class="container">
			<div class="container-fluid">
				<div class="sidebar">
					<ul>
						<li><?php echo anchor('game/', "Vue générale"); ?></li>
						<li><?php echo anchor('game/building', "Bâtiments"); ?></li>
						<li><?php echo anchor('game/', "Laboratoire"); ?></li>
						<li><?php echo anchor('game/', "Chantier spatial"); ?></li>
						<li><?php echo anchor('game/', "Défense"); ?></li>
					</ul>					
				</div>
				<div class="content">
					{{ content_for_layout }}	
				</div>
			</div>
			
			<footer class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</footer>
			<?php
			$datetime1 = new DateTime(date('Y-m-d H:i:s'));
			$datetime2 = new DateTime('2011-11-26 16:00:00');
			$interval = $datetime1->diff($datetime2);
			echo '<pre>';
			print_r($interval);
			echo '</pre>';
			echo $interval->format('%R %y an(s) %m mois %d jour(s) %h:%i:%s');
			echo '<br>';
			echo $interval->format('days');
			?>
		</div>

		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script type="text/javascript" src="<?php echo js_url('less'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('bootstrap-alerts'); ?>"></script>
		<script src="<?php echo js_url('bootstrap-dropdown'); ?>"></script>
	</body>
</html>