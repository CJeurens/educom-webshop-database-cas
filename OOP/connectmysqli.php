<?php
class ConnectMySqli
{
    public function __construct(string $servername, string $username, string $password, string $database)
    {
        $this->servername = $servername;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }


    public function connectMySqli()
    {
        try
        {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            print "connected successfully";
        }
        catch(PDOException $e)
        {
            print "connection failed: ".$e->getMessage();
        }
        
    }
}
?>