<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$requestData = getRequestHeaders();
$userId = $requestData['user-id'];

function dataValue() {

    $config = array(
        "temp_path" => 'resources/temp/',
        "upload" => 'resources/uploads/',
        "thumbPath" => 'thumb/',
        "profile" => 'profile/',
        "patientprofile" => 'patientprofile/', // added for patients
        "allowed_types" => '.jpg',
        "overwrite" => TRUE,
        "max_size" => "2048000", // Can be set to particular file size, here it is 2 MB(2048 Kb)
        "max_height" => 400,
        "max_width" => 400,
//      "allowed_types" => $extension['allowed'],
//      "thumbPath" => base_url() .'resources/uploads/thumb/',
    );
    return $config;
}

/**
 * 
 * @access 
 */
function uploadImg($userId, $field = 'uploadedfile') {
    if (isset($_POST['uploadedfile'])) {
        $orignalImageLocation = NULL;
        $img = preg_replace('#^data:image/[^;]+;base64,#', '', $_POST['uploadedfile']);
        $imageData = base64_decode($img);
        $source = imagecreatefromstring($imageData);
        $imageName = "img" . rand(0, 10000000) . getFieldsValue()['created_date'];
        $imageExtension = '.jpg';
        $tempPath = dataValue()['temp_path'] . $imageName . $imageExtension;
        $isImageSavedTemp = imagejpeg($source, $tempPath, 100);
        if ($isImageSavedTemp == 1) {
            $imageBelongsTo = $_GET["imageof"];
            if ($imageBelongsTo == 'user') {
                $orignalImageLocation = dataValue()['upload'] . $userId . '/' . dataValue()['profile'];
                $parentType = 'USERPROFILE';
            } else if ($imageBelongsTo == 'patient') {
                $orignalImageLocation = dataValue()['upload'] . $userId . '/' . dataValue()['patientprofile'];
                $parentType = 'PATIENTPROFILE';
            }

            if (!file_exists($orignalImageLocation)) {
                mkdir($orignalImageLocation, 0777, true);
            }

            if (!copy($tempPath, $orignalImageLocation . $imageName . $imageExtension)) {
                return "null";
            } else {
                $requestData = getRequestHeaders();
                $userId = $requestData['user-id'];
                $fileProperties = [
                    "uid" => $userId,
                    "parent_id" => $userId,
                    'parent_type' => $parentType,
                    'file_type' => getFieldsValue()['file_type'],
                    'file_name' => $imageName,
                    'extension' => $imageExtension,
                    'size_type' => 'MEDIUM',
                    "width" => 400,
                    "height" => 400,
                    'thumb_type' => getFieldsValue()['thumb_type'],
                    "thumb_width" => 0,
                    "thumb_height" => 0,
                    "path" => $orignalImageLocation,
                    "thumb_path" => NULL,
                    "status" => getFieldsValue()['status'],
                    "created_date" => getFieldsValue()['created_date'],
                    "modified_date" => getFieldsValue()['modified_date'],
                ];
                return $fileProperties;
            }
        } else {
            return "null";
        }
    } else {
        return "null";
    }
}

function uploadImg_old($userId, $field = 'uploadedfile') {
    echo 'Here in Upload File function';
    echo '<br>';
    if ((($_file['type'] == "image/gif") || ($_file['type'] == "image/jpeg") || ($_file ['type'] == "image/pjpeg" ) || ($_file ['type'] == "image/jpg" ))) {
        if ($_file['size'] < 2048000) {
            if ($_file['error'] > 0) {
                return responseMessage("200", $response ['message'], $response['data']);
            } else {
                $data = dataValue();
// Save path in this function
                $orignalImageLocation = dataValue()['upload'] . $userId . '/' . dataValue()['profile'] . $_file ['name'];
                $imageThumbLocation = dataValue()['upload'] . $userId . '/' . dataValue()['profile'] . '/' . dataValue() ['thumbPath'] . $_file['name'];
                $move_upload_files = move_uploaded_file($_file['tmp_name'], $orignalImageLocation);
//                // hence file is move successfully 
                if (count($move_upload_files) > 0) {
                    $userfile_name = $_file['name'];
                    $userfile_extn = explode(".", strtolower($_file['name']));
                    $requestData = getRequestHeaders();
                    $userId = $requestData['user-id'];
                    $fileProperties = [
// key value are sets according to field name
                        "uid" => $userId,
                        "parent_id" => $userId,
                        'parent_type' => 'USERPROFILE', // parent_type is userprofile , patient profile .......
                        'file_type' => getFieldsValue()['file_type'],
                        'thumb_type' => getFieldsValue()['thumb_type'],
                        'size_type' => 'MEDIUM',
                        "extension" => '.jpg',
                        "width" => 0,
                        "height" => 0,
                        "thumb_width" => 0,
                        "thumb_height" => 0,
                        "path" => $orignalImageLocation,
                        "thumb_path" => $imageThumbLocation,
                        'status' => getFieldsValue()['status'],
                        'created_date' => getFieldsValue()['created_date'],
                        'modified_date' => getFieldsValue()['modified_date'],
                    ];

                    return $fileProperties;
                }

                // hence file is not move successfully 
                else {
                    return "null";
                }
            }
        }
    }
}

?>