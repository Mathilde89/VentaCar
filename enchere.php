<?php 
require __DIR__."/pdo.php";
if (isset($_GET["id"])){


    // JOIN users ON auctions.users_id=users.id JOIN listcars ON auctions.listcars_id=listcars.id_cars
    $query = $pdo->prepare("SELECT * FROM `listcars` WHERE id=:id");
    $query->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
    $query->execute();
    $cars = $query->fetch(PDO::FETCH_ASSOC);
    var_dump($cars);


    if(isset($_POST["submitAuction"])){
        $startDatePost= date('Y-m-d');
    
        $query3= $pdo->prepare("INSERT INTO `auctions` (`auctionprice`, `auctiondate`,`listcars_id`,`users_id` ) VALUES (:auctionprice, :auctiondate, :listcars_id, :users_id)");
        //INSERT INTO `auctions` (`id`, `auctionprice`, `auctiondate`, `listcars_id`, `users_id`) VALUES (NULL, ':auctionprice', 'auctiondate', ' :listcars_id', ':users_id');
        $query3->bindValue(":auctionprice", $_POST["auctionprice"],PDO::PARAM_INT);
        $query3->bindValue(":auctiondate",$startDatePost,PDO::PARAM_STR);
        $query3->bindValue(":listcars_id", $_POST["listcars_id"],PDO::PARAM_INT);
        $query3->bindValue(":users_id", $_POST["users_id"],PDO::PARAM_INT);
        $postAuction=$query3->execute();
        
    };
    $query2= $pdo->prepare("SELECT `auctionprice`,`auctiondate`,`listcars_id`,`users_id`
    FROM `auctions`
    JOIN listcars
    ON auctions.listcars_id=listcars.id
    WHERE auctions.listcars_id=:id");
    // WHERE auctions.id=:id
    $query2->bindValue(':id',$_GET["id"],PDO::PARAM_INT);
    $query2->execute();
    $auctions = $query2->fetchAll(PDO::FETCH_ASSOC);
    $longeur= count($auctions);

   



   function getNoAuction(){
    echo '<h2>Aucun offre proposer</h2>';
    echo '<p>Voulez vous proposer un offre ?</p>';


   }

 
    


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

    <ul>
        <li>Prix de départ: <?= $cars["startingprice"] ?></li>
        <li>Début de l'enchere: <?= $cars["startdate"] ?></li>
        <li>Fin de l'enchere: <?= $cars["enddate"] ?></li>
        <li>Prix de reserve: <?= $cars["sellingprice"] ?></li>

        </ul>
            <?php if ($longeur>0){?>
                    <p>Enchere</p>
                <?php foreach($auctions as $key => $value){ ?>
                    <?php ?>
                    <ul>
                
                    <li>Offre déposé:<?=$value["auctionprice"]?></li>
                    
                    </ul>

                <?php }?>

                <form action="enchere.php?id=<?=$_GET["id"]?>" method="post">
                
                <label for="auctionprice">Proposer un prix:</label>
                <input type="text" id="auctionprice" name="auctionprice">

                <label for="listcars_id">List car:</label>
                <input type="text" id="listcars_id" name="listcars_id">

                <label for="users_id">User ID:</label>
                <input type="text" id="users_id" name="users_id">




                <input type="submit" value="encherire" name="submitAuction">
            </form>
        


            <?php }else{?>
                    <?php
                        getNoAuction()
                        ?>
                        <form action="enchere.php?id=<?=$_GET["id"]?>" method="post">
                
                <label for="auctionprice">Proposer un prix:</label>
                <input type="text" id="auctionprice" name="auctionprice">

                <label for="listcars_id">List car:</label>
                <input type="text" id="listcars_id" name="listcars_id">

                <label for="users_id">User ID:</label>
                <input type="text" id="users_id" name="users_id">




                <input type="submit" value="encherire" name="submitAuction">
            </form>
                <?php } ?>



</body>

</html>