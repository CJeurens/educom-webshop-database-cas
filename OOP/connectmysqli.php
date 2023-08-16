<?php
class ConnectMySQLi
{
    public function __construct(string $servername, string $username, string $password, string $database)
    {
        $this->servername = $servername;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }


    public function connectMySQLi()
    {
        /*$servername = "localhost";
        $username = "root";
        $password = "";*/

        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
    
        if (!$conn)
        {
            throw new Exception("Connection failed".mysqli_connect_error());
        }
        return $conn;
    }
}
?>