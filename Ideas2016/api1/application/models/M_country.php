<?php

/**
 * M_Country Class
 * 
 * 
 * @package    CI
 * @subpackage Model
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
class M_country extends MY_Model {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('M_user');
        date_default_timezone_set("Asia/Karachi");
    }

    /**
     * Returns specific of country
     * @return array 
     */
    function getSpecificCountry() {
        $myModel = new My_Model();
        $countryName = "Pakistan";
        $whereArray = [
            "country_name" => $countryName
        ];
        $result = $myModel->select('countries', "*", $whereArray);
        if (count($result) === 1) {
            return $result = [
                "message" => "countries list",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no country available",
                "data" => "null"
            ];
        }
    }

    /**
     * Returns list of countries
     * @return array 
     */
    function getAllCountries() {
        $myModel = new My_Model();
        $result = $myModel->select('countries', "*", null);
        if (count($result) > 1) {
            return $result = [
                "message" => "countries list",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no country available",
                "data" => "null"
            ];
        }
    }

    /**
     * Returns list of states
     * @param integer $countryId
     * @return array
     */
    function getStatesBehalfCountry($countryId) {
        $myModel = new My_Model();
        $whereArray = [
            "country_id" => $countryId
        ];
        $result = $myModel->select('states', "*", $whereArray);
        if (count($result) > 1) {
            return $result = [
                "message" => "states list",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no state available",
                "data" => "null"
            ];
        }
    }

    /**
     * Returns list of cities
     * @param integer $stateId
     * @return array
     */
    function getCitiesBehalfState($stateId) {
        $myModel = new My_Model();
        $whereArray = [
            "state_id" => $stateId
        ];
        $result = $myModel->select('cities', "*", $whereArray);
        if (count($result) > 1) {
            return $result = [
                "message" => "cities list",
                "data" => $result
            ];
        } else {
            return $resp = [
                "message" => "no city available",
                "data" => "null"
            ];
        }
    }

}
