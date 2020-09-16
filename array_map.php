<?php

$students = [
    "Marie" => 10,
    "Jules" => 14,
    "Mario" => 11,
    "Hugo" => 8
];

$closure = function($key, $value) {
    return [$key.' est con' => $value / 2];
};

print_r(array_map($closure, array_keys($students), $students));