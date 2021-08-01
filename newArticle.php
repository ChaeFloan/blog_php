<?php
require "functions/connexion.php";
require "functions/sessionStart.php";

$db = getConnexion();


// Récupérer les données relatives à la "category" pour les ajouter au <select> html
$query = $db->prepare(
    "SELECT id, name
    FROM categories"
);
$query->execute();
$categories = $query->fetchAll();

// Ici on relie le username avec le user_id de chaque post
$query = $db->prepare(
    "SELECT u.username
    FROM users u
    INNER JOIN posts p ON p.user_id = u.id"
);
$query->execute();

//Enregistrer les infos renseignées dans les input, dans la BDD
if(!empty($_POST)){
    $query = $db->prepare(
        "INSERT INTO posts (title, content, category_id, user_id, creation_date)
        VALUES (?, ?, ?, ?, NOW())"
    );
    $query->execute([
        $_POST["title"],
        $_POST["content"],
        $_POST["category_id"],
        $_SESSION["auth"]["id"]
    ]);    
    header("Location: index.php");
    exit();
}







$template = "templates/newArticle.phtml";
require "templates/layout.phtml";