<?php
if($this->session->userdata('logged in')): ?>
	<section id="listeMembre">
		<h1>Liste des membres</h1>
		<?php if(isset($membre)):
			foreach($membre as $member): ?>
				<article id="<?php echo $member['id_membre']; ?>" class="<?php echo $member['followed']; ?>">
					<?php if($member['followed']=='false'): ?><h1><?php echo $member['nom']; ?></h1><?php echo anchor('membre/ajouterFollows/?id_ami='.$member['id_membre'], 'Suivre '.$member['nom'],'class="followMember"');
					else: ;?>
						<a class="linkAuthor" href="lien/listerAuteur?id=<?php echo $member['id_membre']; ?>"><h1><?php echo $member['nom']; ?></h1></a>
						<?php echo anchor('membre/retirerFollows/?id_ami='.$member['id_membre'], 'Ne plus suivre '.$member['nom'],'class="unFollowMember"');
					 endif; ?>
				</article>
			<?php endforeach; endif; ?>

	</section>
<?php endif; ?>