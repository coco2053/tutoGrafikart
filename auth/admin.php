<?php
require_once('Entity/Auth.php');
$auth = new Auth();
$user = $auth->user();
if($user == null || $user->role != "admin") {
    header('Location: login.php?forbid=1');
    exit();
}
?>
Réservé à l'admin