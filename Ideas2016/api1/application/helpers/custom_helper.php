<?php

/**
 * custom_helper 
 * Contains helper functions 
 * 
 * @package    CI
 * @subpackage Model
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Allow CORS
 */
function allowCORS() {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');
    header('Access-Control-Allow-Credentials: true');
}

/**
 * Returns userId
 * @param type $userName
 * @return integer $userId
 */
function getUserId($userName) {
    $myModel = new MY_Model();
    $requiredFields = "id";
    $whereClause = [
        "is_active" => 'ACTIVE',
        "user_name" => $userName
    ];
    $userId = $myModel->select("users", $requiredFields, $whereClause);
    return $userId;
}


/**
 * Checks is Session is Active of provided token 
 * Incase of active return the complete user profile of 
 * Otherwise return FALSE 
 * 
 * @param array $userData
 * @param string $sessionToken
 * @param integer $userId
 * @return boolean or array
 */
function isSessionActive($userData, $sessionToken, $userId) {
    $myModel = new MY_Model();
    $requiredFields = [
        "users.id AS users_id",
        "users.user_name",
        "users.user_password",
        "users.first_name",
        "users.last_name",
        "users.gender",
        "users.date_of_birth",
        "users.phone_number",
        "users.cell_number",
        "users.street_address",
        "users.zip_code",
        "users.prefered_contact",
        "users.visit_type",
        "users.profile_image_id",
        "users.cover_image_id",
        "users.last_login_datetime",
        "users.is_active",
        "session.id AS session_id",
        "session.session_token AS session_token"
    ];
    $whereClause = [
        "users_id" => $userData['userId'],
        "session_token" => $userData['sessionToken']
    ];
    $result = $myModel->selectWithSingleJoin('users', 'session', 'session.users_id = users.id', $requiredFields, $whereClause);
    if (count($result) > 0) {
        $userId = $result[0]['users_id'];
        return getCompleteUserProfile($userId);
    } else {
        return FALSE;
    }
}

/**
 * get request headers
 * @return array $data
 */
function getRequestHeaders() {
    $data = array_change_key_case(apache_request_headers(), CASE_LOWER);
    $clientId = 'NULL';
    $sessionToken = 'NULL';
    $userId = 'NULL';
    if (!array_key_exists("x-client-id", $data)) {
        $data["x-client-id"] = $clientId;
    }
    if (!array_key_exists("token", $data)) {
        $data["token"] = $sessionToken;
    }
    if (!array_key_exists("user-id", $data)) {
        $data["user-id"] = $userId;
    }
    return $data;
}


