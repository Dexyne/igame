
<div class="page-header">
	<h1>Inscription</h1>
</div>

<?php if(isset($notif)) : echo notif($notif['type'], $notif['message']); else : echo ''; endif; ?>

<?php echo form_open('users/register'); ?>
	<label for="new_user[name]">Pseudo :</label>
	<input type="text" id="new_user[name]" name="new_user[name]" value="<?php echo set_value('new_user[name]') ?>">
	<div class="clear"></div>

	<label for="new_user[email]">E-mail :</label>
	<input type="text" id="new_user[email]" name="new_user[email]" value="<?php echo set_value('new_user[email]') ?>">
	<div class="clear"></div>

	<label for="new_user[password]">Mot de passe :</label>
	<input type="password" id="new_user[password]" name="new_user[password]" value="">
	<div class="clear"></div>

	<label for="new_user[pass_conf]">Confirmation du mot de passe :</label>
	<input type="password" id="new_user[pass_conf]" name="new_user[pass_conf]" value="">
	<div class="clear"></div>

	<input type="submit" value="S'inscrire" class="btn primary">
<?php echo form_close(); ?>