<?php
if($this->session->userdata('logged in')): ?>
	<section id="listeMembre">
		<h1>Liste des membres</h1>

		<?php if(isset($membre)):
			foreach($membre as $member): ?>
				<article id="<?php echo $member['id_membre']; ?>" class="<?php echo $member['followed']; ?>">
					<h1><?php echo $member['nom']; ?></h1>

					<?php if($member['followed']=='false'){echo anchor('membre/ajouterFollows/?id_ami='.$member['id_membre'], 'Suivre '.$member['nom'],'class="followMember"');} ?>
				</article>
			<?php endforeach; endif; ?>

	</section>
<?php endif; ?>