
<div class="page-header">
	<h1>Laboratoire</h1>
</div>

<?php if(isset($existing)) : ?>
	<div class="alert-message warning" data-alert="alert">
		Le laboratoire n'est pas encore construit, aucune technologie ne peut donc être recherché.
	</div>

<?php else : ?>
	<div class="alert-message warning" data-alert="alert">
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
			<p>Aucune recherche en cours.</p>
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
	<?php foreach($list as $technology) : ?>
		<tr>
			<td><?php echo img("technologies/{$technology->name_clean}.gif", "Illustration : {$technology->name}", $technology->name) ?></td>
			<td>
				<h4>
					&lsaquo;<?php echo anchor('game/laboratory/show/'.$technology->id, $technology->name, 'class="anchor"') ?>&rsaquo;
				<?php if($technology->important > 0)
					echo '<span class="label important">Important</span>'; ?>
				</h4>
				<p><?php echo $technology->introduction ?></p>
				<dl>
					<dt>Ressource(s) nécessaire(s) :<dt>
					<dd>
						<?php if(!is_null($technology->metal)) echo img('icons/metal.gif', 'métal', 'Métal')
						.(floor($technology->metal * ($technology->level + 1) * $technology->multiplier)) ?>
						<?php if(!is_null($technology->crystal)) echo img('icons/crystal.gif', 'cristal', 'Cristal')
						.(floor($technology->crystal * ($technology->level + 1) * $technology->multiplier)) ?>
						<?php if(!is_null($technology->deuterium)) echo img('icons/deuterium.gif', 'deutérium', 'Deutérium')
						.(floor($technology->deuterium * ($technology->level + 1) * $technology->multiplier)) ?>
						<?php if(!is_null($technology->energy)) echo img('icons/energy.gif', 'énergie', 'Energie')
						.(floor($technology->energy * ($technology->level + 1) * $technology->multiplier)) ?>
					</dd>
					<dd>Temps de construction : 
						<?php if($technology->construct_time > 0) :
							echo floor((($technology->construct_time * ($technology->level + 1) * $technology->multiplier) / 60)) ?> minutes
						<?php else :
							echo '<span class="label notice">Instantané</span>';
						endif; ?>
					</dd>
				</dl>
			</td>
			<td class="center">
				<?php echo $technology->level ?>
			</td>
			<td><?php echo anchor("game/laboratory/create/{$technology->id}", "Construire ?"); ?></td>
		</tr>
	<?php endforeach; ?>		
	</table>

<?php endif; ?>