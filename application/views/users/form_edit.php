
<div class="page-header">
	<h1>Modification du profil</h1>
</div>

<?php if(isset($notif)) : echo notif($notif['type'], $notif['message']); else : echo ''; endif; ?>

<?php echo form_open('users/edit/'.$user->id); ?>
	<label for="edit_user[name]">Pseudo :</label>
	<input type="text" id="edit_user[name]" name="edit_user[name]" value="<?php if(isset($user)): echo $user->username; else: echo set_value('edit_user[name]'); endif; ?>">
	<div class="clear"></div>

	<label for="edit_user[email]">E-mail :</label>
	<input type="text" id="edit_user[email]" name="edit_user[email]" value="<?php if(isset($user)): echo $user->email; else: echo set_value('edit_user[email]'); endif; ?>">
	<div class="clear"></div>

	<label for="edit_user[password]">Mot de passe :</label>
	<input type="password" id="edit_user[password]" name="edit_user[password]" value="">
	<div class="clear"></div>

	<label for="edit_user[pass_conf]">Confirmation du mot de passe :</label>
	<input type="password" id="edit_user[pass_conf]" name="edit_user[pass_conf]" value="">
	<div class="clear"></div>

	<input type="submit" value="Mettre à jour" class="btn primary">
<?php echo form_close(); ?>