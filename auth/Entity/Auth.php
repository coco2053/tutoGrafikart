<?php


class Auth
{
    const PDO_CONNECTION = "mysql:host=localhost;dbname=auth;charset=utf8";
    const PDO_USERNAME = "root";
    const PDO_PASSWORD = "";
    protected $pdo;


    public function __construct()
    {
        $this->pdo = new PDO(Self::PDO_CONNECTION, Self::PDO_USERNAME, Self::PDO_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    }

    public function user()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['auth'] ?? null;
        if($id == null) {
            return null;
        }
        $query = $this->pdo->prepare('SELECT * FROM user WHERE id = ?');
        $query->execute([$id]);
        $user = $query->fetchObject();
        return $user ?: null;

    }
    public function login(string $username, string $password)
    {
        $query = $this->pdo->prepare('SELECT * FROM user WHERE user.username = :username');
        $query->execute(['username' => htmlentities($username)]);
        $user = $query->fetchObject();
        if($user == null || !password_verify($password, $user->password)) {
            return null;
        }
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['auth'] = $user->id;
        return $user;
    }
}