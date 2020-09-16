<?php
require_once('header.php');
$lines = file('files/pizza.tsv');
foreach($lines as $k => $line) {
    $lines[$k] = explode("\t", trim($line));
}
?>
<h1>Menu</h1>
<?php foreach($lines as $line): ?>
    <?php if(count($line) === 1): ?>
        <h2><?= $line[0] ?></h2>
    <?php else: ?>
        <div class="row">
        <div class="col-sm-8">
        <p>
            <strong>
             <?= $line[0] ?> - <?= $line[2] ?> €</strong><br>
             <?= $line[1] ?>
        </p>
    </div>
</div>
<?php endif ?>
<?php endforeach ?>
<?php
require_once('footer.php');
?>
