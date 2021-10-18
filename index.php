<?php

/* traitement de la bdd (connexion et extraction) */

require_once "_connec.php";

$pdo = new PDO(DSN, USER, PASS);

/* traitement du formulaire */

if (isset($_POST["lastname"]) && isset($_POST["firstname"])) {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);

    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statement->execute();
}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des amis</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Liste des amis</h1>
    <ul>
        <?php
        foreach ($friends as $friend) {
            echo "<li>" . htmlentities($friend["firstname"]) . " <b>" . htmlentities($friend["lastname"]) . "</b></li>" . PHP_EOL;
        }
        ?>
    </ul>
    <h1>Ajouter un ami</h1>
    <form method="post">
        <div>
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
        <div>
            <label for="firtsname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>
        <div>
            <input type="submit" value="Envoyer votre message">
        </div>
    </form>
</body>

</html>