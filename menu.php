<?php 
session_start();

    if(!isset($_SESSION["id"])){
        $menu = [
    
            "index.php" => "Acceuil",
            "connexion.php" => "Se connecter",
            "inscription.php" => "S'inscrire"
        
        ];
        
    }else{
        $menu = [
            "index.php" => "Acceuil",
            "formulaireVoiture.php" => "Enregistrer ma voiture",
            "formulaireAnnonce.php" => "Créer une annonce",
            "deconnexion.php" => "Se déconnecter"
        ];
        
    }




function afficherMenu($menu)
{
    
    foreach ($menu as $key => $value) {
        echo '<li><a href="'.$key.'">'.$value.'</a> </li>';
    }
}
?>