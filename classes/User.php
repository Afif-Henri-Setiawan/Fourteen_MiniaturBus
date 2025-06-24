<?php
class User
{
    private $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function login($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
        $stmt->execute([
            ':username' => $username,
            ':password' => $password
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>