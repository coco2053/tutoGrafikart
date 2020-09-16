<?php
function creneau($prompt = "Veullez entrer un créneau:\n99")
{
    echo $prompt;
    while(true) {
        $ouverture = (int)readline('Heure d\'ouverutre :');
        $fermeture = (int)readline('Heure de fermeture :');
        if($ouverture >= $fermeture) {
            echo "Les horaires entrés ne sont pas valides car l\'heure d\'ouverture ($ouverture) est supérieure à l\'heure de fermeture($fermeture)! \n";
        } elseif($ouverture < 0 || $ouverture > 23 || $fermeture <= 0 || $fermeture > 23) {
            echo "Les horaires entrés ne sont pas valides, les horaires doivent être compris entre 1 et 23 ! \n";
        } else {
            $creneau = [$ouverture, $fermeture];
            return $creneau;
        }
    }
}

function creneaux()
{
    $i = 0;
    $creneaux = [];
    while(true) {
        $creneaux [] = creneau();
        $i++;
        if($i > 0) {
            $reponse = readline('Voullez-vous ajouter un creneau ? (o)ui / (n)on');
            if ($reponse != 'o') {
                return $creneaux;
            }
        }
    }
}
$creneaux = creneaux();
print_r($creneaux);

