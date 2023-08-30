<?php

class Validator
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate()
    {
        foreach ($this->data as $key=>$value)
        {
            $field[$key]=$value;    //also adds new key to previous loop result

            $field[$key]["error"] = "";
            $field[$key]["valid"] = FALSE;
            
            if(empty($field[$key]["value"]))
            {
                //print "empty| ";
                $field[$key]["error"] = "Please fill in field";

            }
            
            if ($key == "email")
            {
                print "email found| ";
                if (!filter_var($field[$key]["value"],FILTER_VALIDATE_EMAIL))
                {
                    print "bad email| ";
                    $field[$key]["error"] = "Invalid e-mail";
                }

            }
            return $field;
            //repeat password check

        }
    }
}


?>