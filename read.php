<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require 'StudentsService.php';

$data = json_decode(file_get_contents("php://input"));

$students = new StudentsService();
$students->setId($data->id ?? "ALL");

$datas = [];

foreach ($students->get() as $student) {
    $data = [];
    $data["id"] = $student->getId();
    $data["name"] = $student->getName();
    $data["firstname"] = $student->getFirstName();
    $data["born_date"] = $student->getBornDate();
    $data["filiere"] = $student->getFiliere();
    $data["niveau"] = $student->getNiveau();
    $datas[] = $data;
}

echo json_encode($datas);