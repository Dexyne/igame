<?php $this->load->view('includes/header'); ?>

		<h1>Utilisateurs</h1>

		<?php echo form_open('users/register'); ?>
			<label for="user[name]">Pseudo :</label>
			<input type="text" id="user[name]" name="user[name]" value="">
			<div class="clear"></div>

			<label for="user[email]">E-mail :</label>
			<input type="text" id="user[email]" name="user[email]" value="">
			<div class="clear"></div>

			<label for="user[password]">Mot de passe :</label>
			<input type="text" id="user[password]" name="user[password]" value="">
			<div class="clear"></div>

			<label for="user[conf_password]">Confirmation du mot de passe :</label>
			<input type="text" id="user[conf_password]" name="user[conf_password]" value="">
			<div class="clear"></div>

			<input type="submit" value="S'inscrire" class="btn primary">
		<?php echo form_close(); ?>

<?php $this->load->view('includes/footer'); ?>