<?php

/*


Label: [        value ] [!]
Label: [        value ] [!]
Label: [        value ] [!]
...
               [Submit]


*/


class Form
{
    public function __construct(string $method, array $fields)
    {
        $this->method = $method;
        $this->fields = $fields;
    }


    public function showForm()
    {
        print "
        <form method=".$this->method.">
            <table>
                ";
                foreach ($this->fields as $field)
                    {
                        print "
                        <tr>
                            <td>".$field["label"]."</td>
                            <td><input type=".$field["type"]." name=".$field["name"]." value=".$field["value"]."></td>
                            <td><span class=error>".$field["error"]."</span></td>
                        </tr>
                        ";
                    }
                print "
                <tr>
                    <td></td>
                    <td><input type='submit' value='Log in'><input type='hidden' name='page' value='login'></td>
                </tr>
            </table>
        </form>
        ";
    }
}

?>