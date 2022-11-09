<?php 
    if($id_session = session_id()=== null){
        $menu = [
    
            "index.php" => "Acceuil",
            "connexion.php" => "Se connecter",
            "inscription.php" => "S'inscrire"
        
        ];
        
    }else{
        $menu = [
            "index.php" => "Acceuil",
            "formulaireVoiture.php" => "Enregistrer ma voiture",
            "formulaireAnnonce.php" => "Créer une annonce"
        ];
        
    }




function afficherMenu($menu)
{
    
    foreach ($menu as $key => $value) {
        echo '<li><a href="'.$key.'">'.$value.'</a> </li>';
    }
}
?>

<style>
    li{
        list-style: none;
    }
</style>