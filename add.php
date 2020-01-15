<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'StudentsService.php';
require 'utils.php';

$data = json_decode(file_get_contents("php://input"));
$response["message"] = "";

$keys = ["name", "firstname", "born_date", "filiere", "niveau"];
$response["errors"] = dataVerification($keys, $data, $empty_ignore=["firstname"]);

if ($response["errors"] == []) {
    try {
        $ss = new StudentsService();
        $ss->setName($data->name);
        $ss->setFirstName($data->firstname);
        $ss->setBornDate($data->born_date);
        $ss->setFiliere($data->filiere);
        $ss->setNiveau($data->niveau);
        $status = $ss->save();
        if ($status) {
            $response["message"] = "Data added";
        }
        else
        {
            $response["message"] = "Data not added";
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