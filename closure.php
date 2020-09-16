<?php

$students = [
    "Marie" => 10,
    "Jules" => 14,
    "Mario" => 11,
    "Hugo" => 8
];

$condition = function($val) {
    return $val > 10;
};
print_r(array_filter($students, $condition));