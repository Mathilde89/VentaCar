<?php 

    $menu = [

        "index.php" => "Acceuil",
        "connexion.php" => "Se connecter",
        "inscription.php" => "S'inscrire"
    
    ];

    // $menu = [
    //     "index.php" => "Acceuil",
    //     "formulaireVoiture.php" => "Enregistrer ma voiture",
    //     "formulaireAnnonce.php" => "Créer une annonce"
    // ];


function afficherMenu($menu)
{
    
    foreach ($menu as $key => $value) {
        echo '<li><a href="'.$key.'">'.$value.'</a> </li>';
    }
}
?>