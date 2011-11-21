
<div class="page-header">
	<h1>Profil</h1>
</div>

<?php if(isset($notif)) : echo notif($notif['type'], $notif['message']); endif; ?>

<p>Bienvenue sur votre profil <?php echo $this->session->userdata('username'); ?>.</p>