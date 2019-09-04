<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class Userdetails extends my_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('model_master');
        $this->load->model('Model_admin_login');
    }
    
    
    public function manage_users()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $data = $this->Manage_User_Data();
            $this->load->view('userdetails/manage-userdetails', $data);
        } else {
            redirect('index');
        }
        
    }
    
    function Manage_User_Data()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_user_mst';
        $sgmnt          = "4";
        
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_master->count_User_List($table_name, $this->input->get());
        
        
        if ($_GET['entries'] != '' && $_GET['filter'] != '') {
            $url = site_url('/master/Userdetails/manage_users?filter=' . $_GET['filter'] . '&entries=' . $_GET['entries']);
        } elseif ($_GET['search'] != '' && $_GET['entries'] != '') {
            $url = site_url('/master/Userdetails/manage_users?filter=' . $_GET['filter'] . '&user=' . $_GET['user'] . '&status=' . $_GET['status'] . '&stage=' . $_GET['stage'] . '&from_date=' . $_GET['from_date'] . '&to_date=' . $_GET['to_date'] . '&entries=' . $_GET['entries']);
        } elseif ($_GET['entries'] != '' && $_GET['search'] == '') {
            $url = site_url('/master/Userdetails/manage_users?entries=' . $_GET['entries']);
        } elseif ($_GET['search'] != '' && $_GET['entries'] == '') {
            $url = site_url('/master/Userdetails/manage_users?filter=' . $_GET['filter'] . '&user=' . $_GET['user'] . '&status=' . $_GET['status'] . '&stage=' . $_GET['stage'] . '&from_date=' . $_GET['from_date'] . '&to_date=' . $_GET['to_date']);
        } else {
            $url = site_url('/master/Userdetails/manage_users?');
        }
        
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        //$data=$this->user_function();      // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('filter') != '') ////filter start ////
            $data['result'] = $this->model_master->filterUserList($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_master->getuserlist($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
    }
    
    public function add_edit_user()
    {
        
        // echo "</pre>";
        // print_r($this->session->userdata);
        // echo "</pre>";
        // die;
        @extract($_POST);
        
        $table_name = 'tbl_user_mst';
        $pri_col    = 'user_id';
        
        $uid = $this->input->post('userid');
        
        
        if ($mobile_no != "") {
            
            $subCatg = json_encode($this->input->post('sub_category'), true);
            $data    = array(
                
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'mobile_no' => $this->input->post('mobile_no'),
                'email_id' => $this->input->post('email_id'),
                //'password'           => $this->input->post('old_password'),
                //'new_password'       => $this->input->post('new_password'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'gender' => $this->input->post('gender'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'pin_code' => $this->input->post('pin_code'),
                
                'buseiness_name' => $this->input->post('buseiness_name'),
                'business_code' => $this->input->post('business_code'),
                'category' => $this->input->post('category'),
                'sub_category' => $subCatg,
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
                echo 1;
            } else {
                $this->Model_admin_login->update_user($pri_col, $table_name, $uid, $data);
                echo 2;
            }
        }
        
    }
    
    function ajax_userData()
    {
        $data = $this->Manage_User_Data();
        $this->load->view('userdetails/load-user-data', $data);
    }
    
    
    
    
    
}
?>