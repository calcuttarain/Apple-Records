<?php 

trait Database
{
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $port;
    private $pdo;

    public function __construct()
    {
        $this->host = MYSQL_HOST;
        $this->port = MYSQL_PORT;
        $this->dbname = MYSQL_DATABASE;
        $this->user = MYSQL_USER; 
        $this->password = MYSQL_PASSWORD;

        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Eroare conexiune: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}

