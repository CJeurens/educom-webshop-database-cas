<?php



class RetrieveUserInfo
{



    public function __construct(string $email, ConnectMySQLi $conn_users)
    {
        $this->email = $email;
        $this->conn_users = $conn_users;
    }
    


    public function retrieve()
    {

        $conn=$this->conn_users->connectMySQLi();
        $this->email = mysqli_real_escape_string($conn,$this->email);
        $sql = "SELECT email, username, password FROM users WHERE email='".$this->email."'";
        $result = mysqli_query($conn,$sql);     
        $row = mysqli_fetch_assoc($result);
        
        print "wow | ";
        var_dump($row);
        mysqli_close($conn);
        return $row;
    }
}

?>