<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Administrator extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function dologin() {
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_USERNAME, $_POST['adminUsername']);
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD, md5($_POST['adminPassword']));

        $result = $this->db->get(DBConfig::TABLE_ADMIN)->row_array();

        if (empty($result)) {
            return '0';
        } else {
            $data[DBConfig::TABLE_ADMIN_ATT_ADMIN_LAST_LOGIN_TIME] = time();
            $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_ID, $result[DBConfig::TABLE_ADMIN_ATT_ADMIN_ID]);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_ADMIN);
            return $result;
        }
    }

    public function getSiteContent($contentname = "") {
        $this->db->where(DBConfig::TABLE_CONTENT_ATT_CONTENT_NAME, $contentname);

        return $this->db->get(DBConfig::TABLE_CONTENT)->row_array();
    }

    public function updateSiteContent() {
        $data[DBConfig::TABLE_CONTENT_ATT_CONTENT_TITLE] = $_POST['title'];
        $data[DBConfig::TABLE_CONTENT_ATT_CONTENT_DETAILS] = $_POST['editor1'];
        $this->db->where(DBConfig::TABLE_CONTENT_ATT_CONTENT_NAME, $_POST['contentName']);

        $this->db->set($data);

        $u = $this->db->update(DBConfig::TABLE_CONTENT);


        return $u;
    }

    public function insertFAQ() {
        $data[DBConfig::TABLE_FAQ_ATT_FAQ_QUESTION] = $_POST['Question'];
        $data[DBConfig::TABLE_FAQ_ATT_FAQ_ANSWER] = $_POST['Answer'];
        $data[DBConfig::TABLE_FAQ_ATT_ADDED_TIME] = time();


        $i = $this->db->insert(DBConfig::TABLE_FAQ, $data);
        if ($i)
            return '1';
    }

    public function deletefaq($id = 0) {
        $this->db->where(DBConfig::TABLE_FAQ_ATT_FAQ_ID, $id);
        $d = $this->db->delete(DBConfig::TABLE_FAQ);

        if ($d)
            return '1';
    }

    public function updateSiteParameter() {
        if ($_FILES['userfile']['name'] == true) {
            $path = "assets/public/site/";

            $imagefilename = uniqid() . basename($_FILES['userfile']['name']);

            $target = $path . $imagefilename;

            $allowedType = array("image/jpg", "image/jpeg", "image/gif", "image/png");
            $extension = $_FILES["userfile"]["type"];

            if (in_array($extension, $allowedType)) {
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target)) {
                    $imagename = $imagefilename;
                    $data[DBConfig::TABLE_SETTINGS_ATT_SITE_LOGO] = $imagename;
                }
            }
        }

        // exit();


        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_TITLE] = trim($_POST['siteTitle']);
        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_META_KEYWORD] = trim($_POST['siteMetaKeyword']);
        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_META_DESCRIPTION] = trim($_POST['siteMetaDescription']);

        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_EMAIL] = trim($_POST['siteEmail']);
        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_PHONE] = trim($_POST['sitePhone']);


        $this->db->where(DBConfig::TABLE_SETTINGS_ATT_ID, '1');
        $this->db->set($data);
        $u = $this->db->update(DBConfig::TABLE_SETTINGS);

        if ($u) {
            return '1';
        }
    }

    public function insertNewImage() {
        if ($_FILES['userfile']['name'] == true) {
            $path = "assets/public/site/";

            $imagefilename = uniqid() . basename($_FILES['userfile']['name']);

            $target = $path . $imagefilename;

            $allowedType = array("image/jpg", "image/jpeg", "image/gif", "image/png");
            $extension = $_FILES["userfile"]["type"];

            if (in_array($extension, $allowedType)) {
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target)) {
                    $imagename = $imagefilename;
                    $data[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_IMAGE] = $imagename;
                }
            }
        }

        $data[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME] = trim($_POST['catTitle']);
        $data[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_DETAILS] = trim($_POST['catDetails']);

        $i = $this->db->insert(DBConfig::TABLE_CATEGORY, $data);

        if ($i)
            return 1;
    }

    public function changepassword() {
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD, md5($_POST['old_password']));
        $result = $this->db->get(DBConfig::TABLE_ADMIN)->row_array();
        if (!empty($result)) {

            $data[DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD] = md5($_POST['new_password']);
            $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD, md5($_POST['old_password']));

            $this->db->set($data);

            $u = $this->db->update(DBConfig::TABLE_ADMIN);

            if ($u) {
                return '1';
            }
        }
    }

    public function insertService() {
        $serviceName = strtolower($_POST['service-name']);
        $serviceDetails = strtolower($_POST['service-details']);

        $this->db->where(DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_NAME, $serviceName);
        $result = $this->db->get(DBConfig::TABLE_SERVICE_LIST)->num_rows();

        if ($result < 1) {
            $data[DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_NAME] = $serviceName;

            $this->db->insert(DBConfig::TABLE_SERVICE_LIST, $data);

            $lastId = $this->db->insert_id();

            $data1[DBConfig::TABLE_SERVICE_DETAILS_ATT_SERVICE_LIST_ID] = $lastId;
            $data1[DBConfig::TABLE_SERVICE_DETAILS_ATT_SERVICE_DETAILS] = $serviceDetails;

            $s = $this->db->insert(DBConfig::TABLE_SERVICE_DETAILS, $data1);

            if ($s)
                return 1;
        }
        else {
            return 0;
        }
    }

    public function getService() {
        $sql = 'SELECT ' . DBConfig::TABLE_SERVICE_LIST . '.*, ' . DBConfig::TABLE_SERVICE_DETAILS . '.*' .
                ' FROM ' . DBConfig::TABLE_SERVICE_LIST .
                ' LEFT JOIN ' . DBConfig::TABLE_SERVICE_DETAILS . ' ON ' . DBConfig::TABLE_SERVICE_LIST . '.' . DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_ID . ' = ' . DBConfig::TABLE_SERVICE_DETAILS . '.' . DBConfig::TABLE_SERVICE_DETAILS_ATT_SERVICE_LIST_ID
        ;

        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    public function deleteservice($serviceId) {
        $this->db->where(DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_ID, $serviceId);
        $this->db->delete(DBConfig::TABLE_SERVICE_LIST);

        $this->db->where(DBConfig::TABLE_SERVICE_DETAILS_ATT_SERVICE_LIST_ID, $serviceId);
        $this->db->delete(DBConfig::TABLE_SERVICE_DETAILS);

        return 1;
    }

    public function getAllCategory() {
        return $this->db->get(DBConfig::TABLE_CATEGORY)->result_array();
    }

    public function deleteCategory($id) {
        $this->db->where(DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID, $id);

        $result = $this->db->get(DBConfig::TABLE_CATEGORY)->row_array();

        $filename = 'assets/public/site/' . $result[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_IMAGE];

        unlink($filename);

        $this->db->where(DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID, $id);

        $d = $this->db->delete(DBConfig::TABLE_CATEGORY);

        if ($d) {
            return 1;
        }
    }

    public function getCategoryDetails($id) {
        $this->db->where(DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_CATEGORY)->row_array();

        return $result;
    }

    public function updateCategory($id) {
        if ($_FILES['userfile']['name'] == true) {

            $this->db->where(DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID, $id);

            $result = $this->db->get(DBConfig::TABLE_CATEGORY)->row_array();

            if ($result[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_IMAGE] == true) {

                $filename = 'assets/public/site/' . $result[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_IMAGE];

                unlink($filename);
            }

            $path = "assets/public/site/";

            $imagefilename = uniqid() . basename($_FILES['userfile']['name']);

            $target = $path . $imagefilename;

            $allowedType = array("image/jpg", "image/jpeg", "image/gif", "image/png");
            $extension = $_FILES["userfile"]["type"];

            if (in_array($extension, $allowedType)) {
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target)) {
                    $imagename = $imagefilename;
                    $data[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_IMAGE] = $imagename;
                }
            }
        }

        $data[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME] = trim($_POST['catTitle']);
        $data[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_DETAILS] = trim($_POST['catDetails']);

        $this->db->set($data);

        $this->db->where(DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID, $id);

        $i = $this->db->update(DBConfig::TABLE_CATEGORY);

        if ($i)
            return 1;
    }

    public function updateServices($id) {
        if ($_FILES['userfile']['name'] == true) {

            $this->db->where(DBConfig::TABLE_SERVICE_ATT_SERVICE_ID, $id);

            $result = $this->db->get(DBConfig::TABLE_SERVICE)->row_array();

            if ($result[DBConfig::TABLE_SERVICE_ATT_SERVICE_IMAGE] == true) {

                $filename = 'assets/public/site/' . $result[DBConfig::TABLE_SERVICE_ATT_SERVICE_IMAGE];

                unlink($filename);
            }

            $path = "assets/public/site/";

            $imagefilename = uniqid() . basename($_FILES['userfile']['name']);

            $target = $path . $imagefilename;

            $allowedType = array("image/jpg", "image/jpeg", "image/gif", "image/png");
            $extension = $_FILES["userfile"]["type"];

            if (in_array($extension, $allowedType)) {
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target)) {
                    $imagename = $imagefilename;
                    $data[DBConfig::TABLE_SERVICE_ATT_SERVICE_IMAGE] = $imagename;
                }
            }
        }

        $data[DBConfig::TABLE_SERVICE_ATT_SERVICE_NAME] = trim($_POST['serTitle']);
        $data[DBConfig::TABLE_SERVICE_ATT_SERVICE_DETAILS] = trim($_POST['serDetails']);

        $this->db->set($data);

        $this->db->where(DBConfig::TABLE_SERVICE_ATT_SERVICE_ID, $id);

        $i = $this->db->update(DBConfig::TABLE_SERVICE);

        if ($i)
            return 1;
    }

    public function getAdditinalServices() {
        return $this->db->get(DBConfig::TABLE_SERVICE)->result_array();
    }

    public function getServiceDetails($id) {
        $this->db->where(DBConfig::TABLE_SERVICE_ATT_SERVICE_ID, $id);
        return $result = $this->db->get(DBConfig::TABLE_SERVICE)->row_array();
    }

    public function deleteServiceImage($serviceId) {
        $this->db->where(DBConfig::TABLE_SERVICE_ATT_SERVICE_ID, $serviceId);

        $result = $this->db->get(DBConfig::TABLE_SERVICE)->row_array();
        //debugPrint($result[DBConfig::TABLE_SERVICE_ATT_SERVICE_IMAGE]);

        if ($result[DBConfig::TABLE_SERVICE_ATT_SERVICE_IMAGE] == true) {

            $filename = 'assets/public/site/' . $result[DBConfig::TABLE_SERVICE_ATT_SERVICE_IMAGE];

            unlink($filename);
//            $this->db->where(DBConfig::TABLE_SERVICE_ATT_SERVICE_ID, $serviceId);
//
//            $this->db->delete(DBConfig::TABLE_SERVICE);
            return 1;
        }
    }

}

?>
