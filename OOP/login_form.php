<?php

require_once "form.php";

class LoginForm extends Form
{

    public function __construct()
    {
        $this->method = "POST";
        $this->fields = array
        (
            "email" =>  array(
                            "name"  =>  "email",
                            "label" =>  "E-mail:",
                            "type"  =>  "text",
                            "value" =>  "",
                            "error" =>  ""
            ),
            "password"  =>  array(
                            "name"  =>  "password",
                            "label" =>  "Password:",
                            "type"  =>  "text",
                            "value" =>  "",
                            "error" =>  ""
            )
        );        
    }

}

?>