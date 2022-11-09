<?php
// session_start();
// var_dump($_SESSION);

require __DIR__ . "/pdo.php";
require __DIR__."/session.php";

// JOIN cars ON listcars.id_cars=cars.id
$query = $pdo->prepare("SELECT listcars.startingprice,listcars.id,listcars.startdate,listcars.enddate,listcars.sellingprice,cars.model,cars.powerful,cars.year,cars.description FROM `listcars`JOIN cars ON listcars.id_cars=cars.id");
$query->execute();
$listcars = $query->fetchAll(PDO::FETCH_ASSOC);


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

    <h1>Nos annonces</h1>

    <?php foreach ($listcars as $key => $listcar) { ?>
        <ul>
            <li>Model :: <?= $listcar["model"] ?></li>
            <li>Puissance: <?= $listcar["powerful"] ?> chevaux fiscaux</li>
            <li>Année de mise en cerculation: <?= $listcar["year"] ?></li>
            <li>Déscription: <?= $listcar["description"] ?></li>
            <li>ID de lannonce<?= $listcar["id"] ?> </li>
            <a href="enchere.php?id=<?= $listcar["id"] ?>">Voir l'enchere</a>


        </ul>
    <?php } ?>


</body>

</html>

<style>
    nav {
        display: flex;
        background-color: black;
    }


    nav:last-child {
        display: flex;
    }
</style>