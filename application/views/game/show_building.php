
<div class="page-header">
	<h1>Bâtiments</h1>
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
					Métal : <?php echo $building->metal ?>
					Cristal : <?php echo $building->crystal ?>
					Deutérium : <?php echo $building->deuterium ?>
					Energie : <?php echo $building->energy ?>
				</dd>
			</dl>
		</td>
		<td class="center">0</td>
		<td><?php echo anchor("game/building/create/{$building->id}", "Construire ?"); ?></td>
	</tr>
<?php endforeach; ?>		
</table>