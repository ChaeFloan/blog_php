<?php
require "functions/connexion.php";
require "functions/user.php";
$db = getConnexion();

if(session_status() === PHP_SESSION_NONE){
    session_start();
};

$query = $db->prepare(
    "SELECT p.title, p.content, p.creation_date, u.username, c.name
    FROM posts p
    INNER JOIN users u ON u.id = p.user_id
    INNER JOIN categories c ON c.id = p.category_id
    WHERE u.username = ?
    ORDER BY p.creation_date DESC"
);
$query->execute(
    [$_SESSION["auth"]["username"]]
);
$newPost = $query->fetchAll();

// echo '<pre>';
// var_dump($user);
// echo '</pre>';













$template = "templates/userProfil.phtml";
require "templates/layout.phtml";