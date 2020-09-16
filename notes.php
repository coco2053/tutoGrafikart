<?php
$entry = '';
$notes = [];
while($entry != 'fin') {
    $entry = readline('Entrez une note, terminez par : fin');
    if (is_numeric($entry)) {
        $notes[] = $entry;
    }
}
print_r($notes);
