<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Business extends CI_Model {

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

    public function getBusinessCategory() {
        return $this->db->get(DBConfig::TABLE_BUSINESS_CATEGORY)->result_array();
    }

    public function addNewBusiness($userId) {
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_TITLE] = $this->input->post('business-name');
        $data[DBConfig::TABLE_BUSINESS_ATT_LIST_ID] = $this->input->post('list-id');
        $data[DBConfig::TABLE_BUSINESS_ATT_USER_ID] = $userId;
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_CATEGORY_ID] = $this->input->post('business-category');
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_SUB_CATEGORY_ID] = json_encode($this->input->post('business-subcategory'));
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_DETAILS] = $this->input->post('description');
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_WEBSITE_URL] = $this->input->post('business-website');
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_ABOUT] = $this->input->post('about');
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_RESERVATION_STATUS] = $this->input->post('brs');
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_MENU_STATUS] = $this->input->post('bms');
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_STATE_ID] = $this->input->post('state');
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_CITY_ID] = $this->input->post('city');
        $data[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_ADDED_DATE] = time();



        $i = $this->db->insert(DBConfig::TABLE_BUSINESS, $data);

        $lastId = $this->db->insert_id();

        $config['upload_path'] = 'assets/public/business/';
        $config['allowed_types'] = "gif|jpg|png|bmp|jpeg";
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = "10024"; //define in KB
        $this->load->library('upload');
        $filename = '';

        $this->load->library('upload', $config);

        foreach ($_FILES as $key => $value) {
            if (!empty($key['name'])) {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($key)) {
                    $errors[] = $this->upload->display_errors();
                } else {
                    $temp = array('upload_data' => $this->upload->data());
                    $info = $this->upload->data();
                    $filename = $info['file_name'];

                    $bi[DBConfig::TABLE_BUSINESS_IMAGES_ATT_BUSINESS_ID] = $lastId;
                    $bi[DBConfig::TABLE_BUSINESS_IMAGES_ATT_IMAGE_NAME] = $filename;
                    $bi[DBConfig::TABLE_BUSINESS_IMAGES_ATT_USER_ID] = $userId;

                    $this->db->insert(DBConfig::TABLE_BUSINESS_IMAGES, $bi);
                }
            }
        }

        for ($i = 1; $i <= sizeof($_POST['menu-title']); $i++) {
            if ($_POST['menu-title'] != "") {
                $menu[DBConfig::TABLE_BUSINESS_MENU_ATT_BUSINESS_ID] = $lastId;
                $menu[DBConfig::TABLE_BUSINESS_MENU_ATT_MENU_TITLE] = $_POST['menu-title'][$i];
                $menu[DBConfig::TABLE_BUSINESS_MENU_ATT_MENU_DETAILS] = $_POST['menu-details'][$i];
                $menu[DBConfig::TABLE_BUSINESS_MENU_ATT_MENU_PRICE] = $_POST['menu-price'][$i];


                $this->db->insert(DBConfig::TABLE_BUSINESS_MENU, $menu);
            }
        }

        for ($i = 1; $i <= sizeof($_POST['attribute-title']); $i++) {

            if ($_POST['attribute-title'] != "") {
                $att[DBConfig::TABLE_BUSINESS_ATTRIBUTE_ATT_BUSINESS_ID] = $lastId;
                $att[DBConfig::TABLE_BUSINESS_ATTRIBUTE_ATT_BUSINESS_ATTRIBUTE_TITLE] = $_POST['attribute-title'][$i];
                $att[DBConfig::TABLE_BUSINESS_ATTRIBUTE_ATT_BUSINESS_ATTRIBUTE_VALUE] = $_POST['attribute-value'][$i];

                $this->db->insert(DBConfig::TABLE_BUSINESS_ATTRIBUTE, $att);
            }
        }

        if ($i) {
            return '1';
        }
    }
    
    public function getBusinessListByUserId($userId)
    {
        $this->db->select(DBConfig::TABLE_BUSINESS_ATT_BUSINESS_ID);
        $this->db->select(DBConfig::TABLE_BUSINESS_ATT_BUSINESS_TITLE);
        $this->db->select(DBConfig::TABLE_BUSINESS_ATT_BUSINESS_ADDED_DATE);
        $this->db->where(DBConfig::TABLE_BUSINESS_ATT_USER_ID,$userId);
        
        $result = $this->db->get(DBConfig::TABLE_BUSINESS)->result_array();
        
        $data = array();
        
        foreach($result as $row)
        {
            $row['date'] = date("F j Y g:i a", $row[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_ADDED_DATE]);
            $row['secret'] = encode($row[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_ID]);
            array_push($data, $row);
        }
        
        return $data;
    }
    
    public function getBusinessInfo($string)
    {
        $id = decode($string);
        
        $this->db->where(DBConfig::TABLE_BUSINESS_ATT_BUSINESS_ID,$id);
        
        $result = $this->db->get(DBConfig::TABLE_BUSINESS)->row_array();
        
        $result['category'] = $this->getCategoriName($result[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_CATEGORY_ID]);
        
        $result['sub-category'] = $this->getSubCategories($result[DBConfig::TABLE_BUSINESS_ATT_BUSINESS_SUB_CATEGORY_ID]);
        
        $result['images'] = $this->getImages($id);
        
        $result['attribute'] = $this->getAttribute($id);
        
        return $result;
    }
    
    public function getCategoriName($id)
    {
        $this->db->where(DBConfig::TABLE_BUSINESS_CATEGORY_ATT_CATEGORY_ID,$id);
        
        $result = $this->db->get(DBConfig::TABLE_BUSINESS_CATEGORY)->row_array();
        
        return $result[DBConfig::TABLE_BUSINESS_CATEGORY_ATT_CATEGORY_NAME];
    }


    public function getImages($id)
    {
        $this->db->select(DBConfig::TABLE_BUSINESS_IMAGES_ATT_IMAGE_NAME);
        $this->db->where(DBConfig::TABLE_BUSINESS_IMAGES_ATT_BUSINESS_ID,$id);
        $result = $this->db->get(DBConfig::TABLE_BUSINESS_IMAGES)->result_array();
        
        $data = array();
        
        foreach($result as $key=> $r)
        {
            //$c['info'] = array();
            if($key==0)
            {
                $p = 'top';
            }
            else{
                $p = "";
            }
            $d['pos'] = $p;
            $d['name'] = $r[DBConfig::TABLE_BUSINESS_IMAGES_ATT_IMAGE_NAME];
            
            array_push($data, $d);
        }
        
        return $data;
    }
    
    public function getAttribute($id)
    {
        $this->db->select(DBConfig::TABLE_BUSINESS_ATTRIBUTE_ATT_BUSINESS_ATTRIBUTE_TITLE);
        $this->db->select(DBConfig::TABLE_BUSINESS_ATTRIBUTE_ATT_BUSINESS_ATTRIBUTE_VALUE);
        $this->db->where(DBConfig::TABLE_BUSINESS_ATTRIBUTE_ATT_BUSINESS_ID,$id);
        return $this->db->get(DBConfig::TABLE_BUSINESS_ATTRIBUTE)->result_array();
    }


    public function getSubCategories($json)
    {
        $categoris = json_decode($json);
        
        $data = array();
        
        foreach($categoris as $r)
        {
            //$c['info'] = array();
            $d['id'] = $r;
            $d['name'] = $this->getSubCategoryName($r);
            
            array_push($data, $d);
        }
        
        return $data;
    }
    
    public function getSubCategoryName($id)
    {
        $this->db->where(DBConfig::TABLE_BUSINESS_SUB_CATEGORY_ATT_SUB_CATEGORY_ID,$id);
        
        $result = $this->db->get(DBConfig::TABLE_BUSINESS_SUB_CATEGORY)->row_array();
        
        return $result[DBConfig::TABLE_BUSINESS_SUB_CATEGORY_ATT_SUB_CATEGORY_NAME];
    }
    
    public function getSubcategory($id)
    {
        $this->db->select(DBConfig::TABLE_BUSINESS_SUB_CATEGORY_ATT_SUB_CATEGORY_ID);
        $this->db->select(DBConfig::TABLE_BUSINESS_SUB_CATEGORY_ATT_SUB_CATEGORY_NAME);
        
        $this->db->where(DBConfig::TABLE_BUSINESS_SUB_CATEGORY_ATT_CATEGORY_ID,$id);
        
        $result = $this->db->get(DBConfig::TABLE_BUSINESS_SUB_CATEGORY)->result_array();
        
        return $result;
    }

}
