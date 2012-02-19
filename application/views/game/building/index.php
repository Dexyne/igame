
<div class="page-header">
	<h1>Bâtiments</h1>
</div>

<div class="alert" data-alert="alert">
<?php if(isset($in_queue) && !empty($in_queue)) : ?>
		<ul>
		<?php foreach($in_queue as $in) :
			for($i = 0; $i < count($list); $i++) :
				if($in->element_id == $list[$i]->id): ?>
					<li class="construction" data-id="<?php echo $in->id ?>" data-finish-at="<?php echo $in->time_finish ?>">
						<?php echo $list[$i]->name ?>
						<span class="pull-right">Temps restant : <span class="remaining-time">...</span></span>
					</li>
		<?php endif; endfor; endforeach; ?>
		</ul>
<?php else : ?>
		Aucun bâtiment en cours de construction.
<?php endif; ?>
</div>

<?php if(isset($notif)) : echo notif($notif['type'], $notif['message']); endif; ?>

<table>
	<tr>
		<th>&nbsp;</th>
		<th>Informations</th>
		<th>Level</th>
		<th>Actions</th>
	</tr>
<?php foreach($list as $building) : ?>
	<tr>
		<td><?php echo img("building/{$building->name_clean}.gif", "Illustration : {$building->name}", $building->name) ?></td>
		<td>
			<h4>
				&lsaquo;<?php echo anchor('game/building/show/'.$building->id, $building->name, 'class="anchor"') ?>&rsaquo;
			<?php if($building->important > 0)
				echo '<span class="label label-important">Important</span>'; ?>
			</h4>
			<p><?php echo $building->introduction ?></p>
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
				<dd>Temps de construction :
				<?php if($building->construct_time > 0) :
					echo (($building->construct_time * ($building->level + 1) * $building->multiplier) / 60) ?> minutes
				<?php else :
					echo '<span class="label label-notice">Instantané</span>';
				endif; ?>
				</dd>
			</dl>
		</td>
		<td class="center">
			<?php echo $building->level ?>
		</td>
		<td><?php echo anchor("game/building/create/{$building->id}", "Construire ?"); ?></td>
	</tr>
<?php endforeach; ?>
</table>
