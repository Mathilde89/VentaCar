<?php

//Reccupère les informations de l'utilisateur connecté
session_start();
 $id_session = session_id();
 var_dump($_COOKIE['PHPSESSID']);
 var_dump($id_session);
var_dump($_SESSION);

 ?>