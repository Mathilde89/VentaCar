<?php
// session_start();
// var_dump($_POST);

require __DIR__ . "/pdo.php";
require __DIR__."/session.php";


function showAnnonce($pdo){

    // JOIN cars ON listcars.id_cars=cars.id
    $query = $pdo->prepare("SELECT listcars.startingprice,listcars.id,listcars.startdate,listcars.enddate,listcars.sellingprice,cars.model,cars.powerful,cars.year,cars.description FROM `listcars`JOIN cars ON listcars.id_cars=cars.id");
    $query->execute();
    $listcars = $query->fetchAll(PDO::FETCH_ASSOC);
    // Affichage des enchères terminées
    // var_dump($listcars);

    if($_POST["submitTri"]=="Enchères terminées"){
        
        foreach ($listcars as $key => $listcar) {
            if(date('Y-m-d')>$listcar["enddate"]){
                    echo "<li>Model : ".$listcar["model"]."</li>";
                    echo "<li>Puissance: ".$listcar["powerful"]."chevaux fiscaux</li>";
                    echo "<li>Année de mise en cerculation: ".$listcar["year"]."</li>";
                    echo "<li>Description: ".$listcar["description"]."</li>";
                    echo "<li>ID de lannonce ".$listcar["id"]."</li>";
                    echo '<a href="enchere.php?id='.$listcar["id"].">Voir l'enchere</a>";
                }
        
    
        }

    }else if($_POST["submitTri"]=="Enchères en cours"){
        foreach ($listcars as $key => $listcar) {
            if(date('Y-m-d')<=$listcar["enddate"]){
                    echo "<li>Model : ".$listcar["model"]."</li>";
                    echo "<li>Puissance: ".$listcar["powerful"]."chevaux fiscaux</li>";
                    echo "<li>Année de mise en cerculation: ".$listcar["year"]."</li>";
                    echo "<li>Description: ".$listcar["description"]."</li>";
                    echo "<li>ID de lannonce ".$listcar["id"]."</li>";
                    echo '<a href="enchere.php?id='.$listcar["id"].">Voir l'enchere</a>";
                }

    }
    } else{
        foreach ($listcars as $key => $listcar) {
                    echo "<li>Model : ".$listcar["model"]."</li>";
                    echo "<li>Puissance: ".$listcar["powerful"]."chevaux fiscaux</li>";
                    echo "<li>Année de mise en cerculation: ".$listcar["year"]."</li>";
                    echo "<li>Description: ".$listcar["description"]."</li>";
                    echo "<li>ID de lannonce ".$listcar["id"]."</li>";
                    echo '<a href="enchere.php?id='.$listcar["id"].">Voir l'enchere</a>";
                }

    }
    }
    



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <h1> <i class="fa-solid fa-gavel"></i> Nos annonces</h1>
    <div class="tri">

        <form action="index.php" method="post">
            
            <input class="choix" type="submit" name="submitTri" value="Tout">
            <input class="choix" type="submit" name="submitTri" value="Enchères terminées">
            <input class="choix" type="submit" name="submitTri" value="Enchères en cours">
        </form>
    </div>
    
    
        <ul>
        <?php if(isset($_POST["submitTri"])){showAnnonce($pdo);};?>
            


        </ul>
    


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