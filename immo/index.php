<?php
require('vendor/autoload.php');
use App\Entity\QueryBuilder;
use App\Entity\Table;
use App\Entity\NumberHelper;

$title = 'Tous les biens';
//On initialise la connexion Bdd
$pdo = new \PDO('mysql:host=localhost;dbname=immo;charset=utf8', 'root', '',[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                                                                             \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC]);
$query = (new QueryBuilder($pdo))->from('products');

//Recherche par ville
if(!empty($_GET['q'])) {
    $query
        ->where('city LIKE :city')
        ->setParam('city','%' . $_GET['q'] .'%');
}

$table = new Table($query, $_GET);
$table->sortable('id', 'name', 'city', 'price')
      ->format('price', function($value) {
    return NumberHelper::price($value);
    })
    ->columns([
        'id' => 'ID',
        'name' => 'Nom',
        'city' => 'Ville',
        'address' => 'Adresse',
        'price' => 'Prix'
    ]);

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Bastien Vacherand">
    <title>Liste des biens</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
    <h1><?= $title ?></h1>
    <form >
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Rechercher par ville" name="q" value="<?= htmlentities($_GET['q'] ?? null) ?>">
        </div>
        <button class="btn btn-primary mb-4">Rechercher</button>
    </form>
    <?php $table->render() ?>

</body>

</html>
