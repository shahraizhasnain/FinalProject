<?php

/**
 * M_user Class
 *
 *
 * @package    CI
 * @subpackage Model
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
class M_admin extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->library('session');
        date_default_timezone_set("Asia/Karachi");
    }

    /**
     * Selecting all signed up users
     * @param string $userName
     * @return array
     */
    
    function login() {
        $myModel = new My_Model();
        $userName = $this->input->post('username');
        $userPassword = $this->input->post('password');
        $whereArray = [
//             "is_active" => 'ACTIVE',
            "username" => $userName,
            "password" => $userPassword,
        ];
        $fields = [
            "username",
            "admin_type",
            "authorization",
            "privilege"
        ];
        $result = $myModel->selectWithMulitpleJoin('admin', $fields, $whereArray);
        if (count($result) > 0) {
            if(count($result) == 1){
            $session_data = array(
                'username' => $result[0]['username'],
                'authorization' => $result[0]['authorization'],
                'admin_type' => $result[0]['admin_type'],
                'privilege' => $result[0]['privilege'],
                'privilege1' => "Null",
                'privilege2' => "Null"
            );
            } 
            else if(count($result) == 2){
            $session_data = array(
                'username' => $result[0]['username'],
                'authorization' => $result[0]['authorization'],
                'admin_type' => $result[0]['admin_type'],
                'privilege' => $result[0]['privilege'],
                'privilege1' => $result[1]['privilege'],
                'privilege2' => "Null"
            );
            }
            else if(count($result) == 3){
            $session_data = array(
                'username' => $result[0]['username'],
                'authorization' => $result[0]['authorization'],
                'admin_type' => $result[0]['admin_type'],
                'privilege' => $result[0]['privilege'],
                'privilege1' => $result[1]['privilege'],
                'privilege2' => $result[2]['privilege']
            );
            }
            json_encode($result);
            
//            print_r($result);
//            die();
            $this->session->set_userdata('logged_in', $session_data);
            return $resp = [
                "message" => "user login successfully",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "user login failed",
                "data" => "null"
            ];
        }
    }
    
    function regUsers(){
        $myModel = new MY_Model();
        $fields = [
            'cell_number as cell_number',
            'user_name as user_name',
            'first_name as first_name',
            'topic as topic'
        ];
        $result = $myModel->selectWithMulitpleJoins($fields);
        if ($result) {
            return $resp = [
                "message" => "registered events",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no registered events",
                "data" => "null"
            ];
        }
    }

    function addAdmin() {
        $myModel = new MY_Model();
        $userModel = new M_user();
        $username = $this->input->post('username');
        $admin = $userModel->isAdminExist($username);
        $fieldsArray = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'admin_type' => 'SUB'
        ];
        if ($admin['message'] === 'admin is available') {

            $result = $myModel->insert('admin', $fieldsArray);

             $privilege1 = $this->input->post('privilege1');
             $privilege2 = $this->input->post('privilege2');
             $privilege3 = $this->input->post('privilege3');
            if($privilege1){
                $dataArray = [
                  "admin_id" => $result,
                  "privilege_id" =>$privilege1
                ];
                $myModel->insert('admin_privilege', $dataArray);
            }
            if($privilege2){
                $dataArray = [
                  "admin_id" => $result,
                    "privilege_id" =>$privilege2
                ];
                $myModel->insert('admin_privilege', $dataArray);
            }
            if($privilege3){
                $dataArray = [
                  "admin_id" => $result,
                    "privilege_id" =>$privilege3
                ];
                $myModel->insert('admin_privilege', $dataArray);
            }
            
//            print_r($result);
            die();
            if ($result) {
                return $resp = [
                    "message" => "admin added",
                    "data" => "null"
                ];
            }
        } else {
            return $resp = [
                "message" => "admin already exist",
                "data" => "null"
            ];
        }
    }

    function viewAdmin() {
        $myModel = new MY_Model();
        $fields = "*";
        $result = $myModel->selectWithMulitpleJoin('admin', $fields);
        if ($result) {
            return $resp = [
                "message" => "all admins",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no admins",
                "data" => "null"
            ];
        }
    }
    function viewallAdmin() {
        $myModel = new MY_Model();
        $fields = "*";
        $result = $myModel->select('admin', $fields);
//        print_r($result);
//        die();
        if ($result) {
            return $resp = [
                "message" => "all admins",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no admins",
                "data" => "null"
            ];
        }
    }

    function addPrivilege() {
        $myModel = new MY_Model();
        $dataArray = [
            "admin_id" => $this->input->post('admin_id'),
            "privilege_id" => $this->input->post('privilege_id')
        ];
        $isExist = $myModel->select('admin_privilege', "*", $dataArray);
        
        if (count($isExist) == 0) {
            $result = $myModel->insert('admin_privilege', $dataArray);
            if ($result) {
                return $resp = [
                    "message" => "privilege added",
                    "data" => $result
                ];
            } else {
                return $resp = [
                    "message" => "privilege not added",
                    "data" => "null"
                ];
            }
        } else {
            return $resp = [
                "message" => "privilege already given",
                "data" => "null"
            ];
        }
    }

}
