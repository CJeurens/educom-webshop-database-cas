<?php

require_once "form.php";

class ContactForm extends Form
{
    public function __construct($title, $header, $navlinks, $author, $form, $method, $fields)
    {
        parent::__construct($title, $header, $navlinks, $author, $form, $method, $fields);
        $this->form = $form;
        $this->method = "POST";
        $this->fields = array
        (
            "name"  =>  array(
                            "name"  =>  "name",
                            "label" =>  "Name:",
                            "type"  =>  "text",
                            "value" =>  "",
                            "error" =>  ""
            ),
            "email" =>  array(
                            "name"  =>  "email",
                            "label" =>  "E-mail:",
                            "type"  =>  "text",
                            "value" =>  "",
                            "error" =>  ""
            ),
            "msg" =>  array(
                            "name"  =>  "msg",
                            "label" =>  "Message:",
                            "type"  =>  "textarea",
                            "value" =>  "",
                            "error" =>  ""
            )
        );        
    }

    public function bottomRowForm()
    {
        print "
        <tr>
            <td></td>
            <td><input style=width:64px; type='submit' value='Send'><input type='hidden' name='page' value='contact'></td>
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