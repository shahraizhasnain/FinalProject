<?php

/**
 * utility_helper
 * Contains reuseable functions
 * 
 * @package    CI
 * @subpackage Model
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */

/**
 * Converts data in JSON format array 
 * @param array $data
 */
function sendJSON($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
//    die();
}

/**
 * Returns final response message 
 * respective function used in every 
 * api request
 * 
 * @param integer $statusCode
 * @param string $message
 * @param array $data
 */
function responseMessage($statusCode, $message, $data) {
    sendJSON([
        "meta" => [
            "status" => $statusCode,
            "message" => $message
        ],
        "data" => $data
    ]);
}

/**
 * Generate values for mandatory fields
 * @return array
 */
function getFieldsValue() {
    $unixTimeStamp = time();
    $time = unix_to_human($unixTimeStamp);
    $fieldsValue = array("created_date" => $time, "modified_date" => $unixTimeStamp, "is_active" => 'UNACTIVE', "authentication" => 'UNVERIFIED', "current_datetime" => date("Y-m-d H:i:s"), "is_order_finished" => 'OPEN', "parent_type" => 'USERPROFILE', "file_type" => 'IMAGE', "status" => 'ACTIVE', "thumb_type" => 'IMAGETHUMB', "size_type" => 'MEDIUM');
    return $fieldsValue;
}

/**
 * not using
 * @param type $msg
 */
function successMessage($msg) {
    sendJSON([
        "status" => "true",
        "msg" => $msg
    ]);
}

/**
 * not using
 * @param type $msg
 */
function failureMessage($msg) {
    sendJSON([
        "status" => "false",
        "msg" => $msg
    ]);
}

/**
 * not using
 * @param type $msg
 */
function errorMessage($msg) {
    sendJSON([
        "status" => "error",
        "msg" => $msg
    ]);
}

/**
 * not using
 * @param type $msg
 */
function invalidRequestMessage($msg) {
    sendJSON([
        "status" => "Invalid Request",
        "msg" => $msg
    ]);
}

/**
 * not using
 * @param type $msg
 */
function isPostRequest() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
