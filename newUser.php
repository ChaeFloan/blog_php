<?php
require "functions/connexion.php";
require "functions/sessionStart.php";

$db = getConnexion();


if(!empty($_POST)){
    //Enregistrer les infos renseignées dans les input dans la BDD
    $query = $db->prepare(
        "INSERT INTO users (username, email, password, creation_date)
        VALUES (?, ?, ?, NOW())"
    );
    $query->execute([
        $_POST["username"],
        $_POST["email"],
        password_hash($_POST["password"], PASSWORD_BCRYPT)
    ]);

    header("Location: connexionUser.php");
    exit();
}












$template = "templates/newUser.phtml";
require "templates/layout.phtml";