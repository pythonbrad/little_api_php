<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'StudentsService.php';
require 'utils.php';

$data = json_decode(file_get_contents("php://input"));
$response["message"] = "";

if (isset($data->id)) {
    try {
        $ss = new StudentsService();
        $ss->setId($data->id);
        $student_list = $ss->get();
        if ($student_list == []) {
            $response["message"] = "Data not found";
        } else {
            $student = $student_list[0];
            $ss->setName($data->name ?? $student->getName());
            $ss->setFirstName($data->firstname ?? $student->getFirstName());
            $ss->setBornDate($data->born_date ?? $student->getBornDate());
            $ss->setFiliere($data->filiere ?? $student->getFiliere());
            $ss->setNiveau($data->niveau ?? $student->getNiveau());
            $status = $ss->update();
            if ($status) {
                $response["message"] = "Data modified";
            }
            else
            {
                $response["message"] = "Data not modified";
            }
        }
    } catch (Exception $ex) {
        printf("Error: ".$ex->getMessage());
        exit();
    }
}
 else {
    $response["message"] = "Error";
}

echo json_encode($response);