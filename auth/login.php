<?php
require_once('Entity\Auth.php');
$auth = new Auth();
$error = null;
session_start();
if($_GET['forbid']) $error = 'Veuillez vous connecter avec un compte ayant les droits necessaires à la consulatation de cette page';
if(isset($_POST['username'])) {
    $user = $auth->login($_POST['username'],$_POST['username']);
    if($user != null) {
        header('Location: index.php?connected=1');
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorect !";
    }
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <form method="POST">
        <div class="form-group">
            <label class="form-check-label" for="username">Nom d'utilisateur</label>
            <input name="username" class="form-control" type="text">
        </div>
        <div class="form-group">
            <label class="form-check-label" for="password">Mot de passe</label>
            <input name="password" class="form-control" type="password">
        </div>
        <button class="btn btn-primary" type="submit">Se connecter</button>
    </form>
<?php if(!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
       <?= $error ?>
    </div>
<?php endif ?>

