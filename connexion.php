<?php
var_dump($_POST);

function verifconnexion(){
    $verif_ok=false;
    require __DIR__."/pdo.php";

    
    if(isset($_POST["submitConnexion"])){

        // Fonction de vérification du bon mot de passe
    
            // Reccupère tous les users
        $query2=$pdo->prepare("SELECT * FROM users");
        $query2->execute();
        $users=$query2->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($users);

            // Pour tester si bon mot de passe - A modifier après pour crypter le mdp
        foreach($users as $key => $value){
            
            if ($value["email"]==$_POST["email"] && $value["password"]==$_POST["password"]){
                           
                
                // Démarre une nouvelle session
                    session_start(); 
                    
                    //Mets à dispo les informations de connexion
                    $_SESSION['id'] = $value["id"];
                    $_SESSION['nom'] = $value["name"];
                    $_SESSION['prenom'] = $value["firstname"];
                    $_SESSION['email'] = $value["email"];
                    $_SESSION['password'] = $value["password"];
                    
                    $id_session = session_id();
                    var_dump($_COOKIE['PHPSESSID']);
                    var_dump($id_session);
                    var_dump($_SESSION);
               
                    $verif_ok=true;
                    header("Location: http://localhost/ventacar/index.php");
                } 
                
            }
            return $verif_ok;

    }



};


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
    <nav>
        <ul>
            <?php
            include __DIR__ . "/menu.php";
            afficherMenu($menu);
            ?>
        </ul>
    </nav>
    <h2>Connexion au site VentaCar</h2>
     <?php if(!verifconnexion()){?>
        <p>Mot de passe ou email erronné</p>
        <?php }; ?>
        
   
    <form action="connexion.php" method="post">

        <label for="email">Email</label>
        <input type="email" id="email" name="email">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">


        <input type="submit" value="Connexion" name="submitConnexion">
    </form>
</body>

</html>
