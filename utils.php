<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function dataVerification(array $keys, $data, array $empty_ignore=[]) {
    $errors = [];
    if (!isset($data)) {
        return "No data";
    }
    foreach ($keys as $key) {
        if (!isset($data->$key)) {
             $errors[$key] =  "missing";
        } elseif (empty($data->$key) && !in_array($key, $empty_ignore)) {
            $errors[$key] = "empty";
        }
    }
    return $errors;
}