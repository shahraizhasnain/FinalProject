<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Session Class
 * 
 * 
 * @package    CI
 * @subpackage Controller
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
class Session extends MY_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Signup user
     * @return status
     */
    public function signup() {
        $sessionModel = new M_session();
        if ($this->form_validation->run('signup') == FALSE) {
            return responseMessage("401", "validation failure", "null");
        } else {
            $response = $sessionModel->signup();
            if ($response['message'] === "user successfully signup") {
                $this->SendEmailSignUp($response['data']['user_name'], $response['data']['verification_code']);
                return responseMessage("200", $response['message'], null);
            } else if ($response['message'] === "user not verified") {
                $response = $sessionModel->signup();
                if ($response['message'] === "user successfully signup") {
                    $this->SendEmailSignUp($response['data']['user_name'], $response['data']['verification_code']);
                    return responseMessage("200", $response['message'], null);
                }else if($response['message'] === "user active"){
                    $this->SendEmailSignUp($response['data']['user_name'], $response['data']['verification_code']); 
                    return responseMessage("200", $response['message'], null);
                }
            } else {
                return responseMessage("200", $response['message'], null);
            }
        }
    }

    /**
     * User Verification user
     * @return status
     */
    public function verification() {
        $sessionModel = new M_session();
        $response = $sessionModel->verification();
        if ($response['message'] === "user activated") {
            return responseMessage("200", $response['message'], null);
        } else {
            return responseMessage("200", $response['message'], null);
        }
    }

    /**
     * Update user
     * @return status
     */
    public function register() {
        $userModel = new M_user();
        $response = $userModel->registerUserProfile();
        return responseMessage("200", $response['message'], $response['data']);
    }

    /**
     * Select all user
     * @return users
     */
    public function getallusers() {
        $userModel = new M_user();
        $response = $userModel->allusers();
        return responseMessage("200", $response['message'], $response['data']);
    }
 /**
     * Select all events
     * @return events
     */
    public function events(){
        $sessionModel = new M_session();
        $response = $sessionModel->addevent();
         return responseMessage("200", $response['message'], $response['data']);
        
    }
 /**
     * Send notification
     * @return users
     */
    public function notification() {
        $sessionModel = new M_session();
        $response = $sessionModel->notifications();
        return responseMessage("200", $response['message'], $response["data"]);
    }
     /**
     * Show all Notification
     * @return users
     */
    public function viewNotification(){
        $sessionModel = new M_session();
        $response = $sessionModel->viewNotification();
        return responseMessage("200", $response['message'], $response['data']);
    }
     /**
     * Show Events
     * @return events
     */
    public function viewEvent(){
        $sessionModel = new M_session();
        $response = $sessionModel->viewEvent();
        return responseMessage("200", $response['message'], $response['data']);
    }
    public function deleteEvent(){
        $sessionModel = new M_session();
        $response = $sessionModel->deleteEvent();
        return responseMessage("200", $response['message'], $response['data']);
    }
    public function editEvent(){
        $sessionModel = new M_session();
        $response = $sessionModel->editEvent();
        return responseMessage("200", $response['message'], $response['data']);
    }
    public function getEventById(){
        $sessionModel = new M_session();
        $response = $sessionModel->getEventById();
        return responseMessage("200", $response['message'], $response['data']);
    }
    public function registerEvent(){
//        if ($this->form_validation->run('register_event') == FALSE) {
//            return responseMessage("401", "validation failure", "null");
//        }else{
        $sessionModel = new M_session();
        $response = $sessionModel->registerEvent();
        return responseMessage("200", $response['message'], $response['data']);
    }

/////////////////////////////////////////////////////
    
    
    
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

        
