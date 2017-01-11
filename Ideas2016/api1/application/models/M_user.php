<?php

/**
 * M_user Class
 *
 *
 * @package    CI
 * @subpackage Model
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
class M_user extends MY_Model {

    /**
     * Checking user_name is already assigned or not
     * @param string $userName
     * @return array
     */
    function isUserNameExist($userName) {
        $myModel = new My_Model();
        $fieldsArray = "*";
        $whereArray = [
            "user_name" => $userName
        ];
        $result = $myModel->select('users', $fieldsArray, $whereArray);
        if (count($result) > 0) {
            return $resp = [
                "message" => "username is not available",
                "data" => "null"
            ];
        } else {
            return $resp = [
                "message" => "username is available",
                "data" => "null"
            ];
        }
    }
    function userID($userName){
        $myModel = new MY_Model();
        $where = [
            "user_name" => $userName
        ];
        $result = $myModel->select('users', 'user_id', $where);
        return $result;
    }
    function isAdminExist($userName) {
        $myModel = new My_Model();
        $fieldsArray = "*";
        $whereArray = [
            "username" => $userName
        ];
        $result = $myModel->select('admin', $fieldsArray, $whereArray);
        if (count($result) > 0) {
            return $resp = [
                "message" => "admin is not available",
                "data" => "null"
            ];
        } else {
            return $resp = [
                "message" => "admin is available",
                "data" => "null"
            ];
        }
    }

    function isCellNumberExist($cellNumber, $userName) {
        $myModel = new My_Model();
        $fieldsArray = "*";
        $whereArray = [
            "cell_number" => $cellNumber,
            "user_name" => $userName
        ];
        $result = $myModel->select('users', $fieldsArray, $whereArray);
        if (count($result) > 0) {
            return $resp = [
                "message" => "cell number exist",
                "data" => "null"
            ];
        } else {
            return $resp = [
                "message" => "cell number does not exist",
                "data" => "null"
            ];
        }
    }

    function isUserVerified($userName) {
        $myModel = new My_Model();
        $fieldsArray = 'authentication';
        $whereArray = [
            "user_name" => $userName
        ];
        $result = $myModel->select('users', $fieldsArray, $whereArray);
        if (count($result) > 0) {
            if ($result[0]['authentication'] === 'VERIFIED') {
                return $resp = [
                    "message" => "user verified",
                    "data" => "null"
                ];
            } else {
                return $resp = [
                    "message" => "user not verified",
                    "data" => "null"
                ];
            }
        } else {
            return $resp = [
                "message" => "user not available",
                "data" => "null"
            ];
        }
    }

    function UserNameActive($userName) {
        $myModel = new My_Model();
        $fieldsArray = "*";
        $whereArray = [
            "user_name" => $userName,
            "is_active" => "ACTIVE"
        ];
        $result = $myModel->select('users', $fieldsArray, $whereArray);
        if (count($result) > 0) {
            return $resp = [
                "message" => "username active",
                "data" => "null"
            ];
        } else {
            return $resp = [
                "message" => "username not active",
                "data" => "null"
            ];
        }
    }

    /**
     * Updates user profile
     * @return array
     */
    function registerUserProfile() {
        $myModel = new MY_Model();
        $userModel = new M_user();
        $username = $this->input->post('user_name');
        $whereArray = [
            "user_name" => $username
        ];
        $updatedData = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'designation' => $this->input->post('designation'),
            'country' => $this->input->post('country'),
            'company_name' => $this->input->post('company_name'),
            'company_address' => $this->input->post('company_address'),
            'company_phone' => $this->input->post('company_phone'),
            'company_email' => $this->input->post('company_email'),
            'company_website' => $this->input->post('company_website'),
            'buisness' => $this->input->post('buisness'),
            'user_type' => $this->input->post('user_type'),
            'user_title' => $this->input->post('user_title'),
            'is_active' => 'ACTIVE',
            'modified_date' => getFieldsValue()['modified_date']
        );
        $result = $myModel->update('users', $updatedData, $whereArray);
        if ($result) {
            return $resp = [
                "message" => "user profile updated successfully",
                "data" => "null"
            ];
        } else {
            return $resp = [
                "message" => "user profile failed to update",
                "data" => "null"
            ];
        }
    }

    /**
     * Get all users
     * @return array
     */
    function allusers() {
        $myModel = new My_Model();
        $fieldsArray = "*";
        $whereArray=[
            "is_active" => "ACTIVE"
        ];
        $result = $myModel->select('users', $fieldsArray, $whereArray);
        if (count($result) > 0) {
            return $resp = [
                "message" => "all users",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no users signed up",
                "data" => "null"
            ];
        }
    }

}
