<div id="memberB">
	<h2 class="membre">Connexion</h2>
	<?php
		if(isset($messageM)): ?>
		<p class="errM"><?php echo $messageM; ?></p>
		<?php
		 endif;
		 if(isset($errL)): ?>
	     <div class="valErr"><?php echo validation_errors();?></div>
	     <?php
	     endif; 
		 echo form_open('membre/login',array('method'=>'post'));
		 echo form_fieldset('Connexion');
		 echo form_label('Adresse mail','email');
		 $emailInput=array('name'=>'email','id'=>'email','value' => set_value('email'));
		 echo form_input($emailInput);
		 echo form_label('Mot de passe','mdp');
		 $passwordInput =array('name'=>'mdp', 'id'=>'mdp','value' => set_value('mdp'));
		 echo form_password($passwordInput);
		 echo form_submit('connect', 'Se connecter','class="btn"');
		echo form_fieldset_close();
		 echo form_close();
		 ?> 
</div>
<div id="member">
	<h2 class="membre">Inscription</h2>
	<?php
	if(isset($errM)): ?>
		<div class="valErr"><?php echo validation_errors();?></div>
	<?php
		endif;
	 	if(isset($messageOk)): ?>
			<p class="Ok"><?php echo $messageOk; ?></p>
		<?php
		 endif; 
		 echo form_open('membre/signin',array('method'=>'post'));
		 echo form_fieldset('Inscription');
		 echo form_label('Adresse mail','Iemail');
		 $emailInput=array('name'=>'Iemail','id'=>'Iemail','value' => set_value('email'));
		 echo form_input($emailInput);
		 echo form_label('Pseudo','pseudo');
		 $emailInput=array('name'=>'pseudo','id'=>'pseudo','value' => set_value('pseudo'));
		 echo form_input($emailInput);
		 echo form_label('Mot de passe','Imdp');
		 $passwordInput =array('name'=>'Imdp', 'id'=>'Imdp','value' => set_value('mdp'));
		 echo form_password($passwordInput);
		  echo form_label('Confirmer le mot de passe','confirm');
		 $passwordInput =array('name'=>'confirm', 'id'=>'confirm','value' => set_value('confirm'));
		 echo form_password($passwordInput);
		 echo form_submit('sign', "S'inscrire",'class="btn"');
		 echo form_fieldset_close();
		 echo form_close(); 
		 ?>  
</div>