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
				<?php else :
					$data['resources'] = $this->planets_model->get_allResourcesByPlanet(1); 
					
					echo form_open('users/logout', 'class="pull-right resources"');
					foreach($data['resources'] as $resource) : ?>
						<?php echo img('icons/metal.gif').(int) $resource->metal ?>
						<?php echo img('icons/crystal.gif').(int) $resource->crystal ?>
						<?php echo img('icons/deuterium.gif').(int) $resource->deuterium ?>
						<?php echo img('icons/energy.gif').(int) $resource->energy_used.'/'.(int) $resource->energy_max ?>
						<?php echo img('icons/message.gif') ?>3
					<?php endforeach; ?>
						<button class="btn danger" type="submit">Déconnexion</button>
					<?php echo form_close(); ?>
				<?php endif; ?>
				</div>
			</div>
		</nav>