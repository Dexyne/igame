
<div class="page-header">
	<h1>Chantier Spatial</h1>
</div>

<?php if(isset($existing) && $existing == false) : ?>
	<div class="alert alert" data-alert="alert">
		Le chantier spatial n'est pas encore disponible, aucun vaisseau ne peut être construit.
	</div>

<?php else : ?>
	<div class="alert alert-warning" data-alert="alert">
	<?php if(isset($in_queue) && !empty($in_queue)) : ?>
			<ul>
			<?php foreach($in_queue as $in) :
				for($i = 0; $i < count($list); $i++) :
					if($in->element_id == $list[$i]->id): ?>
						<li class="construction" data-id="<?php echo $in->id ?>" data-finish-at="<?php echo $in->time_finish ?>">
							<?php echo $list[$i]->name ?><span class="pull-right">
							Temps restant : <span class="remaining-time">...</span></span>
						</li>
			<?php endif; endfor; endforeach; ?>
			</ul>
	<?php else : ?>
			Aucun vaisseau en cours de construction.
	<?php endif; ?>
	</div>

	<?php if(isset($notif)) : echo notif($notif['type'], $notif['message'], $notif['block'], $notif['heading']); endif; ?>

	<table>
		<tr>
			<th>&nbsp;</th>
			<th>Informations</th>
			<th>Level</th>
			<th>Actions</th>
		</tr>
	<?php foreach($list as $ship) : ?>
		<tr>
			<td><?php echo img("ship/{$ship->name_clean}.gif", "Illustration : {$ship->name}", $ship->name) ?></td>
			<td>
				<h4><?php echo $ship->name ?></h4>
				<p><?php echo $ship->content ?></p>
				<dl>
					<dt>Ressource(s) nécessaire(s) :<dt>
					<dd>
						<?php if(!is_null($ship->metal)) echo img('icons/metal.gif', 'métal', 'Métal')
						.(floor($ship->metal * ($ship->level + 1) * $ship->multiplier)) ?>
						<?php if(!is_null($ship->crystal)) echo img('icons/crystal.gif', 'cristal', 'Cristal')
						.(floor($ship->crystal * ($ship->level + 1) * $ship->multiplier)) ?>
						<?php if(!is_null($ship->deuterium)) echo img('icons/deuterium.gif', 'deutérium', 'Deutérium')
						.(floor($ship->deuterium * ($ship->level + 1) * $ship->multiplier)) ?>
						<?php if(!is_null($ship->energy)) echo img('icons/energy.gif', 'énergie', 'Energie')
						.(floor($ship->energy * ($ship->level + 1) * $ship->multiplier)) ?>
					</dd>
					<dd>Temps de construction : <?php echo (($ship->construct_time * ($ship->level + 1) * $ship->multiplier) / 60) ?> minutes</dd>
				</dl>
			</td>
			<td class="center">
				<?php echo $ship->level ?>
			</td>
			<td><?php echo anchor("game/ship/create/{$ship->id}", "Construire ?"); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>

<?php endif; ?>
