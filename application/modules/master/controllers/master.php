<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class master extends my_controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('model_master');
        $this->load->model('model_admin_login');
    }
    
    
    public function manage_calendar()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('calendar/manage-calendar');
        } else {
            redirect('index');
        }
    }
    
    public function dashboard()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('dashboard/manage-dashboard');
        } else {
            redirect('index');
        }
    }
    
    
    
    public function manage_account()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('account/manage-account');
        } else {
            redirect('index');
        }
    }
    
    
    function userprofileview()
    {
        if ($this->session->userdata('user_id') != "") {
            $this->load->view('view-user-profile');
        } else {
            redirect('index');
        }
    }
    
    
    function changepassword()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('change-password');
        } else {
            redirect('index');
        }
    }
    
    function insertnewpassword()
    {
        $userid  = $this->session->userdata('user_id');
        $oldpass = $this->input->post('old_password');
        $newpass = $this->input->post('new_password');
        
        $query    = $this->db->query("select * from tbl_user_mst where status='A' AND password = '$oldpass' AND user_id = '$userid' ");
        $cntquery = $query->num_rows();
        
        if ($cntquery > 0) {
            $this->db->query("update tbl_user_mst set password = '$newpass' where user_id = '$userid' ");
            $this->session->set_flashdata('msg', 'Password Change Successfully!.');
            redirect('master/Userdetails/setting_user');
        } else {
            $this->session->set_flashdata('errormsg', ' You Entered Wrong Old Password!!.');
            redirect('master/master/changepassword');
        }
    }
    
    
    
    function user_profile()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('profile/manage-profile');
        } else {
            redirect('index');
        }
    }
    
    
    function register_user()
    {
        
        // echo "</pre>";
        // print_r($this->session->userdata);
        // echo "</pre>";
        // die;
        @extract($_POST);
        
        $table_name = 'tbl_user_mst';
        $pri_col    = 'user_id';
        
        $uid = $this->input->post('user_id');
        
        
        $subCatg = json_encode($this->input->post('sub_category'), true);
        $data    = array(
            
            'category' => $this->input->post('category'),
            'sub_category' => $subCatg,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile_no' => $this->input->post('mobile_no'),
            'email_id' => $this->input->post('email_id'),
            'password' => $this->input->post('old_password'),
            'new_password' => $this->input->post('new_password'),
            'date_of_birth' => $this->input->post('dob'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'pin_code' => $this->input->post('pin_code'),
            'buseiness_name' => $this->input->post('buseiness_name'),
            'business_code' => $this->input->post('business_code'),
            'manager_email' => $this->input->post('manager_email'),
            'manager_mobile' => $this->input->post('manager_mobile'),
            'time_from' => $this->input->post('time_from'),
            'time_to' => $this->input->post('time_to')
            
        );
        
        
        $sesio = array(
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
        );
        
        if ($uid == "") {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            redirect('/master/user_profile');
        } else {
            $this->Model_admin_login->update_user($pri_col, $table_name, $uid, $data);
            redirect('/master/user_profile');
        }
        
        
    }
    
    
    function user_signup()
    {
        
        // echo "</pre>";
        // print_r($this->session->userdata);
        // echo "</pre>";
        // die;
        @extract($_POST);
        
        $table_name = 'tbl_user_mst';
        $pri_col    = 'user_id';
        
        $uid = $this->input->post('user_id');
        
        
        $subCatg = json_encode($this->input->post('sub_category'), true);
        $data    = array(
            
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile_no' => $this->input->post('mobile_no'),
            'email_id' => $this->input->post('email_id'),
            'password' => $this->input->post('new_password'),
            
            //'business_code'       => $this->input->post('business_code'),
            'buseiness_name' => $this->input->post('buseiness_name'),
            'category' => $this->input->post('category'),
            'sub_category' => $subCatg,
            
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'pin_code' => $this->input->post('pin_code')
            
        );
        
        
        $sesio = array(
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
        );
        
        if ($uid == "") {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            $this->session->set_flashdata('message', 'User Registered Successfully! Please Login Now.');
            redirect('/index');
        } else {
            $this->Model_admin_login->update_user($pri_col, $table_name, $uid, $data);
            redirect('/index');
        }
        
        
    }
    
    
    function get_sub_catg()
    {
        
        $prmid = $this->input->post('ctg');
        
        $data = $this->db->query("select * from tbl_master_data where param_id='$prmid' ");
        
        //echo "<option value=''>----Select ----</option> ";
        foreach ($data->result() as $getData) {
            echo "<option value=" . $getData->serial_number . ">" . $getData->keyvalue . "</option>";
        }
    }
    
    function edit_sub_catg()
    {
        
        $ctgId    = $this->input->post('ctg');
        $jsonData = json_decode($ctgId, true);
        $subCatg  = implode(",", $jsonData);
        
        if ($subCatg != '') {
            $subCatg = $subCatg;
        } else {
            $subCatg = '99999999';
        }
        
        $sql = $this->db->query("select * from tbl_master_data where serial_number in ($subCatg) ");
        foreach ($sql->result() as $getSql) {
            
            echo "<option value=" . $getSql->serial_number . ">" . $getSql->keyvalue . "</option>";
            
        }
        
    }
    
    
    public function ajax_checkuser()
    {
        
        $val = $this->input->post('val');
        $sql   = "select * from tbl_user_mst where (email_id='".$val."' OR mobile_no='".$val."') AND status = 'A'";
        $query = $this->db->query($sql);
        //print_r($query->result_array());
        if (sizeof($query->result_array()) > 0)
            echo 1;
        else
            echo 0;
        
    }
    
    public function ajax_checkuser_mobile()
    {
        
        $mob   = $this->input->post('val');
        $sql   = "select email_id from tbl_user_mst where mobile_no = '" . $mob . "' AND status = 'A'";
        $query = $this->db->query($sql);
        //print_r($query->result_array());
        if (sizeof($query->result_array()) > 0)
            echo 1;
        else
            echo 0;
        
    }
    
    
    
    public function ajax_checkuser_email()
    {
        
        $email = $this->input->post('val');
        $sql   = "select email_id from tbl_user_mst where email_id = '" . $email . "' AND status = 'A'";
        $query = $this->db->query($sql);
        //print_r($query->result_array());
        if (sizeof($query->result_array()) > 0)
            echo 1;
        else
            echo 0;
        
    }
    
    
    function resetPasswordPage()
    {
        
        if ($this->input->get() != "") {
            $email_id = $this->input->get('cnfrmail');
            $id       = $this->input->get('id');
            
            $sql   = "select * from tbl_user_mst where email_id = '" . $email_id . "' AND user_id = $id";
            $query = $this->db->query($sql)->row();
            
            if (sizeof($query) > 0) {
                $data['result'] = $query;
                // echo "<pre>";
                //  print_r($query);
                // echo "</pre>";
                // if($query->password_status == 'R')
                // {
                //     $this->session->set_flashdata('error', 'Password already reset, Please Login Now!');
                //       redirect('index');    
                // }
                $this->load->view('reset-password', $data);
            }
            
        }
        
    }
    
    function passwordReset()
    {
        
        $userid  = $this->input->post('useridd');
        $email   = $this->input->post('emailid');
        $newpass = $this->input->post('entrpaswrd');
        
        $query    = $this->db->query("select * from tbl_user_mst where status='A' AND email_id='$email' AND user_id='$userid' ");
        $cntquery = $query->num_rows();
        
        if ($cntquery > 0) {
            $this->db->query("update tbl_user_mst set password='$newpass' where user_id = '$userid' ");
            $this->session->set_flashdata('error', 'Password Change Successfully. Now You Can Login !');
            redirect('index');
        }
        
    }
    
    
    
}
?>