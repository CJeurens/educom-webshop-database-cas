<?php

/*


Label: [        value ] [!]
Label: [        value ] [!]
Label: [        value ] [!]
...
               [Submit]


*/

require_once "appdoc.php";

class Form extends AppDoc
{
    public function __construct($title, $header, $navlinks, $author, $form, $method, $fields)
    {        
        parent::__construct($title, $header, $navlinks, $author);

        $this->form = $form;
        $this->method = $method;
        $this->fields = $fields;
    }


    public function showMainContent()
    {
        $this->openForm();
        $this->mainForm();
        $this->bottomRowForm();
        $this->closeForm();
    }


    public function openForm()
    {
        print "<div class=form>
        <form method=".$this->method.">
            <table>
                ";
    }

    public function closeForm()
    {
        print "
        </table>
        </form id=".$this->form."></div>
        ";
    }

    public function validateField()
    {
        //print "validate test | ";
    }

    public function mainForm()
    {
        foreach ($this->fields as $fields=>$field)
            {
                if($field["type"] == "textarea")
                {
                    print "
                    <tr>
                        <td>".$field["label"]."</td>
                        <td><textarea cols=42 rows=6 name=".$field["name"]." value=".$field["value"]."></textarea></td>
                        <td><span class=error>".$field["error"]."</span></td>
                    </tr>
                    ";
                }
                else
                {
                    print "
                    <tr>
                        <td>".$field["label"]."</td>
                        <td style='text-align:left'><input type=".$field["type"]." name=".$field["name"]." value=".$field["value"]."></td>
                        <td><span class=error>".$field["error"]."</span></td>
                    </tr>
                    ";
                }
                $this->validateField();
            }       
    }

    public function bottomRowForm()
    {
        print "
        <tr>
            <td></td>
            <td><input type='submit'><input type='hidden' name='page' value=''></td>
        </tr>";
    }

}

?>