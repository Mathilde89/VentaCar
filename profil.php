<?php 
require __DIR__."/classes/UsersClass.php";
require __DIR__."/pdo.php";
require __DIR__."/session.php";



function getInfoprofil($pdo){

    $query7 = $pdo->prepare("SELECT * FROM `users` WHERE id=:id;");
    $query7->bindValue(":id",$_SESSION["id"] , PDO::PARAM_INT);
    $query7->execute();
    $listUser = $query7->fetchAll(PDO::FETCH_ASSOC);
    foreach($listUser as $key => $value){
       echo '<li>Nom :'.$value["name"].'</li>';
       echo '<li>Prénom :'.$value["firstname"].'</li>';
       echo '<li>Email:'.$value["email"].'</li>';
        
         }
    
};

if (isset($_POST["modilProfil"])) {
    $passwordcryptage = password_hash($_POST["password"], PASSWORD_DEFAULT);
    

    $modifUser= new Users($_POST["name"],$_POST["firstname"],$_POST["email"],$passwordcryptage,$_SESSION["id"]);
    
    $updateUser=$modifUser->update($pdo);

    // getInfoprofil($pdo);
   
// $query = $pdo->prepare("SELECT * FROM `users` WHERE id=:id");
// $query->bindValue(':id', $_SESSION["id"], PDO::PARAM_INT);
// $query->execute();
// $user = $query->fetch(PDO::FETCH_ASSOC);
// var_dump($user);

}

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

    <ul>
    <?php echo getInfoprofil($pdo)?>
       
        
    </ul>

    <h2>Modifier vos information </h2>
    <form action="profil.php" method="post">
        <label for="firstname">Prénom:
            <input type="text" id="firstname" name="firstname">
        </label>

        <label for="name">Nom:
            <input type="text" id="name" name="name">
        </label>

        <label for="email">Email:
            <input type="email" id="email" name="email">
        </label>

        <label for="password">Mot de passe:
            <input type="password" id="password" name="password">
        </label>
        
        <input type="submit" value="Modifier" name="modilProfil">
        
    </form>
</body>
</html>