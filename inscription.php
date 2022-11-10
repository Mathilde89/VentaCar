<?php

require __DIR__ . "/pdo.php";
require __DIR__."/session.php";
require __DIR__."/classes/UsersClass.php";

// Insert la personne qui vient de s'inscrire dans la base de donnée
if (isset($_POST["submitInscription"])) {
    //Permet de crypter le mot de passe
    $passwordcrypte = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $user = new Users( $_POST["name"],$_POST["firstname"],$_POST["email"],$passwordcrypte);
    $postUser=$user->save($pdo);
    // $query = $pdo->prepare("INSERT INTO `users` (`name`, `firstname`, `email`, `password`) VALUES (:name, :firstname, :email, :password)");
    // $query->bindValue(":name", $_POST["name"], PDO::PARAM_STR);
    // $query->bindValue(":firstname", $_POST["firstname"], PDO::PARAM_STR);
    // $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
    // $query->bindValue(":password", $passwordcrypte, PDO::PARAM_STR);

    
    header("Location: connexion.php");
};


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>

<body>
    <header>

        <?php
        include __DIR__ . "/menu.php";
        afficherMenu($menu);
        ?>

    </header>

    <h2>Inscription au site VentaCar</h2>
    <form action="inscription.php" method="post">
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name="firstname">

        <label for="name">Nom</label>
        <input type="text" id="name" name="name">

        <label for="email">Email</label>
        <input type="email" id="email" name="email">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">


        <input type="submit" value="S'inscrire" name="submitInscription">
    </form>
</body>

</html>