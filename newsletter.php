<?php
require_once('header.php');
?>

<form method="post">
    <div class="form-control">
        <label for="jour">Entrez votre adresse email</label>
        <input type="text" name="email">

    <button type="submit">S'abonner</button>
    </div>
</form>

<?php
if(isset($_POST["email"])) {
    $email = $_POST["email"];
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email = $_POST["email"].'\n';
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y m d');
        file_put_contents($file, $email. PHP_EOL, FILE_APPEND);
        echo 'votre email a bien été enregistré';
    } else {
        echo 'adresse non valide !';
    }
}
require_once('footer.php');
?>