<?php

require 'config.php';

class DataBase {
    public function dbConnection() {
        try
        {
        $conn = new PDO("mysql:dbname=".DBNAME.";host=".DBHOST.";", DBUSERNAME, DBPASSWORD);
        return $conn;
        }
        catch (PDOException $err)
        {
            printf("Connection failed: ".$err->getMessage());
            exit();
        }
    }
}