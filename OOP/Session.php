<?php

class Session
{
    public function doLoginSession($username)
    {
        $_SESSION["userID"] = $username;
    }
}

?>