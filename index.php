<?php
require "functions/connexion.php";
require "functions/sessionStart.php";
$db = getConnexion();

// Compte du nombre de posts
$query = $db->prepare(
    "SELECT COUNT(*)
    FROM posts"
);
$query->execute();
$totalPosts = $query->fetchAll();

// Récupérer de la BDD les informations du post créé précédemment, pour l'afficher avec les autres posts sur l'accueil

// $query = $db->prepare(
//     "SELECT p.title, p.content, p.creation_date, u.username, c.name
//     FROM posts p
//     INNER JOIN users u ON u.id = p.user_id
//     INNER JOIN categories c ON c.id = p.category_id
//     ORDER BY p.creation_date DESC"
// );
// $query->execute();
// $newPost = $query->fetchAll();

// Pour la pagination, j'ai besoin de :
// - connaître la page sur laquelle je me trouve
// - connaître le nombre total d'articles
// - connaître le nombre d'articles par page
// - connaître le nombre de pages en fonction des limites par page
// Sur la page d'accueil, je souhaite qu'à chaque page apparaisse "x" articles. Pour cela, je dois récupérer les informations relatives à chaque post, à savoir : 
    // posts => title, content, user_id, creation_date, category_id
// et les importer de la BDD en imposant une limite (LIMIT) et un offset (pour la découpe)
$page;

if (!isset($_GET["page"])){
    $page = 1;
}
else {
    $page = $_GET["page"];
};

$pagePrecedente = $page - 1;
$pageSuivante = $page + 1;

$totalArticles = $totalPosts[0]["COUNT(*)"];
$articlesParPage = 5;
$nbrPages = ceil($totalArticles / $articlesParPage);
$offset = $articlesParPage * ($page - 1);
// echo "Nombre de pages : " . $nbrPages;

$query = $db->prepare(
    "SELECT p.title, p.content, p.creation_date, u.username, c.name
    FROM posts p
    INNER JOIN users u ON u.id = p.user_id
    INNER JOIN categories c ON c.id = p.category_id
    ORDER BY p.creation_date DESC
    LIMIT " . $articlesParPage . " OFFSET " . $offset
);
$query->execute();
$allPosts = $query->fetchAll();









$template = "templates/index.phtml";
require "templates/layout.phtml";