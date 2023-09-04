<?php

class Validator
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate()
    {
        $return = array();
        foreach ($this->data as $key=>$value)
        {
            $field[$key]=$value;    //also adds new key to previous loop result

            $field[$key]["error"] = "";
            $field[$key]["valid"] = FALSE;
            
            if(empty($field[$key]["value"]))
            {
                $field[$key]["error"] = "Please fill in field";
            }
            else
            {
                if ($key == "email")
                {
                    if (!filter_var($field[$key]["value"],FILTER_VALIDATE_EMAIL))
                    {
                        $field[$key]["error"] = "Invalid e-mail";
                    }
                    else
                    {

                        require_once "ConnectMySqli.php";
                        $conn_users = new ConnectMySqli(
                            servername: "localhost",
                            username: "root",
                            password: "",
                            database: "users"
                        );
                        

                        require_once "RetrieveUserInfo.php";
                        $user = new RetrieveUserInfo($field[$key]["value"], $conn_users);

                        $user->retrieve();

                    }
                }
                //repeat password check
            }
        }
        return $field;
    }
}


?>