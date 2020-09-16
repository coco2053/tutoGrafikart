<?php
require_once('header.php');

$username = null;
if(isset($_GET["action"]) && $_GET['action'] == 'deconnecter') {
    unset($_COOKIE['username']);
    setcookie('username','', time() -10);
}
if(isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
}
if(isset($_POST["username"])) {
    setcookie('username', $_POST["username"]);
    $username = $_POST["username"];
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<?php if ($username): ?>
    <h1>Bonjour <?= htmlentities($username) ?></h1>
    <a href="cookie.php?action=deconnecter">Se déconnecter</a>
<?php else: ?>
    <form method="post">
        <div class="form-control">
            <label for="username">Entrez votre nom d'utilisateur</label>
            <input type="text" name="username">

        <button type="submit">Valider</button>
        </div>
    </form>
<?php endif ?>
<?php
require_once('footer.php');
