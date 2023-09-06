<?php

class Validator
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function addValidation($field, $fields)
    {
        if (array_key_exists("email",$field))
        {
            $field = $this->validateEmail($field);
        }
        //custom validation checks for login/registration forms
        return $field;
    }

    public function validateEmail($field)
    {
        if (!filter_var($field["email"]["value"],FILTER_VALIDATE_EMAIL))
        {
            $field["email"]["error"] = "Invalid e-mail";
        }
        else
        {
            $field["email"]["valid"] = TRUE;
        }
        return $field;
    }

    public function validate()
    {
        $return = array();
        $fields = array();
        foreach ($this->data as $key=>$value)
        {
            unset($field);
            $field[$key] = $value;
            $field[$key]["error"] = "";
            $field[$key]["valid"] = FALSE;
            if(empty($field[$key]["value"]))
            {
                $field[$key]["error"] = "Please fill in field";
            }
            else
            {


                //custom checks
                $field = $this->addValidation($field, $fields);
            }
            $fields = array_merge($fields,$field);
        }
        return $fields;
    }
}


?>