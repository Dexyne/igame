
<div class="page-header">
	<h1>Défense</h1>
</div>

<?php if(isset($is_existing)) : ?>
	<div class="alert-message warning" data-alert="alert">
		Le chantier spatial n'est pas encore disponible, aucune défense ne peut être construite.
	</div>

<?php else : ?>
	<?php if(isset($notif)) : echo notif($notif['type'], $notif['message']); endif; ?>

	<table>
		<tr>
			<th>&nbsp;</th>
			<th>Informations</th>
			<th>Level</th>
			<th>Actions</th>
		</tr>
	<?php foreach($building_list as $building) : ?>
		<tr>
			<td><?php echo img("building/{$building->name_clean}.gif", "Illustration : {$building->name}", $building->name) ?></td>
			<td>
				<h4>
					<?php echo $building->name ?>
				<?php if($building->important > 0)
					echo '<span class="label important">Important</span>'; ?>
				</h4>
				<p><?php echo $building->content ?></p>
				<dl>
					<dt>Ressource(s) nécessaire(s) :<dt>
					<dd>
						<?php if(!is_null($building->metal)) echo img('icons/metal.gif', 'métal', 'Métal')
						.(floor($building->metal * ($building->level + 1) * $building->multiplier)) ?>
						<?php if(!is_null($building->crystal)) echo img('icons/crystal.gif', 'cristal', 'Cristal')
						.(floor($building->crystal * ($building->level + 1) * $building->multiplier)) ?>
						<?php if(!is_null($building->deuterium)) echo img('icons/deuterium.gif', 'deutérium', 'Deutérium')
						.(floor($building->deuterium * ($building->level + 1) * $building->multiplier)) ?>
						<?php if(!is_null($building->energy)) echo img('icons/energy.gif', 'énergie', 'Energie')
						.(floor($building->energy * ($building->level + 1) * $building->multiplier)) ?>
					</dd>
					<dd>Temps de construction : <?php echo (($building->construct_time * ($building->level + 1) * $building->multiplier) / 60) ?> minutes</dd>
				</dl>
			</td>
			<td class="center">
				<?php echo $building->level ?>
			</td>
			<td><?php echo anchor("game/building/create/{$building->id}", "Construire ?"); ?></td>
		</tr>
	<?php endforeach; ?>		
	</table>

<?php endif; ?>