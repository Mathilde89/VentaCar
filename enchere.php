<?php 
require __DIR__."/pdo.php";
if (isset($_GET["id"])){


    // JOIN users ON auctions.users_id=users.id JOIN listcars ON auctions.listcars_id=listcars.id_cars
    $query= $pdo->prepare("SELECT * FROM `listcars` WHERE id=:id");
    $query->bindValue(':id',$_GET["id"],PDO::PARAM_INT);
    $query->execute();
    $cars = $query->fetchAll(PDO::FETCH_ASSOC);
   
    
    

}else{
    echo "erreur";
}


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
    


        <ul>
            <?php foreach($cars as $key => $car){ ?>
            <li>Prix de départ:<?=$car["startingprice"]?></li>
            <li>Début de l'enchere:<?=$car["startdate"]?></li>
            <li>Fin de l'enchere:<?=$car["enddate"]?></li>
            <li>Prix de reserve: <?=$car["sellingprice"]?></li>
            <?php } ?>
            <p>Encheriseur</p>

   
                
               
            <!-- <li>Offre proposer par :<?=$cars["firstname"]." ".$cars["name"]?></li>
            <li>Date de l'offre : <?=$cars["auctiondate"]?></li>
            <li>D'un montant de : <?=$cars["auctionprice"]?></li> -->
            
        </ul>
    



</body>
</html>