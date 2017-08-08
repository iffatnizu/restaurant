<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_User extends CI_Model {

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

    public function emailAddressCheck($email = "") {
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS, $email);
        $query = $this->db->get(DBConfig::TABLE_USER);

        if ($query->num_rows() == 1) {
            return '1';
        } else {
            return '0';
        }
    }

    public function userSignup() {
        $token = md5(microtime());

        $data[DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS] = $this->input->post('email');
        $data[DBConfig::TABLE_USER_ATT_USER_PASSWORD] = md5($this->input->post('password'));
        $data[DBConfig::TABLE_USER_ATT_USER_REGISTRATION_DATE] = time();
        $data[DBConfig::TABLE_USER_ATT_USER_STATUS] = '0';
        $data[DBConfig::TABLE_USER_ATT_USER_REGISTRATION_TOKEN] = $token;


        $insert = $this->db->insert(DBConfig::TABLE_USER, $data);

        $lastId = $this->db->insert_id();

        $info[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] = $this->input->post('first-name');
        $info[DBConfig::TABLE_USER_INFO_ATT_USER_LAST_NAME] = $this->input->post('last-name');
        $info[DBConfig::TABLE_USER_INFO_ATT_USER_ZIP_CODE] = $this->input->post('zip');
        $info[DBConfig::TABLE_USER_INFO_ATT_USER_ID] = $lastId;
        $info[DBConfig::TABLE_USER_INFO_ATT_USER_DOB] = $this->input->post('month') . " " . $this->input->post('day') . " " . $this->input->post('year');

        $this->db->insert(DBConfig::TABLE_USER_INFO, $info);

        if ($insert) {
            $sess['successMsg'] = '<b>User successfully registered</b>.Your account is not active yet.please check your email for activition link.';
            $this->session->set_userdata($sess);
        }

        $this->email->from(SiteConfig::CONFIG_ADMIN_EMAIL, 'Site administrator');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Account activation link');
        $body = "<p>Thank you for registration in restaurant.com</p><br/>";
        $link = base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_ACCOUNT . 'activation/' . $token;
        $body.= '<p>Click the following link to activate your account.<a href="' . $link . '">Link</a></p><br/>';
        $body.= '<p>if the above link does not work copy past the url on your browser.<a>' . $link . '</a></p><br/>';
        $this->email->message($body);

        $this->email->send();

        //echo $body;
        //exit();
        redirect(site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SIGN_UP));

        //echo $this->email->print_debugger();
    }

    public function userAccountActivation($name, $token) {
        $link = base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN;

        if ($name == 'activation' && $token != "") {
            $this->db->where(DBConfig::TABLE_USER_ATT_USER_REGISTRATION_TOKEN, $token);
            $result = $this->db->get(DBConfig::TABLE_USER)->row_array();

            if (!empty($result)) {
                if ($result[DBConfig::TABLE_USER_ATT_USER_STATUS] == '0') {

                    $data[DBConfig::TABLE_USER_ATT_USER_STATUS] = '1';
                    $this->db->where(DBConfig::TABLE_USER_ATT_USER_REGISTRATION_TOKEN, $token);
                    $this->db->set($data);
                    $this->db->update(DBConfig::TABLE_USER);

                    $sess['activeMsg'] = '<div class="alert alert-success"><b>User account successfully activated</b>.please <a href="' . $link . '">login</a> to continue.</div>';
                    $this->session->set_userdata($sess);
                } elseif ($result[DBConfig::TABLE_USER_ATT_USER_STATUS] == '1') {
                    $sess['activeMsg'] = '<div class="alert alert-warning"><b>User account already activated</b>.please <a href="' . $link . '">login</a> to continue.</div>';
                    $this->session->set_userdata($sess);
                }
            } else {
                $sess['activeMsg'] = '<div class="alert alert-danger"><b>Invalid activation link</b>.please <a href="' . $link . '">login</a> to continue.</div>';
                $this->session->set_userdata($sess);
            }
        } else {
            redirect(base_url());
        }
    }

    public function userLogin() {

        $sql = 'SELECT  ' . DBConfig::TABLE_USER . '.*,
                        ' . DBConfig::TABLE_USER_INFO . '.' . DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME .
                ' FROM ' . DBConfig::TABLE_USER .
                ' LEFT JOIN ' . DBConfig::TABLE_USER_INFO .
                ' ON ' . DBConfig::TABLE_USER_INFO . '.' . DBConfig::TABLE_USER_INFO_ATT_USER_ID . ' = ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_ID .
                ' WHERE ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS . ' = "' . $this->input->post('email') . '"' .
                ' AND ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_PASSWORD . ' = "' . md5($this->input->post('password')) . '"' .
                ' AND ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_STATUS . ' = 1'
        ;
        //echo $sql;

        $result = $this->db->query($sql)->row_array();

        if (!empty($result)) {
            $session['_userLogin'] = TRUE;
            $session['_userID'] = $result[DBConfig::TABLE_USER_ATT_USER_ID];
            $session['_userDisplayName'] = $result[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME];

            $this->session->set_userdata($session);

            redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_DASHBOARD);
        } else {
            $session['invalidMsg'] = "Invalid UserID or Password";
            $this->session->set_userdata($session);
            redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN);
        }
    }

    public function getUserInfo($userId) {
        $sql = 'SELECT  ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS . ',
                        ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_REGISTRATION_DATE . ',
                        ' . DBConfig::TABLE_USER_INFO . '.*' .
                ' FROM ' . DBConfig::TABLE_USER .
                ' LEFT JOIN ' . DBConfig::TABLE_USER_INFO .
                ' ON ' . DBConfig::TABLE_USER_INFO . '.' . DBConfig::TABLE_USER_INFO_ATT_USER_ID . ' = ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_ID .
                ' WHERE ' . DBConfig::TABLE_USER . '.' . DBConfig::TABLE_USER_ATT_USER_ID . ' = "' . $userId . '"'
        ;
        //echo $sql;

        $result = $this->db->query($sql)->row_array();
        if ($result[DBConfig::TABLE_USER_INFO_ATT_USER_STATE_ID] == true) {
            $result['stateinfo'] = $this->getStateNameById($result[DBConfig::TABLE_USER_INFO_ATT_USER_STATE_ID]);
            $result['cityinfo'] = $this->getCityNameById($result[DBConfig::TABLE_USER_INFO_ATT_USER_CITY_ID]);
            $result['statecity'] = $this->getCityByState($result[DBConfig::TABLE_USER_INFO_ATT_USER_STATE_ID]);
        }

        return $result;
    }

    public function getStateNameById($id) {
        $this->db->where(DBConfig::TABLE_STATES_ATT_STATE_SHORT_NAME, $id);
        $result = $this->db->get(DBConfig::TABLE_STATES)->row_array();

        return $result[DBConfig::TABLE_STATES_ATT_STATE_NAME];
    }

    public function getCityNameById($id) {
        $this->db->where(DBConfig::TABLE_CITY_ATT_CITY_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_CITY)->row_array();

        return $result[DBConfig::TABLE_CITY_ATT_CITY_NAME];
    }

    public function getAllStates() {
        return $this->db->get(DBConfig::TABLE_STATES)->result_array();
    }

    public function getCityByState($id) {
        $this->db->where(DBConfig::TABLE_CITY_ATT_STATE_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_CITY)->result_array();

        return $result;
    }

    public function editprofile($userId) {

        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_STATUS, "1");
        $num = $this->db->get(DBConfig::TABLE_USER)->num_rows();

        if ($num > 0) {

            $path = "assets/public/profile/";
            $imageFile = basename($_FILES['userfile']['name']);
            $tmpName = $_FILES['userfile']['tmp_name'];
            $fileName = uniqid() . $imageFile;
            $target = $path . $fileName;

            $allowedType = array("image/jpg", "image/jpeg", "image/gif", "image/png");
            $extension = $_FILES["userfile"]["type"];

            if (in_array($extension, $allowedType)) {
                if (move_uploaded_file($tmpName, $target)) {
                    $info[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] = $fileName;
                }
            }

            $info[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] = $this->input->post('first-name');
            $info[DBConfig::TABLE_USER_INFO_ATT_USER_LAST_NAME] = $this->input->post('last-name');
            $info[DBConfig::TABLE_USER_INFO_ATT_USER_ZIP_CODE] = $this->input->post('zip');
            $info[DBConfig::TABLE_USER_INFO_ATT_USER_STATE_ID] = $this->input->post('state');
            $info[DBConfig::TABLE_USER_INFO_ATT_USER_CITY_ID] = $this->input->post('city');
            $info[DBConfig::TABLE_USER_INFO_ATT_USER_ADDRESS] = $this->input->post('address');
            $info[DBConfig::TABLE_USER_INFO_ATT_USER_PHONE] = $this->input->post('phone');

            $this->db->where(DBConfig::TABLE_USER_INFO_ATT_USER_ID, $userId);
            $this->db->set($info);
            $this->db->update(DBConfig::TABLE_USER_INFO);

            $sess['activeMsg'] = '<div class="alert alert-success"><b>User account info successfully changed</b></div>';
            $this->session->set_userdata($sess);

            redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_EDIT_PROFILE);
        } else {
            redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGOUT);
        }
    }

    public function changepassword($userId) {
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_STATUS, "1");
        $num = $this->db->get(DBConfig::TABLE_USER)->num_rows();

        if ($num > 0) {
            $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userId);
            $this->db->where(DBConfig::TABLE_USER_ATT_USER_PASSWORD, md5($this->input->post('old-password')));

            $result = $this->db->get(DBConfig::TABLE_USER)->row_array();

            if (!empty($result)) {
                $data[DBConfig::TABLE_USER_ATT_USER_PASSWORD] = md5($this->input->post('new-password'));
                $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userId);
                $this->db->set($data);
                $this->db->update(DBConfig::TABLE_USER);

                $this->email->from(SiteConfig::CONFIG_ADMIN_EMAIL, 'Site administrator');
                $this->email->to($this->input->post('email'));
                $this->email->subject('Password change confirmation');
                $body = "<p>We noticed that </p><br/>";
                $body.= '<p>your password is changed from ip address ' . $_SERVER['REMOTE_ADDR'] . ' </p><br/>';
                $body.= '<p>if you did not notice that please contact our security team.</p><br/>';
                $this->email->message($body);

                $this->email->send();



                $sess['activeMsg'] = '<div class="alert alert-success"><b>Password successfully changed</b></div>';
                $this->session->set_userdata($sess);

                redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_CHANGE_PASSWORD);
            } else {
                $sess['activeMsg'] = '<div class="alert alert-danger"><b>Old password does not match</b></div>';
                $this->session->set_userdata($sess);
            }
        } else {
            redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGOUT);
        }
    }

    public function forgotpassword() {
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS, $this->input->post('email'));
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_STATUS, "1");

        $result = $this->db->get(DBConfig::TABLE_USER)->row_array();

        if (!empty($result)) {
            $newpassword = substr(uniqid(),0,8);

            $data[DBConfig::TABLE_USER_ATT_USER_PASSWORD] = md5($newpassword);
            $this->db->where(DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS, $this->input->post('email'));
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_USER);

            $this->email->from(SiteConfig::CONFIG_ADMIN_EMAIL, 'Site administrator');
            $this->email->to($this->input->post('email'));
            $this->email->subject('Forgot password confirmation');
            $body = "<p>We noticed that </p><br/>";
            $body.= '<p>you request a new password from ip address ' . $_SERVER['REMOTE_ADDR'] . ' </p><br/>';
            $body.= '<p>your new password is <b>' . $newpassword . '</b>.It is strongly recommended that you changed your password immediately.if you did not notice that please contact our security team.</p><br/>';
            $this->email->message($body);

            $this->email->send();

            //echo $body;

            //exit();

            $sess['activeMsg'] = '<div class="alert alert-success"><b>Password successfully changed</b></div>';
            $this->session->set_userdata($sess);
        } else {
            $sess['activeMsg'] = '<div class="alert alert-danger"><b>Invalid email address</b></div>';
            $this->session->set_userdata($sess);
        }
    }

}
