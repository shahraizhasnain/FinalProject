
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User
 * 
 * 
 * @package    CI
 * @subpackage Controller
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
class User extends MY_Controller {

    /**
     * Constructor
     */
//    public function __construct() {
//        parent::__construct();
//    }

    /**
     * Add user
     */
//    public function Add() {
//        //add form validation obj name -> updateUserProfile
//        $sessionModel = new M_user();
//        if ($this->form_validation->run('updateUserProfile') == FALSE) {
//            //return responseMessage(http_response_code(200), "validation failure", "null");
//            return responseMessage("200", "validation failure", "null");
//        } else {
//            $response = $sessionModel->add();
//            return responseMessage("200", $response['message'], $response['data']);
//        }
//    }

    /**
     * Checking if user_name is exist
     * @return status
     */
//    public function check() {
//        ///////////////////////////////////////////////////////////////////////////////
//        $requestData = getRequestHeaders();
//        $userId = $requestData ['user-id'];
////        $userId = $this->input->post('users_id');
//        $sessionToken = $requestData['token'];
//        $sessionData = array(
//            "userId" => $userId,
//            "sessionToken" => $sessionToken
//        );
//        if (!isSessionActive($sessionData, $requestData['token'], $userId)) {
////          hence user's session is active so return its profile
//            return responseMessage("200", "unauthorized user", "null");
//        } else {
//////          hence user has no session so  return response 
////            return responseMessage("200", "user is not logged in", "null");
////        }
//            ////////////////////////////////////////////////////////////////////////////////
//
//
//            $userModel = new M_user();
//            if ($this->form_validation->run('checkUserName') == FALSE) {
//                return responseMessage("200", "username is required", "null");
//            } else {
//                $response = $userModel->isUserNameExist($this->input->post('users_name'));
//                return responseMessage("200", $response['message'], $response['data']);
//            }
//        }
//    }

    /**
     * Returns the user Profile 
     * if session is active 
     * other wise send response user is not logged in
     * 
     * @return status
     */
//    public function profile() {
//        $requestData = getRequestHeaders();
//        $userId = $requestData['user-id'];
////        $userId = $this->input->post('users_id');
//        $sessionToken = $requestData['token'];
//        $sessionData = array(
//            "userId" => $userId,
//            "sessionToken" => $sessionToken
//        );
//        if (isSessionActive($sessionData, $requestData['token'], $userId)) {
////          hence user's session is active so return its profile
//            $userProfile = isSessionActive($sessionData, $sessionToken, $userId);
//            return responseMessage("200", "user profile", $userProfile);
//        } else {
////          hence user has no session so  return response 
//            return responseMessage("200", "user is not authorized", "null");
//        }
//    }
    
        public function asd (){
        $usermodel = new M_user();
        $response = $usermodel->UserNameActive($this->input->post('user_name'));
        return responseMessage("200", $response['message'], null);
    }

//    public function update() {
//
//        //////////////////////////////////////////////////////////////////////////////////
////        $requestData = getRequestHeaders();
////        $userId = $requestData['user-id'];
////        $sessionToken = $requestData['token'];
////        $sessionData = array(
////            "userId" => $userId,
////            "sessionToken" => $sessionToken
////        );
////        if (!isSessionActive($sessionData, $requestData['token'], $userId)) {
//////            hence user is not authorized
////            return responseMessage("200", "unauthorized user", null);
////        } else {
////            //  hence user is authorized now validating form
////            if ($this->form_validation->run('updateUserProfile') == FALSE) {
////                return responseMessage("200", "validation failure", "null");
////            } else {
//                $userModel = new M_user();
//                $response = $userModel->updateUserProfile();
//                return responseMessage("200", $response['message'], $response['data']);
////            }
////        }
//    }

//    public function cart() {
//        $requestData = getRequestHeaders();
//        $userId = $requestData['user-id'];
//        $sessionToken = $requestData['token'];
//        $sessionData = array(
//            "userId" => $userId,
//            "sessionToken" => $sessionToken
//        );
//        if (!isSessionActive($sessionData, $requestData['token'], $userId)) {
////            hence user is not authorized
//            return responseMessage("200", "unauthorized user", null);
//        } else {
////            hence user is authorized            
//            $userModel = new M_User();
//            $response = $userModel->addCart();
//            return responseMessage("200", $response['message'], $response['data']);
//        }
//    }

}
