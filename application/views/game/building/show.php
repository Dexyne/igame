
<div class="page-header">
	<h1><?php echo $building->name ?></h1>
</div>

<p><?php echo anchor('game/building/', "&larr; Revenir à la liste des bâtiments") ?></p>

<table>
	<tr>
		<th>&nbsp;</th>
		<th>Informations</th>
	</tr>
	<tr>
		<td><?php echo img("building/{$building->name_clean}.gif", "Illustration : {$building->name}", $building->name) ?></td>
		<td>
			<p><?php echo $building->content ?></p>
		</td>
	</tr>
	<tr>
		<td colspan="2"><?php echo anchor('#', "Détruire d'un niveau ?") ?></td>
	</tr>
</table>