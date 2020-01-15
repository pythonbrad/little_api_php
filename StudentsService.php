<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentsService
 *
 * @author Fody
 */

require 'StudentsDAO.php';

class StudentsService {
    protected $id;
    protected $name;
    protected $firstname;
    protected $born_date;
    protected $filiere;
    protected $niveau;
    
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getFirstName() {
        return $this->firstname;
    }
    public function getBornDate() {
        return $this->born_date;
    }
    public function getFiliere() {
        return $this->filiere;
    }
    public function getNiveau() {
        return $this->niveau;
    }
    public function setId($value) {
        return $this->id = $value;
    }
    public function setName(string $value) {
        return $this->name = $value;
    }
    public function setFirstName(string $value) {
        return $this->firstname = $value;
    }
    public function setBornDate(string $value) {
        return $this->born_date = $value;
    }
    public function setFiliere(string $value) {
        return $this->filiere = $value;
    }
    public function setNiveau(string $value) {
        return $this->niveau = $value;
    }
    public function get() {
        $students = [];
        $sd = new StudentsDAO();
        $datas = $sd->select($this->id);
        foreach ($datas as $data) {
            $student = new StudentsService();
            $student->id = $data["id"];
            $student->name = $data["name"];
            $student->firstname = $data["firstname"];
            $student->born_date = $data["born_date"];
            $student->filiere = $data["filiere"];
            $student->niveau = $data["niveau"];
            $students[] = $student;
        }
        return $students;
    }
    public function save() {
        $sd = new StudentsDAO();
        return $sd->insert($this->name, $this->firstname, $this->born_date, $this->filiere, $this->niveau);
    }
    public function delete() {
        $sd = new StudentsDAO();
        return $sd->delete($this->id);
    }
    public function update() {
        $sd = new StudentsDAO();
        return $sd->update($this->id, $this->name, $this->firstname, $this->born_date, $this->filiere, $this->niveau);
    }
}
