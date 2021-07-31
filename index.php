<?php
require "functions/connexion.php";
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
$db = getConnexion();

// Compte du nombre de posts
$query = $db->prepare(
    "SELECT COUNT(*)
    FROM posts"
);
$query->execute();
$totalPosts = $query->fetchAll();

// Récupérer de la BDD les informations du post créé précédemment, pour l'afficher avec les autres posts sur l'accueil
// $page;

$query = $db->prepare(
    "SELECT p.title, p.content, p.creation_date, u.username, c.name
    FROM posts p
    INNER JOIN users u ON u.id = p.user_id
    INNER JOIN categories c ON c.id = p.category_id
    ORDER BY p.creation_date DESC"
);
$query->execute();
$newPost = $query->fetchAll();

// $nbrPostsPerPage = 10;
// $nbrPages = ceil($totalPosts[0]["COUNT(*)"] / $nbrPostsPerPage);
// $offset = $nbrPostsPerPage * ($page - 1);



// echo '<pre>';
// var_dump($totalPosts);
// echo '</pre>';
// echo "Nombre total de pages : " . $totalPosts;


// LIMIT 10 OFFSET " . $offset













$template = "templates/index.phtml";
require "templates/layout.phtml";