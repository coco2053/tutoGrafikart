<?php
$chemin = 'files/' . date('Y-m-d');
$compteur_general = (int)file_get_contents('files/compteur');
$compteur_general++;
file_put_contents('files/compteur', $compteur_general);
if(file_exists($chemin)){
    $compteur = file_get_contents($chemin);
    $compteur++;
    file_put_contents($chemin, $compteur);
} else {
    $compteur = 0;
    $compteur++;
    file_put_contents($chemin, $compteur);
}
function compteur(bool $istotal) {
    $chemin = 'files/' . date('Y-m-d');
    if($istotal) {
        return (int)file_get_contents('files/compteur');
    }
    return (int)file_get_contents($chemin);
}

function compteur_mois(string $year, string $mois): int {
    $chemin = $year .'-'. $mois . '-' . '*';
    $fichiers = glob($chemin);
    $total = 0;
    foreach($fichiers as $fichier) {
        $total += (int)file_get_contents($fichier);
    }
    return $total;
}

function compteur_details_mois(string $year, string $mois): array {
    $chemin = $year .'-'. $mois . '-' . '*';
    $fichiers = glob($chemin);
    $total = 0;
    $visites = [];
    foreach($fichiers as $fichier) {
        $parties = explode('-', basename($fichier));
        $visites [] = [
            'annee' => $parties[0],
            'mois' => $parties[1],
            'jour' => $parties[2],
            'visites' => file_get_contents($fichier)
        ];
    }
    return $visites;
}
