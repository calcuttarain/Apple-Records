<?php 

trait Database
{
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $pdo;

    public function __construct()
    {
        $this->host = getenv('DB_HOST');
        $this->dbname = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->password = 'pass';

        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die(" Database connection failed: " . $e->getMessage() . "<br>" .
                " <strong>DB_HOST:</strong> {$this->host}<br>" .
                " <strong>DB_NAME:</strong> {$this->dbname}<br>" .
                " <strong>DB_USER:</strong> {$this->user}<br>" .
                " <strong>DB_PASS:</strong> " . ($this->password ? 'SET' : 'NOT SET') . "<br>");
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
 }
