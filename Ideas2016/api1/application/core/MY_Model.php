<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MY_Model
 * 
 * 
 * @package    CI
 * @subpackage Model
 * @author     Shahraiz Hasnain Khan shahraiz.hasnain@live.com
 */
class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Karachi");
    }

    /**
     * Insert in table
     * @param string $table
     * @param array $dataArray
     * @return integer/boolean $lastInsertedId/FALSE
     */
    public function insert($table, $dataArray) {
        $this->db->set($dataArray);
        $this->db->insert($table);
        $affectedRows = $this->db->affected_rows();
        if ($affectedRows > 0) {
            $lastInsertedId = $this->db->insert_id();
            return $lastInsertedId;
        } else {
            return FALSE;
        }
    }
    
    public function selectWithMulitpleJoins($fields){
         $this->db->select($fields);
            $this->db->from('users');
            $this->db->join("user_event", "users.user_id = user_event.user_id","inner");
            $this->db->join("events", "events.id = user_event.event_id");
            if (isset($where)) {
                $this->db->where($where);
            }
            return $this->db->get()->result_array();
    }


    /**
     * Update on table
     * @param string $tableName
     * @param array $updateData
     * @param array $where
     * @param array $value
     * @return boolean 
     */
    public function update($tableName, $updateData, $where, $value = NULL) {
        if (is_array($where)) {
            $this->db->where($where);
        } else {
            $this->db->where($where, $value);
        }
        $this->db->update($tableName, $updateData);
        $affectedRows = $this->db->affected_rows();
        if ($affectedRows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Delete from table
     * @param string $tableName
     * @param array $where
     * @param array $value
     * @return boolean
     */
    public function delete($tableName, $where, $value = null) {
        if (is_array($where)) {
            $this->db->where($where);
        } else {
            $this->db->where($where, $value);
        }
        $this->db->delete($tableName);
        $affectedRows = $this->db->affected_rows();
        if ($affectedRows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Select row(s) from table
     * @param string $table
     * @param array $fieldsArray
     * @param array $whereArray
     * @return array
     */
    public function select($table, $fieldsArray, $whereArray = null) {
        $this->db->select($fieldsArray);
        $this->db->from($table);
        if (isset($whereArray)) {
            $this->db->where($whereArray);
        }
        return $this->db->get()->result_array();
    }

    public function selectwherein($table, $fieldsArray, $where1, $where2, $where3, $where4, $where5, $where6, $where7, $where8, $where9) {

        $this->db->select($fieldsArray);
        $this->db->from($table);
        $this->db->or_where_in('user_type', $where1);
        $this->db->or_where_in('user_type', $where2);
        $this->db->or_where_in('user_type', $where3);
        $this->db->or_where_in('user_type', $where4);
        $this->db->or_where_in('user_type', $where5);
        $this->db->or_where_in('user_type', $where6);
        $this->db->or_where_in('user_type', $where7);
        $this->db->or_where_in('user_type', $where8);
        $this->db->or_where_in('user_type', $where9);
     return $this->db->get()->result_array();


    }

    public function selectWithLimit($table, $fieldsArray, $whereArray = null, $offset, $limit) {

        $this->db->select($fieldsArray);
        $this->db->from($table);

        if (isset($whereArray)) {
            $this->db->where($whereArray);
        }
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /**
     * Bulk inser in table
     * @param string $table
     * @param array $dataArray
     */
    public function insertBatch($table, $dataArray) {
        $this->db->insert_batch($table, $dataArray);
        $affectedRows = $this->db->affected_rows();
        if ($affectedRows > 0) {
            $lastInsertedId = $this->db->insert_id();
            return $lastInsertedId;
        } else {
            return FALSE;
        }
    }

    /**
     * Bulk update on table
     * @param string $table
     * @param array $dataArray
     * @param type $whereArray
     */
    public function updateBatch($table, $dataArray, $whereArray = null) {
        if ($whereArray != null) {
            $this->db->update_batch($table, $dataArray, 'title');
        }
    }

    /**
     * Select row(s) from table by joining 
     * with single table
     * @param string $table
     * @param string $joinWith
     * @param array $joinCondition
     * @param array $fields
     * @param array $where
     * @return array
     */
    public function selectWithSingleJoin($table, $joinWith, $joinCondition, $fields, $where = null) {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join($joinWith, $joinCondition);
        if (isset($where)) {
            $this->db->where($where);
        }
        return $this->db->get()->result_array();
    }

    /**
     * Select row(s) from table by joining 
     * with multiple tables
     * @param string $table
     * @param array $fields
     * @param array $where
     * @return array
     */
    public function selectWithMulitpleJoin($table, $fields, $where = null) {
        if ($table === 'admin') {
//SELECT a.*,p.* FROM admin a INNER JOIN admin_privilege ap on a.id = ap.admin_id INNER JOIN privilege p on p.id = ap.privilege_id
            $this->db->select($fields);
            $this->db->from($table);
            $this->db->join("admin_privilege", "admin.id = admin_privilege.admin_id","inner");
            $this->db->join("privilege", "privilege.id = admin_privilege.privilege_id");
            if (isset($where)) {
                $this->db->where($where);
            }
            return $this->db->get()->result_array();
        }
    }

    /**
     * Custom query on table
     * @param string $query
     * @return array
     */
    public function query($query) {
        return $this->db->get($query)->result_array();
    }

}
