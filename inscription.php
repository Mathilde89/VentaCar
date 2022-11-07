<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Inscription au site VentaCar</h2>
    <form action="connexion.php" method="post">
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name="firstname">

        <label for="name">Nom</label>
        <input type="text" id="name" name="nom">

        <label for="email">Email</label>
        <input type="email" id="email" name="email">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">


        <input type="submit" value="submitInscription">
    </form>
</body>
</html>