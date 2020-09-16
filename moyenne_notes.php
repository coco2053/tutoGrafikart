<?php

function moyenne(array $notes)
{
    return 'vous avez ' . round(array_sum($notes) / count($notes), 2).' de moyenne.';
}

echo(moyenne([10, 15, 13, 12, 17]));

$note1 = 12;
$note2 = &$note1;
$note2 = 16;
var_dump($note1, $note2);
