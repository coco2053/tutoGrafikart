<?php

function repondre_oui_non($prompt)
{
    while(true){
        $reponse = strtolower(readline($prompt.' (o)ui / (n)on'));
        if ($reponse == 'n') {
            return false;
        }elseif ($reponse == 'o') {
            return true;
        }
    }
}

$result = repondre_oui_non('Voulez-vous continuer ?');
var_dump($result);
