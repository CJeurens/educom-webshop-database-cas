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
        $this->closeForm();
    }


    public function openForm()
    {
        print "<div class=form>
        <form method=".$this->method." id=".$this->form.">
            <table>";
    }

    public function closeForm()
    {
        print "
        </table>
        </form></div>
        ";
    }

    public function validateField($data)
    {
        $result = array(
            "value" => "",
            "error" => ""
        );
        require_once "sanitize_data.php";
        $input = new SanitizeData;
        
        if (empty($data))
        {
            $result["error"] = "ERROR";
        }
        else
        {
            $result["value"] = $input->sanitize($data);
        }
        return $result;
    }

    public function mainForm()
    {
        foreach ($this->fields as $fields=>$field)
            {
                $field["error"] = "";
                $check = isset($_POST[$field["name"]]) ? $this->validateField($_POST[$field["name"]]) : "";

                $field["value"] = isset($_POST[$field["name"]]) ? $check["value"] : $field["default"];

                //$field["error"] = $check["error"];

                print PHP_EOL.
"                <tr>".PHP_EOL.
"                    <td>".$field["label"]."</td>";
                if($field["type"] == "textarea")
                {
                    print PHP_EOL.
"                    <td style='text-align:left'><textarea cols=42 rows=6 name=".$field["name"]."></textarea></td>";
                }
                else
                {
                    print PHP_EOL.
"                    <td style='text-align:left'><input type=".$field["type"]." name=".$field["name"]." value=".$field["value"]."></td>";
                }
                print PHP_EOL.
"                    <td><span class=error>".$field["error"]."</span></td>
                </tr>";
            }       
    }
}

?>