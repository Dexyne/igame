<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>iGame <?php if(isset($title)) echo "- {$title}"; ?></title>
		<link rel="stylesheet" href="<?php echo css_url('bootstrap.min') ?>" />
		<link rel="stylesheet" href="<?php echo css_url('style') ?>" />
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	</head>

	<body>
		<?php require_once '_navigator.php' ?>

		<div class="container">
			<div class="content">
				{{ content_for_layout }}	
			</div>
			
			<footer class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</footer>
		</div>

		<script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
		<script type="text/javascript" src="<?php echo js_url('less'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('bootstrap-alerts'); ?>"></script>
		<script src="<?php echo js_url('bootstrap-dropdown'); ?>"></script>
	</body>
</html>