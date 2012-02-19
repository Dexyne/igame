		<nav class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				<?php if(!$this->session->userdata('email') || !$this->session->userdata('logged')) : ?>
					<?php echo anchor('home', 'iGame', 'class="brand"'); ?>
				<?php else : ?>
					<?php echo anchor('game/home', 'iGame', 'class="brand"'); ?>
				<?php endif; ?>

					<div class="nav-collapse">
						<ul class="nav">
							<li class="active"><?php echo anchor('home', "Accueil"); ?></li>
						<?php if(!$this->session->userdata('email') || !$this->session->userdata('logged')) : ?>
							<li><?php echo anchor('users/register', "S'inscrire"); ?></li>
						<?php else : ?>
							<li><?php echo anchor('users/show', "Profil"); ?></li>
						<?php endif; ?>

					<?php if(!$this->session->userdata('email') || !$this->session->userdata('logged')) : ?>
						<?php echo form_open('users/login', 'class="navbar-form pull-right"'); ?>
							<input type="text" name="user[login]" class="input-small" placeholder="Email">
							<input type="password" name="user[password]" class="input-small" placeholder="Mot de passe">
							<button class="btn btn-success" type="submit">Connexion</button>
						<?php echo form_close(); ?>
					<?php else :
						$data['planets'] = $this->planet_model->get_allPlanetByuser($this->session->userdata('id'));
					?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									Planètes
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
								<?php foreach($data['planets'] as $planet) : ?>
									<li><?php echo anchor('game/planets/show/'.$planet->id, $planet->name); ?></li>
								<?php endforeach; ?>
								</ul>
							</li>
						</ul>
					</div>
				<?php $data['resources'] = $this->planet_model->get_allResourcesByPlanet($this->session->userdata('planet_id'));

					echo '<span class="navbar-text resources">';
					foreach($data['resources'] as $resource) : ?>
						<?php echo img('icons/metal.gif', '', 'Métal').(int) $resource->metal ?>
						<?php echo img('icons/crystal.gif', '', 'Cristal').(int) $resource->crystal ?>
						<?php echo img('icons/deuterium.gif', '', 'Deutérium').(int) $resource->deuterium ?>
						<?php echo img('icons/energy.gif', '', 'Energie').(int) $resource->energy_used.'/'.(int) $resource->energy_max ?>
						<?php echo img('icons/message.gif', '', 'Message(s)') ?>3
					<?php endforeach;
					echo '</span>';
					echo form_open('users/logout', 'class="navbar-form pull-right"'); ?>
						<button class="btn btn-danger" type="submit">Déconnexion</button>
					<?php  echo form_close(); ?>
				<?php endif; ?>
				</div>
			</div>
		</nav>
