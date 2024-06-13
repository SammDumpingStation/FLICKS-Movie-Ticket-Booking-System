<?php

class User extends Dbh
{
    private $connect;
    private $query;

    public function __construct()
    {
        $this->connect = $this->connection();
    }

    protected function getUser()
    {
        try {
            if (isset($query) && !is_null($query)) {
                $query1 = $query;
            } else {
                $query1 = "SELECT * FROM comments ORDER BY username LIMIT 10;";
            }

            $stmt = $this->connect->prepare($query1);
            $stmt->execute();

            $results = $stmt->fetchAll();

            $this->connect = null;
            $stmt = null;

            return $results;

        } catch (\Throwable $e) {
            die("Query Failed. " . $e->getMessage());
        }
    }
}
