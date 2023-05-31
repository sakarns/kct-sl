<?php
class DBConnection{
    private String $db_host;
    private String $db_username;
    private String $db_password;
    private String $db_database;

    function __construct(String $db_host,String $db_username,String $db_password,String $db_database){
        $this->db_host = $db_host;
        $this->db_username = $db_username;
        $this->db_password = $db_password;
        $this->db_database = $db_database;

    }

    public function  openConnection(){
        $conn = mysqli_connect($this->db_host,$this->db_username,$this->db_password,$this->db_database);
        return $conn;
    }
}
?>