
<div class="page-header">
	<h1>Profil</h1>
</div>

<?php if(isset($notif)) : echo notif($notif['type'], $notif['message']); endif; ?>

<p>
<?php echo ($user_profile) ? "Bienvenue sur votre profil " : "Profil de : " ?><?php echo $user->username; ?>.<br />
	E-mail : <?php echo $user->email ?><br />
	Inscrit le : <?php echo $user->created_at ?>
</p>

<?php if(isset($user_profile) && $user_profile == true) : ?>
<a href="edit/<?php echo $user->id ?>" class="btn">Modifier votre profil</a>
<?php endif; ?>