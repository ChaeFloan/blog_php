<?php
require "functions/connexion.php";
require "functions/user.php";
require "functions/sessionStart.php";

$db = getConnexion();

// Récupération des données <input>
if(!empty($_POST)){
    // On récupère les données de l'utilisateur qui se connecte
    $user = detailUser($_POST["username"]);
    // echo '<pre>';
    // var_dump($user);
    // echo '</pre>';

    // Si : username inconnu
    // if($_POST["username"] != $user)

    // Si : password erroné


    // Sinon
    // On ouvre sa session utilisateur
    $_SESSION["auth"] = [
        "id" => $user["id"],
        "username" => $user["username"],
        "password" => $user["password"],
        "email" => $user["email"],
        "creation_date" => $user["creation_date"]
    ];

    header("Location: index.php");
    exit();    
}









$template = "templates/connexionUser.phtml";
require "templates/layout.phtml";