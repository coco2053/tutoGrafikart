<?php
require('vendor/autoload.php');
use App\QueryBuilder;

function getPDO(): PDO
{
    $pdo = new PDO("sqlite::memory:");
    $pdo->query('CREATE TABLE products (
    id INTEGER CONSTRAINT products_pk primary key autoincrement,
    name TEXT,
    address TEXT,
    city TEXT)');
    for ($i = 1; $i <= 10; $i++) {
        $pdo->exec("INSERT INTO products (name, address, city) VALUES ('Product $i', 'Addresse $i', 'Ville $i');");
    }
    return $pdo;
}

$qb = new QueryBuilder(getPDO());
var_dump($qb);
$qb->from("products")
    ->where("name IN (:name1, :name2)")
    ->setParam("name1", "Product 1")
    ->setParam("name2", "Product 2");
$count = $qb->count();

