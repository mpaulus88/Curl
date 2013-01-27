<div id="member">
	<?php
		 echo validation_errors(); 
		 echo form_open('membre/signin',array('method'=>'post'));
		 echo form_fieldset('Inscription');
		 echo form_label('Adresse mail','email');
		 $emailInput=array('name'=>'email','id'=>'email','value' => set_value('email'));
		 echo form_input($emailInput);
		 echo form_label('Pseudo','pseudo');
		 $emailInput=array('name'=>'pseudo','id'=>'pseudo','value' => set_value('pseudo'));
		 echo form_input($emailInput);
		 echo form_label('Mot de passe','mdp');
		 $passwordInput =array('name'=>'mdp', 'id'=>'mdp','value' => set_value('mdp'));
		 echo form_password($passwordInput);
		  echo form_label('Confirmer le mot de passe','confirm');
		 $passwordInput =array('name'=>'confirm', 'id'=>'confirm','value' => set_value('confirm'));
		 echo form_password($passwordInput);
		 echo form_submit('sign', "S'inscrire",'class="btn"');
		 echo form_fieldset_close();
		 echo form_close(); 
		 ?>
		   
</div>