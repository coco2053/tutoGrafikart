<?php
require_once('header.php');

$aDeviner = 150;
?>
<?php if(isset($_GET['chiffre'])): ?>
    <?php if($_GET['chiffre'] < $aDeviner): ?>
        Plus grand!
    <?php elseif($_GET['chiffre'] > $aDeviner): ?>
        Plus petit !
    <?php else: ?>
        Bingo ! c'est bien <?= $aDeviner ?>
    <?php endif ?>
<?php endif ?>
<form action="">
    <input type="number" name="chiffre" value="<?php if(isset($_GET["chiffre"])) echo htmlentities($_GET["chiffre"])?>" placeholder="entre 0 et 1000">
    <button type="submit">Deviner</button>
</form>
<?php
require_once('footer.php');