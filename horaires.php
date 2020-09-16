<?php
$entry = '';
$creneaux = [];
while(true) {
    $ouverture = intval(readline('Heure d\'ouverutre :'));
    $fermeture = intval(readline('Heure de fermeture :'));
    if($ouverture >= $fermeture) {
        echo "Les horaires entrés ne sont pas valides car l\'heure d\'ouverture ($ouverture) est supérieure à l\'heure de fermeture($fermeture)! \n";
    } elseif($ouverture <= 0 || $ouverture > 23 || $fermeture <= 0 || $fermeture > 23) {
        echo "Les horaires entrés ne sont pas valides, les horaires doivent être compris entre 1 et 23 ! \n";
    } else {
        $creneaux [] = [$ouverture, $fermeture];
        $action = readline("Voulez vous ajouter des horaires? (o)ui / (n)on \n");
        if($action != 'o') {
            break;
        }
    }
}
$output = 'Le magasin est ouvert de ';
foreach ($creneaux as $key => $creneau) {
    if ($key == count($creneaux)-1) {
        $output .= $creneau[0].'h à '.$creneau[1]."h\n";
    } else {
        $output .= $creneau[0].'h à '.$creneau[1].'h et de ';
    }
}
echo $output;

$heure = intval(readline("A quele heure viendrez-vous? \n"));
$resultats = [];
foreach ($creneaux as $creneau) {
    $resultats [] = ($heure >= $creneau[0] && $heure <= $creneau[1]);
}
if(in_array(true, $resultats)){
    echo "magasin ouvert !\n";
} else {
    echo "magasin fermé ! \n";
}

