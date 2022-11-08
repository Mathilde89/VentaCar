<?php
// var_dump($_POST);



function verifconnexion(){
    require __DIR__."/pdo.php";


    // Insert la personne qui vient de s'inscrire dans la base de donnée
    if(isset($_POST["submitConnexion"])){
        $query= $pdo->prepare("INSERT INTO `users` (`name`, `firstname`, `email`, `password`) VALUES (:name, :firstname, :email, :password)");
        $query->bindValue(":name", $_POST["name"],PDO::PARAM_STR);
        $query->bindValue(":firstname", $_POST["firstname"],PDO::PARAM_STR);
        $query->bindValue(":email", $_POST["email"],PDO::PARAM_STR);
        $query->bindValue(":password", $_POST["password"],PDO::PARAM_STR);
        
        $result=$query->execute();
    
        } ;


        // Fonction de vérification du bon mot de passe

            // Reccupère tous les users
        $query2=$pdo->prepare("SELECT * FROM users");
        $query2->execute();
        $users=$query2->fetchAll(PDO::FETCH_ASSOC);
        var_dump($users);
            // Pour tester si bon mot de passe - A modifier après pour crypter le mdp

         
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        foreach($users as $key => $value){
            
            if ($value["email"]==$_POST["email"]){
                if($value["password"]==$_POST["password"]){
                
                    // header("Location: http://localhost/ventacar/index.php");
                    
                    // Démarre une nouvelle session
                    // session_start(); 
                    
                    //Mets à dispo les informations de connexion
                    $_SESSION['id'] = $value["id"];
                    $_SESSION['nom'] = $value["name"];
                    $_SESSION['prenom'] = $value["firstname"];
                    $_SESSION['email'] = $value["email"];
                    $_SESSION['password'] = $value["password"];

                    $id_session = session_id();
                    var_dump($_COOKIE['PHPSESSID']);
                    var_dump($id_session);
                    var_dump($_SESSION);
                    return true;
                    // echo "Connexion réussie";
                  
                    
                    
                };
                
            } else {
                // echo "Mot de passe ou email incorrect";
                
                return false;
              
            }
            
        }

    }



};
