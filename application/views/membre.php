<div id="memberB">
	<?php
		if(isset($messageM)): ?>
		<p class="errM"><?php echo $messageM; ?></p>
		<?php
		else:?>
		<h2 class="membre">Connexion</h2>
		<?php 
		 endif;
		echo validation_errors(); 
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