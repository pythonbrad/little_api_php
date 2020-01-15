<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentsDAO
 *
 * @author Fody
 */

require 'database.php';

class StudentsDAO {

    private $conn;

    public function __construct() {
        $db_connection = new DataBase();
        $this->conn = $db_connection->dbConnection();
    }
    public function insert($name, $firstname, $born_date, $filiere, $niveau) {
        $sql = "INSERT INTO `students` VALUES (null, :name, :firstname, :born_date, :filiere, :niveau)";
        $query = $this->conn->prepare($sql);
        $query->bindParam(":name", $name, PDO::PARAM_STR);
        $query->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $query->bindParam(":born_date", $born_date, PDO::PARAM_STR);
        $query->bindParam(":filiere", $filiere, PDO::PARAM_STR);
        $query->bindParam(":niveau", $niveau, PDO::PARAM_STR);
        return $query->execute();
    }
    public function select($id) {
        $students = [];
        if ($id == "ALL") {
            $sql = "SELECT * FROM `students`";
            $query = $this->conn->prepare($sql);
        } else {
            $sql = "SELECT * FROM `students` WHERE id=:id";
            $query = $this->conn->prepare($sql);
            $query->bindParam(":id", $id, PDO::PARAM_INT);
        }
        $query->execute();
        while ($student = $query->fetch(PDO::FETCH_ASSOC)) {
            $students[] = $student;
        }
        return $students;
    }
    public function delete($id) {
        $sql = "DELETE FROM `students` WHERE `id`=:id";
        $query = $this->conn->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        return $query->execute();
    }
    public function update($id, $name, $firstname, $born_date, $filiere, $niveau) {
        $sql = "UPDATE `students` SET `name`=:name,`firstname`=:firstname,`born_date`=:born_date,`filiere`=:filiere,`niveau`=:niveau WHERE `id`=:id";
        $query = $this->conn->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":name", $name, PDO::PARAM_STR);
        $query->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $query->bindParam(":born_date", $born_date, PDO::PARAM_STR);
        $query->bindParam(":filiere", $filiere, PDO::PARAM_STR);
        $query->bindParam(":niveau", $niveau, PDO::PARAM_STR);
        return $query->execute();
    }
}
