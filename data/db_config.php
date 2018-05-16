<?php

class DbConfig
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "visitor_registration_db";

    private function GetConnection() {
        $connection = new mysqli($this->server, $this->username, $this->password, $this->database);

        if($connection->connect_error) die("Baglanti hatasi: " . $connection->connect_error);

        return $connection;
    }

    public function ExecuteQuery($command)
    {
        $connection = $this->GetConnection();
        
        $result = $connection->query($command);
        $connection->close();

        return $result;
    }

    public function GetSingle($command)
    {
        $connection = $this->GetConnection();

        $result = $connection->query($command);
        $connection->close();

        return mysqli_fetch_assoc($result);
    }

    public function GetAll($command)
    {
        $connection = $this->GetConnection();

        $result = $connection->query($command);
        $connection->close();

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function GetCount($command)
    {
        $connection = $this->GetConnection();

        $result = $connection->query($command);
        $connection->close();

        return $result->num_rows;
    }
}

?>