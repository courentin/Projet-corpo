
<form method = 'post' action= ''>                                                                       
<br>                                                                                     
<br>
<form action =‘/compte/identification’>

		<?php
				$form = new FormHelper(‘identification’, array(
				'defaultValues' => $_POST
				
		));				

				echo $form->input(‘email’, [ ‘type’ => ‘email’ ]); 
				echo $from->input(‘MDP’, [’type’ => ‘password’ ]);



?> 
<input type="submit" class="btn btn-primary" value=“S’identifier”>     
</form> 
      </div> 