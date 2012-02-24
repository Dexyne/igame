<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>iGame <?php if(isset($title)) echo "- {$title}"; ?></title>
		<link rel="stylesheet" href="<?php echo css_url('bootstrap.min') ?>" />
		<link rel="stylesheet" href="<?php echo css_url('bootstrap-responsive.min') ?>" />
		<link rel="stylesheet" href="<?php echo css_url('style') ?>" />
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	</head>

	<body>
		<?php require_once '_navigator.php' ?>

		<div class="container">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="content">
							{{ content_for_layout }}
						</div>
					</div>
				</div>
			</div>

			<footer class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</footer>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="<?php echo js_url('bootstrap.min'); ?>"></script>
	</body>
</html>
