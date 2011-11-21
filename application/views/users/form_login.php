
<div class="page-header">
	<h1>Connexion</h1>
</div>
<?php echo anchor('users/register', "Pas encore inscrit ?"); ?>

<?php if(isset($notif)) : echo notif($notif['type'], $notif['message']); else : echo ''; endif; ?>

<?php echo form_open('users/login'); ?>
	<label for="user[login]">E-mail :</label>
	<input type="text" id="user[login]" name="user[login]" value="<?php echo set_value('user[login]') ?>" placeholder="Votre email">
	<div class="clear"></div>

	<label for="user[password]">Mot de passe :</label>
	<input type="password" id="user[password]" name="user[password]" value="<?php echo set_value('user[password]') ?>" placeholder="mot de passe">
	<div class="clear"></div>

	<input type="submit" value="Connexion" class="btn primary">
<?php echo form_close(); ?>