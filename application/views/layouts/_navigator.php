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
					$data['planets'] = $this->planet_model->get_allPlanetByuser($this->session->userdata('id'));
				?>
					<ul class="topbar">
						<li class="dropdown" data-dropdown="dropdown" >
							<a href="#" class="dropdown-toggle">Planètes</a>
							<ul class="dropdown-menu">
							<?php foreach($data['planets'] as $planet) : ?>
								<li><?php echo anchor('game/planets/show/'.$planet->id, $planet->name); ?></li>
							<?php endforeach; ?>
							</ul>
						</li>
					</ul>
				<?php
					$data_planet = current($this->planet_model->get_planet($this->session->userdata('planet_id')));
					require_once('./application/controllers/game/planets.php');
					$planet = new Planets();
					$planet->edit($data_planet->id);
					
					$data['resources'] = $this->planet_model->get_allResourcesByPlanet($this->session->userdata('planet_id')); 
					
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