<?php
require_once('header.php');
$age = null;
if(!empty($_POST['birthdate'])){
    setcookie('birthdate', $_POST['birthdate']);
    $_COOKIE['birthdate'] = $_POST['birthdate'];
}
if(!empty($_COOKIE['birthdate'])){
    $sec = time() - strtotime($_COOKIE['birthdate']);
    $age = floor((($sec /3600) /24) /365);
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<?php if ($age >= 18): ?>
    <h1>Bonjour et bienvenue sur le site résérvé aux adultes !</h1>
<?php elseif ($age !== null): ?>
    tu es mineur, tu ne peux pas entrer !
<?php else: ?>
    <form method="post">
        <div class="form-control">
            <label for="birthdate">Entrez votre date de naissance</label>
            <input type="date" value="2000-01-01" min="1900-01-01" max="<?= date('Y-m-d') ?>" name="birthdate">
        <button type="submit">Valider</button>
        </div>
    </form>
<?php endif ?>
<?php
require_once('footer.php');
?>
