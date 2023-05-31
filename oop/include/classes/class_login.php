<?php
session_start();
include 'class_dbconnection.php';
include '../helper.php';
class Login extends DbConnection
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authUser()
    {
        if ($this->isInputValid()) {
            $userId = '';
            $query = "SELECT * FROM users WHERE username='" . $this->username . "' AND `password`= md5(" . $this->password . ")";
            // var_dump($query);
            // exit;
            $conn = $this->connect();
            $result = mysqli_query($conn, $query);
            $num = mysqli_num_rows($result);
            // var_dump($num);
            // exit;
            if ($num > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $userId = $row['id'];
                }
                $helper = new Helper();
                $helper->set_auth_user_session($this->username, $userId);
                //return true;
                // $_SESSION['username'] = $this->username;
                // $_SESSION['userId'] = $userId;
                header('location:../../admin/dashboard.php');
                //var_dump()
            } else {
                //return false;
                header('location:../index.php?login=failed');
            }
        } else
            //return false;
            header('location:../index.php?input=invalid');


    }

    public function isInputValid()
    {
        if (empty($this->username) || empty($this->password))
            return false;
        return true;
    }
}
?>