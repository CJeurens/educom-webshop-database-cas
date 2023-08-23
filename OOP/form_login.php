<?php

require_once "form.php";

class LoginForm extends Form
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
            "password"  =>  array(
                            "name"  =>  "password",
                            "label" =>  "Password:",
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
            <td><a style=font-size:14px; href='?page=register'>Register account</a></td>
            <td><input style=width:64px; type='submit' value='Log in'><input type='hidden' name='page' value='login'></td>
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