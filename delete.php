<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'StudentsService.php';
require 'utils.php';

$data = json_decode(file_get_contents("php://input"));
$response["message"] = "";

$keys = ["id"];
$response["errors"] = dataVerification($keys, $data);

if ($response["errors"] == []) {
    try {
        $ss = new StudentsService();
        $ss->setId($data->id);
        $status = $ss->delete();
        if ($status) {
            $response["message"] = "Data deleted";
        }
        else
        {
            $response["message"] = "Data not deleted";
        }
    } catch (Exception $ex) {
        printf("Error: ".$ex->getMessage());
        exit();
    }
} else {
    $response["message"] = "Error";
}

echo json_encode($response);