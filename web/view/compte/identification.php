<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="evol.css">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
   include_once ('IdentificationControleur.php');
   include_once ('connexionBDD.php');
?>

<title>Identification</title>
</head>
                                                                                                 
<body>     
<form method = 'post' action= ''>                                                                       
<br>                                                                                     
<br>
      <p>                 E-mail :
                          <input style=" margin-left: 58px" type='text' value='' name='MAIL' id='MAIL' >
<br>                    
                           Mot de passe :
                          <input style=" margin-left: 5px" type = "PASSWORD" name = "MDP" id = "MDP" >                                
      </p>
      
      <input type='submit' style = 'margin-left: 900px; margin-top: 50px' value='Connexion'></form> 
      </div> 
</body>

</html>
