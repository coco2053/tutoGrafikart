<?php

namespace App\Entity;

class ProductManager
{
    const DB_CONNECTION = 'mysql:host=localhost;dbname=immo;charset=utf8';
    const DB_LOGIN = 'root';
    const DB_MDP = '';
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(self::DB_CONNECTION, self::DB_LOGIN, self::DB_MDP,[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public function getProducts(int $limit)
    {
        try {
            $query = $this->pdo->prepare('SELECT *
                                        FROM products
                                        LIMIT :limit');

            $query->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);

            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\\App\\Entity\\Product');

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getProductsByCity(string $city)
    {
        try {
            $query = $this->pdo->prepare('SELECT *
                                        FROM products
                                        WHERE products.city = :city');

            $query->bindValue(':city', (string) $city);

            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\\App\\Entity\\Product');

            return $query->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}