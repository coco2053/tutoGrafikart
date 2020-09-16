<?php
require_once('header.php');
require_once('compteur.php');
session_start();
$password = '$2y$10$5Ae7fw/fO.06UTcjyOzwnujZ/wb3BSdY6cTH21udwD3SnWZHGN0.q';
$connected = false;
$isWrong = false;
$annee = (int)date('Y');
$annee_selection = empty($_GET['annee']) ? null : $_GET['annee'];
$mois_selection = empty($_GET['mois']) ? null : $_GET['mois'];
if($annee_selection && $mois_selection) {
    $total = compteur_mois($annee_selection, $mois_selection);
    $detail = compteur_details_mois($annee_selection, $mois_selection);
} else {
    $total = compteur(true);
}
$mois = [
        '01' => 'Janvier',
        '02' => 'Février',
        '03' => 'Mars',
        '04' => 'Avril',
        '05' => 'Mai',
        '06' => 'Juin',
        '07' => 'Juillet',
        '08' => 'Aout',
        '09' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Décembre',
];
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] == 'coco' && password_verify($_POST['password'],$password)) {
        $_SESSION["connected"] = true;
        $isWrong = false;
    } else {
        $_SESSION["connected"] = false;
        $isWrong = true;
    }
}
?>

<div class="row">
<?php if(isset($_SESSION["connected"]) && $_SESSION["connected"]): ?>
    <div class="col-md-4">
        <div class="list-group">
            <?php for($i = 0; $i < 5; $i++): ?>
            <a class="list-group-item <?= $annee - $i == $annee_selection ? 'active' : '' ?>" href="dashboard.php?annee=<?= $annee - $i ?>"><?= $annee - $i ?></a>
            <?php if ($annee - $i == $annee_selection): ?>
            <div class="list-group">
            <?php foreach($mois as $numero => $nom): ?>
                <a class="list-group-item <?= $numero == $mois_selection ? 'active' : '' ?>" href="dashboard.php?annee=<?= $annee_selection ?>&mois=<?= $numero ?>" >
                    <?= $nom ?>
                </a>
                <?php endforeach ?>
            </div>
            <?php endif ?>
            <?php endfor ?>


    <div class="col-md-8">
        <div class="card">
            <div class="card-body mb-4">
                <strong style="font-size:3em"><?= $total ?> <br>
                Visites</strong>
            </div>
            <?php if(isset($detail)):?>
                <h2>Détails des visites pour le mois</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Nombre de visites</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($detail as $line): ?>
                    <tr>
                        <td><?= $line['jour'] ?></td>
                        <td><?= $line['visites'] ?> visites</td>
                    </tr>
                    <?php endforeach ?>
                    </tbody>

                </table>
            <?php endif ?>
        </div>
    </div>

    <?php else :?>

    <div class="md-12 ml-4">
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
    </div>
    <?php if($isWrong): ?>
        <div class="alert alert-danger" role="alert">
            Mauvais nom d'utilisateur ou mot de passe !
        </div>
    <?php endif ?>
    <?php endif ?>

    </div>
    </div>
</div>
<?php
require_once('footer.php');
?>
