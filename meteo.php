<?php
require_once('Entity\OpenWeather.php');
require_once('header.php');

$weather = new Openweather('2087d41e736007a1aa89b3a689087d36');
$forecast = null;
$error = null;
try {
    $forecast = $weather->getForecast('Aix-en-Provence');
} catch(Exception $e) {
    $error = $e->getMessage();
}
?>

<?php if($error) : ?>
    <div class="alert alert-danger"> <?= $error ?> </div>
<?php else: ?>
    <h1>Meteo à Aix-en-Provence: </h1>
    <?php foreach($forecast as $day): ?>
        <h2><?= $day['date']->format('d/m/Y à H:i') ?></h2>
        <b>temps : </b> <?= $day['description'] ?><br>
        <b>température : </b> <?= $day['temp'] ?><br>
    <?php endforeach ?>
<?php endif ?>

<?php
require_once('footer.php');
?>
