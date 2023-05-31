<?php
session_start();

class Helper
{
    private $username;
    private $userId;


    public function Helper()
    {
        $username = '';
        $userId = '';
    }

    public function is_set_auth_user_session()
    {
        return isset($_SESSION['auth_user']);
    }

    public function set_auth_user_session($username, $userId)
    {

        $_SESSION['auth_user'] = [
            'username' => $username,
            'userId' => $userId
        ];


    }





    public function get_auth_user_session()
    {
        return $_SESSION['auth_user'];
    }
}

?>