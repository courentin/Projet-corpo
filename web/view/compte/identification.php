<div class="page-header">
  <h1>Identification</h1>
</div>
<form method = 'post' action= ''>                                                                       

		<?php
				$form = new FormHelper('identification', array(
				'defaultValues' => $_POST,
				'errors' => $err
				
		));				

				echo $form->input("email", [ "type" => "email" ]); 
				echo $form->input("MDP", ["type" => "password" ]);

				if(isset($err['global'])) echo '<p class="alert alert-danger">' . $err['global'] . '</p>';

?> 
<input type="submit" class="btn btn-primary" value="S'identifier">     
</form> 
      </div> 