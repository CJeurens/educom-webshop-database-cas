<?php

class RetrieveUserInfo
{




    public function __construct(string $email, ConnectMySqli $conn)
    {
        $this->email = $email;
        $this->conn = $conn;
    }
    


    public function retrieve()
    {

        $this->conn->connectMySqli();
        //$this->email = mysqli_real_escape_string($conn,$this->email);
        $sql = "SELECT email, username, password FROM users WHERE email='".$this->email."'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute;
        
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        /*foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v)
        {
            print $v;
        }*/
        $row = $sql->fetchAll();
        
        print "wow | ";
        var_dump($row);
        $conn = NULL;
        return $row;
    }
}

?>