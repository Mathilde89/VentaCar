<?php



function verifconnexion()
{
    $verif_ok = "faux";
    require __DIR__ . "/pdo.php";


    if (isset($_POST["submitConnexion"])) {

        // Fonction de vérification du bon mot de passe

        // Reccupère tous les users
        $query2 = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
        $query2->bindValue(":email", $_POST["email"],PDO::PARAM_STR);
        $query2->execute();
        $user = $query2->fetch(PDO::FETCH_ASSOC);
        // var_dump($user);

        // Pour tester si bon mot de passe - A modifier après pour crypter le mdp
      
        if ($user["password"] == $_POST["password"]) {

                // Démarre une nouvelle session
              

                //Mets à dispo les informations de connexion
                $_SESSION['id'] = $user["id"];
                $_SESSION['nom'] = $user["name"];
                $_SESSION['prenom'] = $user["firstname"];
                $_SESSION['email'] = $user["email"];
                $_SESSION['password'] = $user["password"];

                $id_session = session_id();
                // var_dump($_COOKIE['PHPSESSID']);
                // var_dump($id_session);
                var_dump($_SESSION);

                header("Location: http://localhost/ventacar/index.php");
                $verif_ok = true;
            } 
        }
        return $verif_ok;
    };

// var_dump(verifconnexion());
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
    <header>
        <nav>
            <ul>
                <?php
                include __DIR__ . "/menu.php";
                afficherMenu($menu);
                ?>
            </ul>
        </nav>
    </header>
    
    <h2>Connexion au site VentaCar</h2>
    <?php if ( verifconnexion()=="null" || verifconnexion()=="faux" ) { ?>
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