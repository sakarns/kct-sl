<?php
include __DIR__ . '../../../config/database.php';
class User extends DbConnection
{
    private $id;
    private $username;
    private $email;
    private $is_active;

    public function __construct()
    {
        $this->id = '';
        $this->username = '';
        $this->email = '';
        $this->is_active = '';
    }

    public function get_user()
    {
        $query = "SELECT * FROM users";
        $conn = $this->connect();
        $result = $conn->query($query);


        return $result;
    }
}
?>