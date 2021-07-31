<?php
// require "connexion.php";

function detailUser($username): array|bool
{
    $db = getConnexion();

    $query = $db->prepare(
        "SELECT id, username, password, email, creation_date
        FROM users
        WHERE username = ?"
    );
    $query->execute(
        [$username]
    );
    $user = $query->fetch();
    return $user;
}