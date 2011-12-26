
<div class="page-header">
	<h1><?php echo $technology->name ?></h1>
</div>

<p><?php echo anchor('game/laboratory/', "&larr; Revenir au laboratoire") ?></p>

<table>
	<tr>
		<th>&nbsp;</th>
		<th>Informations</th>
	</tr>
	<tr>
		<td><?php echo img("technologies/{$technology->name_clean}.gif", "Illustration : {$technology->name}", $technology->name) ?></td>
		<td>
			<p><?php echo $technology->content ?></p>
		</td>
	</tr>
	<tr>
		<td colspan="2"><?php echo anchor('#', "Détruire d'un niveau ?") ?></td>
	</tr>
</table>