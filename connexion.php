<?php
var_dump($_POST);

function verifconnexion(){
       
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["password"]=="titi" && $_POST["email"]=="titi@titi.com"){
            // header("Location: http://localhost/ventacar/acceuil");
            return true;
          
        } else {
            return false;
          
        }
    }
};
verifconnexion();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Connexion au site VentaCar</h2>
    <?php if(!verifconnexion()){?>
        <p>Mot de passe ou email erronné</p>
        <?php }; ?>
    <form action="connexion.php" method="post">
      
        <label for="email">Email</label>
        <input type="email" id="email" name="email">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">


        <input type="submit" value="Connexion"  name="submitConnexion">
    </form>
</body>
</html>