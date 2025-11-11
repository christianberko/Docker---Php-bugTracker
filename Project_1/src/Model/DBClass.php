<?php

//creates database connection 
class DB{
    private $conn;

    function __construct(){
        $this ->conn = new mysqli($_SERVER['DB_SERVER'], $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD'], $_SERVER['DB']);

        if($this->conn->connect_error){
            echo "connection failed!: " .mysqli_connect_error();
            die();
        }
        
    } //construct 




}






?>