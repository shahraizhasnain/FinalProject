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
class Admin extends MY_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
         $this->load->library('session');
//         session_start();
//        allowCORS();
    }
      public function login() {
          
         $adminModel = new M_admin();
         if ($this->form_validation->run('login') == FALSE) {
             return responseMessage("200", "username and password is required", "null");
         } else {
             $response = $adminModel->login();
             return responseMessage("200", $response['message'], $response['data']);
         }
     }
      public function addPrivilege() {
         $adminModel = new M_admin();
             $response = $adminModel->addPrivilege();
             return responseMessage("200", $response['message'], $response['data']);
         }
     
     
     public function addAdmin() {
         $adminModel = new M_admin();
         if ($this->form_validation->run('addadmin') == FALSE) {
             return responseMessage("200", "insert proper admin", "null");
         } else {
             $response = $adminModel->addAdmin();
             return responseMessage("200", $response['message'], $response['data']);
         }
     }
     public function viewAdmin() {
         $adminModel = new M_admin();
             $response = $adminModel->viewAdmin();
             return responseMessage("200", $response['message'], $response['data']);
     }
     public function viewAllAdmin() {
         $adminModel = new M_admin();
             $response = $adminModel->viewallAdmin();
             return responseMessage("200", $response['message'], $response['data']);
     }
     public function regUsers() {
         $adminModel = new M_admin();
             $response = $adminModel->regUsers();
             return responseMessage("200", $response['message'], $response['data']);
     }
     

    public function totalUsers() {
        $requestData = getRequestHeaders();
        $userId = $requestData['user-id'];
        $sessionToken = $requestData['token'];
        $sessionData = array(
            "userId" => $userId,
            "sessionToken" => $sessionToken
        );
        if (!isSessionActive($sessionData, $requestData['token'], $userId)) {
            return responseMessage("200", "unauthorized user", "null");
        } else {
            $adminModel = new M_admin();
            $response = $adminModel->totalUsers();
            return responseMessage("200", $response['message'], $response['data']);
        }
    }

    /**
     * get AssessmentForm
     */
    public function saveAssessmentForm() {
        //add form validation obj name -> updateUserProfile
        $sessionModel = new M_user();
        if ($this->form_validation->run('updateUserProfile') == FALSE) {
            //return responseMessage(http_response_code(200), "validation failure", "null");
            return responseMessage("200", "validation failure", "null");
        } else {
            $response = $sessionModel->add();
            return responseMessage("200", $response['message'], $response['data']);
        }
    }
}
