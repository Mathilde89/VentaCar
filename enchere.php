<?php 
require __DIR__."/pdo.php";
require __DIR__."/session.php";
require __DIR__."/classes/AuctionsClass.php";


function afficheWinner($pdo){
    $query4 = $pdo->prepare("SELECT users.firstname, users.name,  MAX(`auctionprice`) as max  FROM `auctions` 
    JOIN users
    ON auctions.users_id=users.id
    WHERE `listcars_id` = :id;" );
    $query4->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
    $query4->execute();
    $winner = $query4->fetch(PDO::FETCH_ASSOC);
    echo "Nom :".$winner["name"]." Prénom :".$winner["firstname"];

}

function verifAuction($pdo,$max, $cars){
   
    
   if(($_POST["auctionprice"]>$cars["startingprice"]) && $_POST["auctionprice"]>$max){
    

    if (isset($_POST["submitAuction"])) {
        $startDatePost = date('Y-m-d');
        $auction = new Auctions($_POST["auctionprice"],$startDatePost,$_GET["id"],$_SESSION["id"]);
        $postAuction=$auction->save($pdo);
      
        // $query3 = $pdo->prepare("INSERT INTO `auctions` (`auctionprice`, `auctiondate`,`listcars_id`,`users_id` ) VALUES (:auctionprice, :auctiondate, :listcars_id, :users_id)");
        // //INSERT INTO `auctions` (`id`, `auctionprice`, `auctiondate`, `listcars_id`, `users_id`) VALUES (NULL, ':auctionprice', 'auctiondate', ' :listcars_id', ':users_id');
        // $query3->bindValue(":auctionprice", $_POST["auctionprice"],PDO::PARAM_INT);
        // $query3->bindValue(":auctiondate",$startDatePost,PDO::PARAM_STR);
        // $query3->bindValue(":listcars_id", $_GET["id"],PDO::PARAM_INT);
        // $query3->bindValue(":users_id", $_SESSION["id"],PDO::PARAM_INT);
        // $postAuction=$query3->execute();
        
    } else {
        echo "Enchère trop basse";
    };
   }
    
}

if (isset($_GET["id"])) {

    $query1 = $pdo->prepare("SELECT MAX(`auctionprice`) as max FROM `auctions` WHERE `listcars_id` = :id;");
    $query1->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
    $query1->execute();
    $maxi = $query1->fetch(PDO::FETCH_ASSOC);
    if($maxi["max"]==null){
        $max=0;
    }else{
        $max=$maxi["max"];
    }


    
    // JOIN users ON auctions.users_id=users.id JOIN listcars ON auctions.listcars_id=listcars.id_cars
    $query = $pdo->prepare("SELECT * FROM `listcars` WHERE id=:id");
    $query->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
    $query->execute();
    $cars = $query->fetch(PDO::FETCH_ASSOC);
    
    if (isset($_POST["submitAuction"])) {
        
        verifAuction($pdo,$max, $cars);
    }



    $query2 = $pdo->prepare("SELECT `auctionprice`,`auctiondate`,`listcars_id`,`users_id`
    FROM `auctions`
    JOIN listcars
    ON auctions.listcars_id=listcars.id
    WHERE auctions.listcars_id=:id");
    // WHERE auctions.id=:id
    $query2->bindValue(':id', $_GET["id"], PDO::PARAM_INT);
    $query2->execute();
    $auctions = $query2->fetchAll(PDO::FETCH_ASSOC);
    $longeur = count($auctions);
    

    



} else {
    echo "Erreur lors du chargement de la page";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tenor+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.scss">
    <title>Document</title>
</head>

<body>

    <header>
        <?php
        include __DIR__ . "/menu.php";
        afficherMenu($menu);
        ?>

    </header>
    <div class="infosauction">

        <h3>Informations de vente : </h3>
        <ul>
            <li>Prix de départ: <?= $cars["startingprice"] ?>€</li>
            <li>Début de l'enchere: <?= $cars["startdate"] ?></li>
            <li>Fin de l'enchere: <?= $cars["enddate"] ?></li>
            
            
        </ul>
    </div>
    <div class="listauctions">

        <?php if ($longeur > 0) { ?>
            <h4> Enchères</h4>
            <?php foreach ($auctions as $key => $value) { ?>
                <?php ?>
                <ul>

                    <li>Offre déposée : <?= $value["auctionprice"] ?>€</li>
                    
                </ul>
                
                <?php } ?>
                
                
                <?php } else { $init=true;?>
                    <p>Il n'a pas d'encheres en cours, soyez le premier à encherir!</p>
                    
                    <?php } ?>
                    
                    <?php if (isset($_SESSION["id"]) ) { // Si l'utilisateur est connecté
        if (date('Y-m-d')<$cars["enddate"]){ ?> <!--Date ok-->

<form action="enchere.php?id=<?= $_GET["id"] ?>" method="post">
    <label for="auctionprice">Proposer un prix:</label>
    <input type="number" id="auctionprice" name="auctionprice">
    <input type="submit" value="Encherir" name="submitAuction">
</form>

</div>
<?php if (isset($_POST["submitAuction"])) {;};


         } else { // la date est périmée ?> 
                <p>  La date est périmée vous ne pouvez plus faire d'enchères</p> 
                <p>Le nouveau propriétaire est 
                    <?php  afficheWinner($pdo); ?>
                </p>
            <?php };
  

        } else { // Si l'utilisateur n'est pas connecté ?> 
           <a href="connexion.php">Vous devez vous connecter pour pouvoir encherir</a>

            <?php }; ?>



</body>

</html>