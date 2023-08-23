<?php

require_once "form.php";

class RegisterForm extends Form
{
    public function __construct($title, $header, $navlinks, $author, $form, $method, $fields)
    {
        parent::__construct($title, $header, $navlinks, $author, $form, $method, $fields);
        $this->form = $form;
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
            "username" =>  array(
                            "name"  =>  "username",
                            "label" =>  "Username:",
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
            ),
            "rpassword"  =>  array(
                            "name"  =>  "rpassword",
                            "label" =>  "Repeat password:",
                            "type"  =>  "text",
                            "value" =>  "",
                            "error" =>  ""
            )
        );        
    }

    public function bottomRowForm()
    {
        print "
        <tr>
            <td><a style=font-size:14px; href='?page=login'>Log in instead</a></td>
            <td><input style=width:80px; type='submit' value='Register'><input type='hidden' name='page' value='register'></td>
        </tr>";
    }

    public function validateField()
    {
                /*if ($fields == "email")    //email validation
        {
            print "email detected🤖";
        }

        if ($fields == "password")    //password validation
        {
            print "password detected🤖";
        }*/
    }

}

?>