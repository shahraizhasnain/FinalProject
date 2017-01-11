<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_upload extends MY_Model {

    /**
     * addImage function for orignal picture
     */
    function addImage($fileProperties) {
        $myModel = new My_Model();
        $requestData = getRequestHeaders();
        $userId = $requestData['user-id'];
        $insertData = [
            "uid" => $userId,
            "parent_id" => $userId,
            'parent_type' => $fileProperties['parent_type'],
            'file_name' => $fileProperties['file_name'],
            'file_type' => getFieldsValue()['file_type'],
            "extension" => '.jpg',
            "width" => 0,
            "height" => 0,
            'path' => $fileProperties['path'],
            'status' => getFieldsValue()['status'],
            'created_date' => getFieldsValue()['created_date'],
            'modified_date' => getFieldsValue()['modified_date']
        ];
        $result = $myModel->insert('user_file_uploads', $insertData);
        if ($result != FALSE) {
            $imageId = $result;
            return $resp = [
                "message" => "image added successfully",
                "data" => $imageId
            ];
        } else {
            return $resp = [
                "message" => "image not uploaded",
                "data" => "null"
            ];
        }
    }

    /**
     * addThumbImage function for thumb picture
     */
    function addThumbImage($imageId, $fileProperties) {
        $myModel = new My_Model();

        $data = [
            "uid" => $fileProperties['uid'],
            "parent_type" => $fileProperties['parent_type'],
            'thumb_type' => $fileProperties['thumb_type'],
            'size_type' => $fileProperties['size_type'], //sizetype is small, medum large ........
            'extension' => $fileProperties['extension'],
            'thumb_width' => $fileProperties['thumb_width'],
            'thumb_height' => $fileProperties['thumb_height'],
            "thumb_path" => $fileProperties['thumb_path'],
            'status' => $fileProperties['status'],
            'created_date' => $fileProperties['created_date'],
            'modified_date' => $fileProperties['modified_date'],
        ];
        $thumbInsert = $myModel->insert('images_thumbs', $data);
        if ($thumbInsert) {
            // $usersCompleteProfile = getCompleteUserProfile($result);
            return $resp = [
                "message" => "thumb made successfully!",
                "data" => "null"
            ];
        } else {
            
        }
    }

}

?>