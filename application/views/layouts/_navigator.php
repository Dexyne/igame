		<nav class="topbar">
			<div class="fill">
				<div class="container">
				<?php if(!$this->session->userdata('email') || !$this->session->userdata('logged')) : ?>
					<?php echo anchor('home', 'iGame', 'class="brand"'); ?>
				<?php else : ?>
					<?php echo anchor('game/home', 'iGame', 'class="brand"'); ?>
				<?php endif; ?>

					<ul class="nav">
						<li class="active"><?php echo anchor('home', "Accueil"); ?></li>
					<?php if(!$this->session->userdata('email') || !$this->session->userdata('logged')) : ?>
						<li><?php echo anchor('users/register', "S'inscrire"); ?></li>
					<?php else : ?>
						<li><?php echo anchor('users/show', "Profil"); ?></li>
					<?php endif; ?>
						
					</ul>

				<?php if(!$this->session->userdata('email') || !$this->session->userdata('logged')) : ?>
					<?php echo form_open('users/login', 'class="pull-right"'); ?>
						<input type="text" name="user[login]" class="input-small" placeholder="Email">
						<input type="password" name="user[password]" class="input-small" placeholder="Mot de passe">
						<button class="btn success" type="submit">Connexion</button>
					<?php echo form_close(); ?>
				<?php else : ?>
					<?php echo form_open('users/logout', 'class="pull-right resources"'); ?>
						<?php echo img('icons/metal.gif') ?>9999
						<?php echo img('icons/crystal.gif') ?>9999
						<?php echo img('icons/deuterium.gif') ?>9999
						<?php echo img('icons/energy.gif') ?>9999
						<?php echo img('icons/message.gif') ?>3
						<button class="btn danger" type="submit">Déconnexion</button>
					<?php echo form_close(); ?>
				<?php endif; ?>
				</div>
			</div>
		</nav>