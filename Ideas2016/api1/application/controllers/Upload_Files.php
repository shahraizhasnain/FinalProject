<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include '../assets/helper/config.php';
//include '../assets/helper/image_config.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_Files extends MY_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * orignal profile picture
     */
    public function image() {

        //  $response = $uploadModel->addImage($fileProperties);
        //  return responseMessage("200", $response['message'], $response['data']);

        $requestData = getRequestHeaders();
        $userId = $requestData['user-id'];
        $sessionToken = $requestData['token'];
        $sessionData = array(
            "userId" => $userId,
            "sessionToken" => $sessionToken
        );

        if (isSessionActive($sessionData, $sessionToken, $userId)) {
//           hence user is authorized
            $fileProperties = uploadImg($userId, 'uploadedfile');
            if ($fileProperties != "null") {
                $uploadModel = new M_Upload();
                $response = $uploadModel->addImage($fileProperties);
                return responseMessage("200", $response["message"], $response['data']);
            } else {
                $response = NULL;
                return responseMessage("200", $fileProperties, NULL);
            }
        } else {
//          hence user is not authorized
            return responseMessage("200", $fileProperties, NULL);
        }
    }

}

?>