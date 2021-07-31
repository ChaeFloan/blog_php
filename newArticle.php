<?php
require "functions/connexion.php";
$db = getConnexion();

// Récupérer les données relatives à la "category" pour les ajouter au <select> html
$query = $db->prepare(
    "SELECT id, name
    FROM categories"
);
$query->execute();
$categories = $query->fetchAll();

// echo '<pre>';
// var_dump($categories);
// echo '</pre>';

$query = $db->prepare(
    "SELECT u.username
    FROM users u
    INNER JOIN posts p ON p.user_id = u.id"
);
$query->execute();


//Enregistrer les infos renseignées dans les input, dans la BDD
if(!empty($_POST)){
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    $query = $db->prepare(
        "INSERT INTO posts (title, content, category_id, user_id, creation_date)
        VALUES (?, ?, ?, ?, NOW())"
    );
    $query->execute([
        $_POST["title"],
        $_POST["content"],
        $_POST["category_id"],
        $_SESSION["auth"]["user_id"]
    ]);    
    header("Location: index.php");
    exit();
}







$template = "templates/newArticle.phtml";
require "templates/layout.phtml";