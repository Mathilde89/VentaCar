<?php
var_dump($_POST);
require __DIR__."/pdo.php";

if(isset($_POST["submitCar"])){

    $query3= $pdo->prepare("INSERT INTO `cars`(`model`, `powerful`, `year`, `description`,`user_id`) VALUES (:model,:powerful,:annee,:description,3)");
    $query3->bindValue(":model", $_POST["model"],PDO::PARAM_STR);
    $query3->bindValue(":powerful", $_POST["powerful"],PDO::PARAM_INT);
    $query3->bindValue(":annee", $_POST["year"],PDO::PARAM_INT);
    $query3->bindValue(":description", $_POST["description"],PDO::PARAM_STR);
   
    $result3=$query3->execute();
    var_dump($result3);
    
    };


if(isset($_POST["submitAnnonce"])){
    $startdate = date('Y-m-d');
    var_dump($startdate);
    $query4= $pdo->prepare("INSERT INTO `listcars`(`startingprice`,`startdate`,`enddate`,`id_cars`) VALUES (:startingprice,:startdate,:enddate,6)");
    $query4->bindValue(":startingprice", $_POST["startingprice"],PDO::PARAM_INT);
    $query4->bindValue(":enddate", $_POST["enddate"],PDO::PARAM_STR);
    $query4->bindValue(":startdate", $startdate ,PDO::PARAM_STR);
   
    $result4=$query4->execute();
    var_dump($result4);


    
    
    };

    function verifPostAnnonce(){
       
   
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($_POST["submitAnnonce"]){
                
                return true;
              
            } else {
                return false;
              
            }
        }
    };
    verifPostAnnonce();
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
    <h1>Poster une annonce</h1>
</header>

<section>
    <form action="formulaireAnnonce.php" method="POST">
     <input placeholder="Prix de départ" type="text" name="startingprice">
     <label for="">Fin des enchères <input type="date" name="enddate"></label>
     <input type="submit" value="Poster mon annonce" name="submitAnnonce">
    </form>
    <?php if(verifPostAnnonce()){?>
        <p>Votre annonce est en ligne</p>
        <?php }; ?>
</section>
</body>
</html>

<style scopted>
form{
    display: flex;
    flex-direction: column;
    align-items: center;
}

input{
    width: 300px;
    margin: 10px;
}
</style>