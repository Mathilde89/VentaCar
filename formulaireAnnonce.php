<?php
// var_dump($_POST);
require __DIR__."/pdo.php";
require __DIR__."/menu.php";
require __DIR__."/session.php";
require __DIR__."/classes/CarsClass.php";
require __DIR__."/classes/ListCarsClass.php";

$query2 = $pdo->prepare("SELECT * FROM cars WHERE user_id=:user_id");
$query2->bindValue(":user_id", $_SESSION['id'], PDO::PARAM_INT);
$query2->execute();
$cars = $query2->fetchAll(PDO::FETCH_ASSOC);




// var_dump($cars);

if (isset($_POST["submitCar"])) {

    $ajoutCar= new Cars($_POST["model"],$_POST["powerful"],$_POST["year"],$_POST["description"],$_SESSION["id"]);
    $postAuction=$ajoutCar->saveCard($pdo);
 
    // $query3 = $pdo->prepare("INSERT INTO `cars`(`model`, `powerful`, `year`, `description`,`user_id`) VALUES (:model,:powerful,:annee,:description,3)");
    // $query3->bindValue(":model", $_POST["model"], PDO::PARAM_STR);
    // $query3->bindValue(":powerful", $_POST["powerful"], PDO::PARAM_INT);
    // $query3->bindValue(":annee", $_POST["year"], PDO::PARAM_INT);
    // $query3->bindValue(":description", $_POST["description"], PDO::PARAM_STR);

    // $result3 = $query3->execute();
    // var_dump($result3);

};


if (isset($_POST["submitAnnonce"])) {
    $startdate2 = date('Y-m-d');

    $ajoutAnnonce = new ListCars($_POST["startingprice"],$startdate2,$_POST["enddate"],$_POST["startingprice"],$_POST["id_cars"]);
   
    $postAnnonce=$ajoutAnnonce->save($pdo);
       
    // var_dump($startdate);
    // $query4 = $pdo->prepare("INSERT INTO `listcars`(`startingprice`,`startdate`,`enddate`,`sellingprice`, `id_cars`) VALUES (:startingprice,:startdate,:enddate,:startingprice,:id_cars)");
    // $query4->bindValue(":startingprice", $_POST["startingprice"], PDO::PARAM_INT);
    // $query4->bindValue(":enddate", $_POST["enddate"], PDO::PARAM_STR);
    // $query4->bindValue(":startdate", $startdate, PDO::PARAM_STR);
    // $query4->bindValue(":id_cars", $_POST["id_cars"], PDO::PARAM_INT);
};

function verifPostAnnonce()
{


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["submitAnnonce"])) {

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
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>

<body>
    <header>

        <?php
        afficherMenu($menu);
        ?>

        <h1>Poster une annonce</h1>
    </header>

    <section>
        <form action="formulaireAnnonce.php" method="POST">
            <select name="id_cars" placeholder="cars" id="">
                <?php foreach ($cars as $key => $value) { ?>

                    <option name="id_cars" value="<?= $value["id"] ?>"><?php echo $value["model"] ?></option>
                <?php }; ?>

            </select>
            <input placeholder="Prix de départ" type="text" name="startingprice">
            <label for="">Fin des enchères <input type="date" name="enddate"></label>
            <input type="submit" value="Poster mon annonce" name="submitAnnonce">
        </form>
        <?php if (verifPostAnnonce()) { ?>
            <p>Votre annonce est en ligne</p>
        <?php }; ?>
    </section>
</body>

</html>

<style scopted>
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input {
        width: 300px;
        margin: 10px;
    }
</style>