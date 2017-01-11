<?php

/**
 * M_Session Class
 * 
 * 
 * @package    CI
 * @subpackage Model
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
class M_session extends MY_Model {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('M_user');
        date_default_timezone_set("Asia/Karachi");
    }

    /**
     * Signup user
     * @return array
     */
    function signup() {
        $myModel = new My_Model();
        $userModel = new M_user();
        $session = new M_session();
        $userName = $this->input->post('user_name');
        $cellNumber = $this->input->post('cell_number');
        $verified = $userModel->isUserVerified($userName);
        $isCellNumberExist = $userModel->isCellNumberExist($cellNumber, $userName);
        $isUserNameExist = $userModel->isUserNameExist($userName);
        $isUserActive = $userModel->UserNameActive($userName);
        if ($isUserNameExist['message'] === "username is available") {
            $userData = array(
                'user_name' => $userName,
                'cell_number' => $cellNumber,
                'device_id' => $this->input->post('device_id'),
                'verification_code' => $this->input->post('verification_code'),
                'device_type' => $this->input->post('device_type'),
                'device_token' => $this->input->post('device_token'),
                'created_date' => getFieldsValue()['created_date'],
                'modified_date' => getFieldsValue()['modified_date'],
                'is_active' => getFieldsValue()['is_active'],
                'authentication' => getFieldsValue()['authentication']
            );
            $result = $myModel->insert('users', $userData);
            if ($result) {
                //     $userCompleteProfile = getCompleteUserProfile($result);
                return $resp = [
                    "message" => "user successfully signup",
                    "data" => array('user_name' => $userData['user_name'],
                        'verification_code' => $userData['verification_code'])
                ];
            } else {
                return $resp = [
                    "message" => "user failed to signup",
                    "data" => "null"
                ];
            }
        } else if ($isUserNameExist['message'] === "username is not available") {
            if ($isCellNumberExist['message'] === 'cell number exist') {
                if ($verified['message'] === 'user verified') {

                    if ($isUserActive['message'] === 'username active') {

                        $userData = [
                            'verification_code' => $this->input->post('verification_code')
                        ];
                        $userName = $this->input->post('user_name');
                        $cellNumber = $this->input->post('cell_number');
                        $verification = ['verification_code' => $this->input->post('verification_code')];
                        $where = [
                            'user_name' => $userName,
                            'cell_number' => $cellNumber,
                        ];
                        $result = $myModel->update('users', $userData, $where);
                        return $resp = [
                            "message" => "user active",
                            "data" => array('user_name' => $userName, $userData['verification_code'])
                        ];
                    } else {
                        return $resp = [
                            "message" => "user verified",
                            "data" => "null"
                        ];
                    }
                } else {
                    $session->deleteuser($userName);
                    return $resp = [
                        "message" => "user not verified",
                        "data" => "null"
                    ];
                }
            } else {
                return $resp = [
                    "message" => "cell number does not exist",
                    "data" => "null"
                ];
            }
        } else {
            return $resp = [
                "message" => "user failed to signup",
                "data" => "null"
            ];
        }
    }

    function verification() {
        $myModel = new My_Model();
        $whereArray = [
            "is_active" => 'UNACTIVE',
            "user_name" => $this->input->post('user_name'),
            "cell_number" => $this->input->post('cell_number')
        ];
        $fieldsArray = [
            "verification_code AS verification_code"
        ];
        $result = $myModel->select('users', $fieldsArray, $whereArray);
        if (count($result) > 0) {
            $verification_code = $this->input->post('verification_code');
            if ($result[0]['verification_code'] === $verification_code) {
                $updatedData = [
                    "authentication" => "VERIFIED"
                ];
                $whereArray = [
                    "is_active" => 'UNACTIVE',
                    "authentication" => "UNVERIFIED",
                    "user_name" => $this->input->post('user_name'),
                    "cell_number" => $this->input->post('cell_number')
                ];
                $result = $myModel->update('users', $updatedData, $whereArray);
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
            $whereArray = [
                "is_active" => 'ACTIVE',
                "user_name" => $this->input->post('user_name'),
                "cell_number" => $this->input->post('cell_number')
            ];
            $fieldsArray = [
                "verification_code AS verification_code"
            ];
            $result = $myModel->select('users', $fieldsArray, $whereArray);
            if (count($result) > 0) {
                $verification_code = $this->input->post('verification_code');
                if ($result[0]['verification_code'] === $verification_code) {
                    $updatedData = [
                        "authentication" => "VERIFIED"
                    ];
                    $whereArray = [
                        "is_active" => 'UNACTIVE',
                        "authentication" => "UNVERIFIED",
                        "user_name" => $this->input->post('user_name'),
                        "cell_number" => $this->input->post('cell_number')
                    ];
                    $result = $myModel->update('users', $updatedData, $whereArray);
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
                    "message" => "user is not signed up yet",
                    "data" => "null"
                ];
            }
        }
    }

    function notifications() {
        $myModel = new MY_Model();
        if ($this->input->post('foreignDelegate') == 1) {
            $foriegDelegate = 1;
        } else if ($this->input->post('foreignDelegate') == '') {
            $foriegDelegate = 0;
        }
        if ($this->input->post('localDelegate') == 1) {
            $localDelegate = 1;
        } else if ($this->input->post('localDelegate') == '') {
            $localDelegate = 0;
        }
        if ($this->input->post('trade') == 1) {
            $trade = 1;
        } else if ($this->input->post('trade') == '') {
            $trade = 0;
        }
        if ($this->input->post('exhibitor') == 1) {
            $exhibitor = 1;
        } else if ($this->input->post('exhibitor') == '') {
            $exhibitor = 0;
        }
        if ($this->input->post('functionary') == 1) {
            $functionary = 1;
        } else if ($this->input->post('functionary') == '') {
            $functionary = 0;
        }
        if ($this->input->post('eventManager') == 1) {
            $eventManager = 1;
        } else if ($this->input->post('eventManager') == '') {
            $eventManager = 0;
        }
        if ($this->input->post('organizer') == 1) {
            $organizer = 1;
        } else if ($this->input->post('organizer') == '') {
            $organizer = 0;
        }
        if ($this->input->post('security') == 1) {
            $security = 1;
        } else if ($this->input->post('security') == '') {
            $security = 0;
        }
        if ($this->input->post('guestVisitor') == 1) {
            $guestVisitor = 1;
        } else if ($this->input->post('guestVisitor') == '') {
            $guestVisitor = 0;
        }


        $notificationData = [
            "foreignDelegate" => $foriegDelegate,
            "localDelegate" => $localDelegate,
            "exhibitor" => $exhibitor,
            "functionary" => $functionary,
            "eventManager" => $eventManager,
            "organizer" => $organizer,
            "trade" => $trade,
            "security" => $security,
            "guestVisitor" => $guestVisitor,
            "title" => $this->input->post('title'),
            "notification" => $this->input->post('notification')
        ];

        $result = $myModel->insert('notifications', $notificationData);
        $notification = [
            'title' => $this->input->post('title'),
            'notification' => "♦  " . $this->input->post('notification') . "  -  " . getFieldsValue()['created_date']
        ];

        if ($this->input->post('foreignDelegate') == 1) {
            $foriegDelegate = 'Foreign Delegate';
        } else if ($this->input->post('foreignDelegate') == '') {
            $foriegDelegate = '';
        }

        if ($this->input->post('localDelegate') == 1) {
            $localDelegate = 'Local Delegate';
        } else if ($this->input->post('localDelegate') == '') {
            $localDelegate = '';
        }
        if ($this->input->post('trade') == 1) {
            $trade = 'Trade Visitor';
        } else if ($this->input->post('trade') == '') {
            $trade = '';
        }
        if ($this->input->post('exhibitor') == 1) {
            $exhibitor = 'Exhibitor';
        } else if ($this->input->post('exhibitor') == '') {
            $exhibitor = '';
        }
        if ($this->input->post('functionary') == 1) {
            $functionary = 'Functionary';
        } else if ($this->input->post('functionary') == '') {
            $functionary = '';
        }
        if ($this->input->post('eventManager') == 1) {
            $eventManager = 'Event Manager';
        } else if ($this->input->post('eventManager') == '') {
            $eventManager = '';
        }
        if ($this->input->post('organizer') == 1) {
            $organizer = 'Organizer';
        } else if ($this->input->post('organizer') == '') {
            $organizer = '';
        }
        if ($this->input->post('security') == 1) {
            $security = 'Security';
        } else if ($this->input->post('security') == '') {
            $security = '';
        }
        if ($this->input->post('guestVisitor') == 1) {
            $guestVisitor = 'Guest Visitor';
        } else if ($this->input->post('guestVisitor') == '') {
            $guestVisitor = '';
        }
        $fieldsArray = 'device_token';
        $result = $myModel->selectwherein('users', $fieldsArray, $foriegDelegate, $localDelegate, $trade, $exhibitor, $functionary, $eventManager, $organizer, $security, $guestVisitor);

        $url = 'https://fcm.googleapis.com/fcm/send';
        $server_key = 'AIzaSyCcnyzGAl-NjIgJ27F8I0vbOsLtqjaz4jY';
        for ($i = 0; $i < count($result); $i++) {
            $miss[$i] = $result[$i]['device_token'];
        }

        $fields = array(
            'data' => $notification,
            'registration_ids' => $miss
        );
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        if ($result) {
            return $resp = [
                "message" => "Notification send successfuly",
                "data" => 'null'
            ];
        } else {
            return $resp = [
                "message" => "Notification not send successfuly",
                "data" => "null"
            ];
        }
    }

    function viewNotification() {
        $myModel = new MY_Model();
        $result = $myModel->select('notifications', '*');
        if ($result) {
            return $resp = [
                "message" => "all notifications",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no notification",
                "data" => "null"
            ];
        }
    }

    function registerEvent() {
        $myModel = new MY_Model();
        $userModel = new M_user();
        $result = $userModel->userID($this->input->post('user_name'));
        $whereArray = [
            'user_id' => $result[0]['user_id'],
            'event_id' => $this->input->post('event_id')
        ];

        $registered = $myModel->select('user_event', 'user_id', $whereArray);
        if ($registered) {
            return $resp = [
                "message" => "user already registered",
                "data" => "null"
            ];
        } else {
            $eventData = [
                "user_id" => $result[0]['user_id'],
                "event_id" => $this->input->post('event_id')
            ];
            $result = $myModel->insert('user_event', $eventData);

            if ($result) {
                return $resp = [
                    "message" => "user registered",
                    "data" => "null"
                ];
            } else {
                return $resp = [
                    "message" => "user did not registered",
                    "data" => "null"
                ];
            }
        }
    }

    function viewEvent() {
        $myModel = new MY_Model();
        $userModel = new M_user();
        $result = $userModel->userID($this->input->get('user_name'));
        if (count($result) > 0) {
            $whereArray = [
                "user_id" => $result[0]['user_id']
            ];
        } else {
            $whereArray = [
                "user_id" => NULL
            ];
        }
        $fieldsArray = [
            "event_id AS event_id"
        ];
        $is_going = $myModel->select('user_event', $fieldsArray, $whereArray);

        $fieldsArray = [
            "id AS event_id",
            "date AS date",
            "topic AS topic",
            "CONCAT(start_time, '-', end_time) AS time",
            "start_time AS start_time",
            "end_time AS end_time",
            "venue As venue",
            "is_conference As is_conference",
            "is_going AS is_going"
        ];

        if ($this->input->get('date') != NULL) {
            $whereArray = [
                "date" => $this->input->get('date')
            ];
        } else {
            $whereArray = [];
        }

        $result = $myModel->select('events', $fieldsArray, $whereArray);
        for ($i = 0; $i < count($is_going); $i++) {
            for ($j = 0; $j < count($result); $j++) {
                if ($is_going[$i]['event_id'] === $result[$j]['event_id']) {
                    $result[$j]['is_going'] = "1";
                }
            }
        }
     
        if ($result) {
            return $resp = [
                "message" => "all events",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "null",
                "data" => "no events"
                . ""
            ];
        }
    }

    function deleteuser($userName) {
        $myModel = new MY_Model();
        $where = [
            "user_name" => $userName
        ];
        $myModel->delete('users', $where);
    }

    function deleteEvent() {
        $myModel = new MY_Model();
        $where = [
            "id" => $this->input->post('id')
        ];
        $result = $myModel->delete('events', $where);
        if ($result) {
            return $resp = [
                "message" => "event deleted",
                "data" => "null"
            ];
        } else {
            return $resp = [
                "message" => "event not deleted",
                "data" => "null"
            ];
        }
    }

    function getEventById() {
        $myModel = new MY_Model();
        $where = [
            "id" => $this->input->post('id')
        ];
        $fieldsArray = [
            "id AS id",
            "topic AS topic",
            "start_time AS start_time",
            "end_time AS end_time",
            "venue AS venue",
            "date AS date",
            "is_conference AS is_conference"
        ];
        $result = $myModel->select('events', $fieldsArray, $where);
        if ($result) {
            return $resp = [
                "message" => "event by id",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no event on this id",
                "data" => "null"
            ];
        }
    }

    function editEvent() {
        $myModel = new MY_Model();

        $where = [
            "id" => $this->input->post('id')
        ];
        $update = [
            "topic" => $this->input->post('topic'),
            "start_time" => $this->input->post('start_time'),
            "end_time" => $this->input->post('end_time'),
            "venue" => $this->input->post('venue'),
            "date" => $this->input->post('date'),
            "is_conference" => $this->input->post('is_conference')
        ];
        $result = $myModel->update('events', $update, $where);
        if ($result) {
            return $resp = [
                "message" => "event updated",
                "data" => "null"
            ];
        } else {
            return $resp = [
                "message" => "event not updated",
                "data" => "null"
            ];
        }
    }

    function addevent() {
        $myModel = new MY_Model();
        $dataArray = [
            "topic" => $this->input->post('topic'),
            "start_time" => $this->input->post('start_time'),
            "end_time" => $this->input->post('end_time'),
            "venue" => $this->input->post('venue'),
            "date" => $this->input->post('date'),
            "is_conference" => $this->input->post('is_conference')
        ];
        $result = $myModel->insert('events', $dataArray);
        if ($result) {
            return $resp = [
                "message" => "event added",
                "data" => "null"
            ];
        } else {
            return $resp = [
                "message" => "event not added",
                "data" => "null"
            ];
        }
    }

//     /**
//      * Login user
//      * @return array
//      */
//     function login() {
//         $myModel = new My_Model();
//         $userName = $this->input->post('user_name');
//         $userPassword = $this->input->post('user_password');
//         $fieldsArray = "*";
//         $whereArray = [
//             "is_active" => 'ACTIVE',
//             "user_name" => $userName,
//             "user_password" => $userPassword
//         ];
//         $result = $myModel->select('users', $fieldsArray, $whereArray);
//         if (count($result) > 0) {
// //           now user is successfully login
// //           so create its session only if its session is not exist,
// //           otherwise send the previous session
// //           for this we require users_id and client_id,
// //           users_id will be get from getUserId function 
// //           by providing the user_name where as client_id
// //           is available in header
//             $userId = getUserId($userName);
//             $reqHeadersData = getRequestHeaders();
//             $sessionToken = $reqHeadersData['token'];
//             $clientId = $reqHeadersData['x-client-id'];
//             if (count($userId) > 0) {
//                 $userId = $userId[0]['id'];
//                 $requiredFields = "*";
//                 $whereClause = [
//                     "users_id" => $userId,
//                     "client_id" => $clientId
//                 ];
//                 $isSessionExist = $myModel->select("session", $requiredFields, $whereClause);
//                 if (count($isSessionExist) > 0) {
// //                    return existing session
//                     $userCompleteProfile = getCompleteUserProfile($userId);
//                     $updateData = [
//                         "last_login_datetime" => getFieldsValue()['current_datetime']
//                     ];
//                     $whereClause = [
//                         "id" => $userId
//                     ];
//                     $updateLastLoginDateTime = $myModel->update("users", $updateData, $whereClause);
//                     return $resp = [
//                         "message" => "user login successfully",
//                         "data" => $userCompleteProfile
//                     ];
//                 } else {
// //                    creating new session as saving in table
//                     $sessionToken = rand(0, 10000);
//                     $clientId = rand(0, 10000000);
//                     $sessionData = array(
//                         'users_id' => $userId,
//                         'user_agent' => NULL,
//                         'client_id' => $clientId,
//                         'session_token' => $sessionToken,
//                         'os' => NULL,
//                         'os_version' => NULL,
//                         'browser_name' => NULL,
//                         'browser_major_version' => NULL,
//                         'browser_full_version' => NULL,
//                         'is_mobile' => NULL,
//                         'is_retina' => NULL,
//                         'is_high_density' => NULL,
//                         'flash_version' => NULL,
//                         'is_cookie' => NULL,
//                         'screen_size' => NULL,
//                         'full_user_agent' => NULL,
//                         'expirte_time' => NULL,
//                         'created_date' => getFieldsValue()['created_date']
//                     );
//                     $result = $myModel->insert('session', $sessionData);
//                     if ($result) {
//                         $updateData = [
//                             "last_login_datetime" => getFieldsValue()['current_datetime']
//                         ];
//                         $whereClause = [
//                             "id" => $userId
//                         ];
//                         $updateLastLoginDateTime = $myModel->update("users", $updateData, $whereClause);
//                         $profile = getCompleteUserProfile($userId);
//                         $data = [
//                             array(
//                                 'credentials' => [
//                                     array(
//                                         'client_id' => $clientId,
//                                         'token' => $sessionToken
//                                     )],
//                                 'user' => $profile
//                             )
//                         ];
//                         return $resp = [
//                             "message" => "user login successfully",
//                             "data" => $data[0]
//                         ];
//                     } else {
//                         return $resp = [
//                             "message" => "user login failed",
//                             "data" => "null"
//                         ];
//                     }
//                 }
//             }
//         } else {
//             return $resp = [
//                 "message" => "invalid username and password",
//                 "data" => "null"
//             ];
//         }
//     }
//     /**
//      * Logout user
//      * @return array
//      */
//     function logout() {
//         $myModel = new My_Model();
//         $reqHeadersData = getRequestHeaders();
//         $sessionToken = $reqHeadersData['token'];
//         $whereArray = [
//             "users_id" => $this->input->post('users_id'),
//             "session_token" => $sessionToken
//         ];
//         $myModel->delete('session', $whereArray, "null");
//         return $resp = [
//             "message" => "logout Successfully",
//             "data" => "null"
//         ];
//     }
}
