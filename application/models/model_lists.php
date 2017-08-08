<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Lists extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }
    
    public function addnew($listName,$userid)
    {
        //debugPrint($_POST);
        $this->db->where(DBConfig::TABLE_LIST_ATT_LIST_NAME,$listName);
        $n = $this->db->get(DBConfig::TABLE_LIST)->num_rows();
        
        if($n < 1)
        {
           $data[DBConfig::TABLE_LIST_ATT_LIST_NAME] = $listName; 
           $data[DBConfig::TABLE_LIST_ATT_LIST_USER_ID] = $userid; 
           $data[DBConfig::TABLE_LIST_ATT_LIST_STATUS] = "1"; 
           $data[DBConfig::TABLE_LIST_ATT_LIST_ADDED_DATE] = time(); 
           
           $i = $this->db->insert(DBConfig::TABLE_LIST,$data);
           
           if($i)
           {
               return '1';
           }
        }
        else
        {
            return '0';
        }
    }
    
    public function getListByUserId($userId)
    {
        $this->db->where(DBConfig::TABLE_LIST_ATT_LIST_USER_ID,$userId);
        $result = $this->db->get(DBConfig::TABLE_LIST)->result_array();
        
        $data = array();
        
        foreach($result as $row)
        {
            $row['date'] = date("F j Y g:i a", $row[DBConfig::TABLE_LIST_ATT_LIST_ADDED_DATE]);
            array_push($data, $row);
        }
        
        return $data;
    }
}