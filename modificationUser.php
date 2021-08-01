<?php
require "functions/connexion.php";
require "functions/user.php";
require "functions/sessionStart.php";

$db = getConnexion();
$passwordExisting;

// Si les champs password et newpassword sont renseignés
if(!empty($_POST["password"]) && !empty($_POST["newpassword"])){
    // Si les champs sont identiques
    if($_POST["password"] === $_POST["newpassword"]){
        $passwordExisting = "Votre nouveau mot de passe est identique à votre mot de passe actuel !";
    }
    else{
        $query = $db->prepare(
            "UPDATE users 
            SET password = '" . $_POST["newpassword"] . "'
            WHERE id = ?"
        );
        $query->execute(
            $_SESSION["auth"]["id"]
        );       
    };
};

// Faire la mise à jour de chacune des informations renseignées dans les input
// Si les champs username et email sont renseignés
if(!empty($_POST["username"]) && !empty($_POST["email"])){
    $query = $db->prepare(
        "UPDATE users 
        SET username = '" . $_POST["username"] . "', email = '" . $_POST["email"] . "'
        WHERE id = ?"
    );
    $query->execute(
        [$_SESSION["auth"]["id"]]
    );
    // Récupération des données user depuis SQL
    $user = detailUser($_POST["username"]);

    $_SESSION["auth"]["username"] = $user["username"];
    $_SESSION["auth"]["email"] = $user["email"];
    $_SESSION["auth"]["password"] = password_hash($user["password"], PASSWORD_BCRYPT);


    header("Location: userProfil.php");
    exit();
};








$template = "modificationUser.phtml";
require "templates/layout.phtml";