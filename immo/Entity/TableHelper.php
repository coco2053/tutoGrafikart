<?php


namespace App\Entity;


class TableHelper
{
    public static function sort(string $sortKey, string $label, array $data):string
    {
        $sort = $data['sort'] ?? null;
        $ord = $data['ord'] ?? null;
    }
}