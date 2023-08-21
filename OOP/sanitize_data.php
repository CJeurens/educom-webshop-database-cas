<?php

class SanitizeData
{
    public function sanitize($data)
    {
        $this->data = $data;
        $this->data = trim($this->data);
        $this->data = stripslashes($this->data);
        $this->data = htmlspecialchars($this->data);
        return $this->data;
    }
}

?>