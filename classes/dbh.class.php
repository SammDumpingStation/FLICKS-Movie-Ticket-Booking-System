<?php
//SQL Database Connection Class
class Dbh
{
    private $host = 'localhost';
    private $dbUser = "root";
    private $dbPassword = "root42069";
    private $dbName = "movie_ticket_booking";

    public function connection()
    {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $pdo = new PDO($dsn, $this->dbUser, $this->dbPassword);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (\Throwable $th) {
            print "Error!: " . $th->getMessage() . "<br/>";
            die();
        }

    }
}
