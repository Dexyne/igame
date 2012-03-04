
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

	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th><div class="center">Informations</div></th>
				<th><div class="center">Nombre</div></th>
				<th class="span2"><div class="center">Actions</div></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($list as $ship) : ?>
			<tr>
				<td class="span2"><?php echo img("ship/{$ship->name_clean}.gif", "Illustration : {$ship->name}", $ship->name) ?></td>
				<td>
					<h4>
						&lsaquo;<?php echo anchor('game/ship/show/'.$ship->id, $ship->name, 'class="anchor"') ?>&rsaquo;
					</h4>
					<p><?php echo $ship->introduction ?></p>
					<dl>
						<dt>Ressource(s) nécessaire(s) :</dt>
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
						<dd>Temps de construction :
						<?php if($ship->construct_time > 0) :
							echo (($ship->construct_time * ($ship->level + 1) * $ship->multiplier) / 60) ?> minutes
						<?php else :
							echo '<span class="label label-notice">Instantané</span>';
						endif; ?>
						</dd>
					</dl>
				</td>
				<td><div class="center"><?php echo $ship->level ?></div></td>
				<td><div class="center"><?php echo anchor("game/ship/create/{$ship->id}", "Construire ?"); ?></div></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

<?php endif; ?>
