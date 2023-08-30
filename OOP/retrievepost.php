<?php

class RetrievePost
{
    public function __construct(array $inputs, SanitizeData $sanitize)
    {
        $this->inputs = $inputs;
        $this->sanitize = $sanitize;
    }

    public function retrieve()
    {
        $return = array();
        foreach ($this->inputs as $input)
        {
            $add = array(
                $input => ["value" =>(isset($_POST[$input]) ? $this->sanitize->sanitize($_POST[$input]) : "")]
            );
            $return = array_merge($return,$add);
        }
        return $return;
    }
}

?>