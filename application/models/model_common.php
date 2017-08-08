<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Common extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //
    public function getAllCategory() {
        return $this->db->get(DBConfig::TABLE_CATEGORY)->result_array();
    }

    //
    public function getFAQ() {
        return $this->db->get(DBConfig::TABLE_FAQ)->result_array();
    }
    //
    public function getSitParameter() {
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_TITLE);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_META_KEYWORD);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_META_DESCRIPTION);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_LOGO);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_EMAIL);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_PHONE);
        

        return $this->db->get(DBConfig::TABLE_SETTINGS)->row_array();
    }
    
    public function getSiteContentByName($contentname)
    {
         $this->db->where(DBConfig::TABLE_CONTENT_ATT_CONTENT_NAME, $contentname);

        return $this->db->get(DBConfig::TABLE_CONTENT)->row_array();
    }

}
