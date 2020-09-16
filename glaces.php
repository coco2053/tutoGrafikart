<?php
require_once('header.php');
require_once('config.php');
date_default_timezone_set('Europe/Paris');
$creneaux = creneaux_html(JOURS,CRENEAUX);
$heure = (int)date('G');
$heure2 = (int)($_POST['heure'] ?? date('N'));
$jour = (int)($_POST['jour'] ?? date('N')-1);
$creneauxDuJour = CRENEAUX[(int)date('N')-1];
$ouvert = in_creneaux($heure, $creneauxDuJour);
$color = $ouvert ? 'green' : 'red';
$parfums = [
        'fraise' => 4,
        'chocolat' => 3,
        'vanille' => 4
];
$cornets = [
    'pot' => 2,
    'cornet' => 3
];
$supplements = [
    'pépittes de chocolats' => 1,
    'chantilly' => 0.5
];
function select (string $name, $value, array $options) : string{
    $html_options = [];
    foreach($options as $k => $option) {
        $attributes = $k == $value ? 'selected' : '';
        $html_options[] = "<option value='$k' $attributes>$option</option>";
    }
    return "<select name='$name'>" . implode($html_options) .'</select>';
}
function show_ouvert(bool $ouvert) : string
{
    return $ouvert ? "<div class='alert alert-success'>Le magasin est ouvert</div>" : "<div class='alert alert-danger'>Le magasin est fermé</div>";
}

function in_creneaux(int $heure, array $creneaux): bool
{
    $ouvert = false;
    foreach($creneaux as $creneau) {
        if($heure >= $creneau[0] && $heure < $creneau[1]){
            $ouvert = true;
        }
    }
    return $ouvert;
}
function checkbox(string $name, string $value, array $data)
{
    $attributes = '';
    if(isset($data[$name]) && in_array($value, $data[$name])){
        $attributes .= 'checked';
    }
    return <<<HTML
    <input type="checkbox" name="{$name}[]" value="$value" $attributes>
HTML;
}

function radio(string $name, string $value, array $data)
{
    $attributes = '';
    if(isset($data[$name]) && in_array($value, $data[$name])){
        $attributes .= 'checked';
    }
    return <<<HTML
    <input type="radio" name="{$name}[]" value="$value" $attributes>
HTML;
}

function creneaux_html(array $creneaux)
{
    $plages = [];
    foreach($creneaux as $creneau) {
        $plages [] = '<strong>'. $creneau[0]. 'h</strong> à <strong>'. $creneau[1]. 'h</strong>';
    }
    return 'Ouvert de ' . implode(' et de ', $plages);
}

?>
<form method="post">
    <div class="form-control">
        <label for="jour">Entrez un jour de la semaine</label>
        <?= select('jour', $jour, JOURS) ?>
    </div>
    <div class="form-control">
        <label for="heure">Entrez une heure</label>
        <input type="number"  value="<?=$heure2?>" name="heure" id="heure">
    </div>
    <button type="submit">Vérifier</button>
</form>
<?php
if(isset($_POST['jour'])){
    $seraOuvert = in_creneaux($_POST['heure'], CRENEAUX[$_POST['jour']]);
    echo show_ouvert($seraOuvert);
}
?>
<div>
    <h2>Horaires d'ouvertures</h2>
    <?= show_ouvert($ouvert) ?>
    <ul>
        <?php foreach(JOURS as $k => $jour): ?>
            <li <?php if($k+1 == (int)date('N')): ?> style="color:<?=$color?>" <?php endif ?>>
                <strong><?= $jour ?></strong> :
                <?= empty(CRENEAUX[$k]) ? '<strong>fermé</strong>' : creneaux_html(CRENEAUX[$k])?>
            </li>
        <?php endforeach ?>
    </ul>
</div>
<form action="">
    <div class="form-group">
        <label>Parfums</label>
        <?php foreach($parfums as $parfum => $prix) :?>
        <div class="form-check">
            <?= checkbox('parfum', $parfum, $_GET) ?>
            <label class="form-check-label"><?=$parfum?> - <?=$prix?> €</label>
        </div>
        <?php endforeach?>
    </div>
    <div class="form-group">
        <label>Contenant</label>
        <?php foreach($cornets as $cornet => $prix) :?>
            <div class="form-check">
                <?= radio('cornet', $cornet, $_GET) ?>
                <label class="form-check-label"><?=$cornet?> - <?=$prix?> €</label>
            </div>
        <?php endforeach?>
    </div>
    <div class="form-group">
        <label>Supplémentss</label>
        <?php foreach($supplements as $sup => $prix) :?>
            <div class="form-check">
                <?= checkbox('supplement', $sup, $_GET) ?>
                <label class="form-check-label"><?=$sup?> - <?=$prix?> €</label>
            </div>
        <?php endforeach?>
    </div>
    <button type="submit">Calculer</button>
    <?php
        $total = 0;
        foreach(['parfum', 'cornet', 'supplement'] as $name) {
            if(isset($_GET[$name])) {
                $liste = $name . 's';
                foreach($_GET[$name] as $value) {
                    $total += (float)$$liste[$value];
                }
            }
        }
        echo 'Total à payer : '.$total;
        ?>
</form>
<?php
require_once('footer.php');
?>