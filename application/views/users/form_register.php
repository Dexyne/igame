
<div class="page-header">
	<h1>Inscription</h1>
</div>

<?php if(isset($notif)) : echo notif($notif['type'], $notif['message']); else : echo ''; endif; ?>

<?php echo form_open('users/register'); ?>
	<label for="user[name]">Pseudo :</label>
	<input type="text" id="user[name]" name="user[name]" value="<?php echo set_value('user[name]') ?>">
	<div class="clear"></div>

	<label for="user[email]">E-mail :</label>
	<input type="text" id="user[email]" name="user[email]" value="<?php echo set_value('user[email]') ?>">
	<div class="clear"></div>

	<label for="user[password]">Mot de passe :</label>
	<input type="password" id="user[password]" name="user[password]" value="">
	<div class="clear"></div>

	<label for="user[pass_conf]">Confirmation du mot de passe :</label>
	<input type="password" id="user[pass_conf]" name="user[pass_conf]" value="">
	<div class="clear"></div>

	<input type="submit" value="S'inscrire" class="btn primary">
<?php echo form_close(); ?>