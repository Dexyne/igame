
<div class="page-header">
	<h1>Bâtiments</h1>
</div>

<div class="alert-message warning" data-alert="alert">
<?php if(isset($in_queue) && !empty($in_queue)) : ?>
		<ul>
		<?php foreach($in_queue as $in) : 
			for($i = 0; $i < count($building_list); $i++) :
				if($in->element_id == $building_list[$i]->id): ?>
					<li><?php echo $building_list[$i]->name ?></li>
		<?php endif; endfor; endforeach; ?>
		</ul>
<?php else : ?>
		<p>Aucun bâtiment en cours de construction.</p>
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
<?php foreach($building_list as $building) : ?>
	<tr>
		<td><?php echo img("building/{$building->name_clean}.gif", "Illustration : {$building->name}", $building->name) ?></td>
		<td>
			<h4>
				<?php echo $building->name ?>
			<?php if($building->important > 0)
				echo "<span class=\"label important\">Important</span>"; ?>
			</h4>
			<p><?php echo $building->content ?></p>
			<dl>
				<dt>Ressource nécessaire :<dt>
				<dd>
					<?php if(!is_null($building->metal)) echo img('icons/metal.gif').$building->metal ?>
					<?php if(!is_null($building->crystal)) echo img('icons/crystal.gif').$building->crystal ?>
					<?php if(!is_null($building->deuterium)) echo img('icons/deuterium.gif').$building->deuterium ?>
					<?php if(!is_null($building->energy)) echo img('icons/energy.gif').$building->energy ?>
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