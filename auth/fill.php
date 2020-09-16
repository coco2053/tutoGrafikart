<?php
$pdo = new PDO('mysql:host=localhost;dbname=auth;charset=utf8', 'root', '',  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$query = $pdo->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, ?)");
$query->execute([
    "admin",
    password_hash("admin", PASSWORD_BCRYPT),
    "admin",
]);
$query->execute([
    "user",
    password_hash("user", PASSWORD_BCRYPT),
    "user",
]);
echo "done";
