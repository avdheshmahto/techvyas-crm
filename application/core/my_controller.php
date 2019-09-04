<?php
(defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */

class my_controller extends MX_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_admin_login');
    }
    
    
    public function set_dashboard()
    {
        
        date_default_timezone_set("Asia/Kolkata");
        
        if ($this->session->userdata('is_logged_in')) {
            redirect('master/index');
        }
        
        //print_r($this->input->post());die;
        $email    = $this->input->post('username');
        $password = $this->input->post('password');
        
        
        $userQuery = $this->db->query("SELECT * FROM tbl_user_mst where status='A' and (email_id='$email' OR mobile_no='$email') and password='$password'");
        
        if ($this->input->post('confirmid') != "") {
            
            $user_id   = $this->input->post('useridd');
            $confirmid = $this->input->post('confirmid');
            $newpaswrd = $this->input->post('entrpaswrd');
            
            $userQuery = $this->db->query("SELECT * FROM tbl_user_mst where status = 'I' and email_id = '$email' and password = '$password' AND user_id = '$user_id' AND confirm_email = '" . $confirmid . "'");
            
        }
        $fetchUser = $userQuery->row();
        $this->session->set_flashdata('flash_msg', $fetchUser->last_login);
        $count = $userQuery->num_rows();
        
        $roleQuery = $this->db->query("update tbl_user_mst set logged_in= 1  where   user_id='" . $fetchUser->user_id . "'");
        
        
        $sess_array = array(
            
            'user_id' => $fetchUser->user_id,
            //'user_id' => 21,
            'is_logged_in' => 1,
            'user_name' => $fetchUser->user_name,
            'brnh_id' => $fetchUser->brnh_id,
            'author_id' => $fetchUser->author_id,
            'maker_id' => $fetchUser->maker_id,
            'role' => $fetchUser->profile_user,
            //'profile'       => $fetchUser->role,
            'last_login' => $fetchUser->last_login
            //role and profile id reverse 28-11-2018
        );
        
        if ($count > 0 && $this->input->post('confirmid') != "") {
            $roleQuery = $this->db->query("update tbl_user_mst set password='" . $newpaswrd . "',logged_in= 1,emailvarified=1,status = 'A'  where   user_id='" . $fetchUser->user_id . "'");
            
            $this->session->set_userdata(@$sess_array);
            redirect('master/dashboard');
        } elseif ($count > 0) {
            $roleQuery = $this->db->query("update tbl_user_mst set  logged_in= 1,status = 'A'  where   user_id='" . $fetchUser->user_id . "'");
            
            $this->session->set_userdata(@$sess_array);
            redirect('Register/manage_register');
        } {
            $this->session->set_flashdata('error', 'Sorry, We did not recognize this email id/mobile number or password !.');
            redirect('index');
        }
        
    }
    
    
    function index()
    {
        if ($this->session->userdata('is_logged_in')) {
            redirect('master/dashboard');
        } else {
            redirect('index');
        }
    }
    
    public function sign_up()
    {
        $this->load->view('signup');
    }
    
    
    
    public function logout()
    {
        $user_id   = $this->session->userdata('user_id');
        $roleQuery = $this->db->query("update tbl_user_mst set logged_in= 0 where   user_id='" . $user_id . "'");
        $this->session->sess_destroy();
        redirect('/index');
    }
    
    
    
    public function forgot_page()
    {
        $this->load->view('forgotpass');
    }
    
    
    
    
    public function error_page()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('invalid_url');
        } else {
            $this->load->view('index');
        }
    }
    
    
    //================================*Start single delete data ============== 
    
    
    function delete_data()
    {
        $this->load->model('Model_admin_login');
        $getdata    = $_GET['id'];
        $dataex     = explode("^", $getdata);
        $id         = $dataex[0];
        $table_name = $dataex[1];
        $pri_col    = $dataex[2];
        
        $this->Model_admin_login->delete_user($pri_col, $table_name, $id);
    }
    
    
    function delete_data_user()
    {
        $this->load->model('Model_admin_login');
        $getdata    = $_GET['id'];
        $dataex     = explode("^", $getdata);
        $id         = $dataex[0];
        $table_name = $dataex[1];
        $pri_col    = $dataex[2];
        
        $this->Model_admin_login->delete_user($pri_col, $table_name, $id);
    }
    
    function delete_data_customers()
    {
        $this->load->model('Model_admin_login');
        $getdata    = $_GET['id'];
        $dataex     = explode("^", $getdata);
        $id         = $dataex[0];
        $table_name = $dataex[1];
        $pri_col    = $dataex[2];
        
        $table_name_log = tbl_customers_log;
        $pri_col_log    = customer_id;
        
        $this->Model_admin_login->delete_user($pri_col, $table_name, $id);
        $this->Model_admin_login->delete_user($pri_col_log, $table_name_log, $id);
    }
    
    //================================* Start Multiple delete table data ============== 
    function multiple_delete_table()
    {
        
        $id = $_POST['ids'];
        
        $tabledata     = $_POST['table_name'];
        $table_name_ex = explode("^", $tabledata);
        
        $pri_data   = $_POST['pri_col'];
        $pri_col_ex = explode("^", $pri_data);
        
        $this->db->query("delete from $tabledata where $pri_data in($id)");
        
    }
    //================================Close Multiple delete table data ============== 
    
    
    
    //================================*Start multiple_delete_two_table==================
    function multiple_delete_two_table()
    {
        $id = $_POST['ids'];
        
        $tabledata      = $_POST['table_name'];
        $table_name_ex  = explode("^", $tabledata);
        $table_name     = tbl_product_serial_log;
        $table_name_dtl = tbl_product_serial;
        
        
        $pri_data    = $_POST['pri_col'];
        $pri_col_ex  = explode("^", $pri_data);
        $pri_col     = product_id;
        $pri_col_dtl = product_id;
        
        
        $this->db->query("delete from $tabledata where $pri_data in($id)");
        $this->db->query("delete from $table_name where $pri_col in($id)");
        $this->db->query("delete from $table_name_dtl where $pri_col_dtl in($id)");
        
        
        
    }
    
    //===============================Close multiple_delete_two_table==========================
    
    
    
    public function forgotPassword()
    {
        
        //echo "bbbb";die;
        @extract($_POST);
        $email_id  = $this->input->post('email_id');
        $userQuery = $this->db->query("select * from tbl_user_mst where email_id='$email_id' and status='A' ");
        $cnt       = $userQuery->num_rows();
        
        if ($cnt > 0) {
            $getUser  = $userQuery->row();
            $fullname = $getUser->first_name . " " . $getUser->last_name;
            $toemail  = $getUser->email_id;
            //$cnfemail=$getUser->confirm_email;
            $id       = $getUser->user_id;
            
            //$msg="Name :- ".$fullname." & Your Password Is :- ".$password ;
            //$url     =  'http://techvyaserp.in'.base_url()."master/resetPasswordPage?cnfrmail=$email_id&id=$id";
            $url  = 'http://techvyaserp.in' . base_url() . "master/resetPasswordPage?cnfrmail=$email_id&id=$id";
            $body = " <table  width=100% border=0><tr>";
            $body .= ' 
                         <td align="center"  style="text-align:left;font-size:23px;color:#65676f;padding:30px 0 15px 0" valign="top">Hi ' . $fullname . ',</td></tr>
                         <tr><td align="center" style="text-align:left;font-size:16px;color:#65676f;padding:0 0 30px 0;line-height:1.8" valign="top" width="538px">
                          <span style="font-weight:bold">Click below button to reset your password.</span>
                        <div><a  href="' . $url . '" style="font-size:16px;font-weight:bold;background:#33b2c1;margin-top:18px;padding:10px 0;border-radius:3px;color:#fff;text-transform:uppercase;display:inline-block;text-decoration:none;text-align:center;width:270px" target="_blank">Reset Password</a></div>
                           </td>
                         </tr>';
            $body .= '</table>';
            
            $this->load->library('email');
            $this->email->initialize(array(
                'protocol' => 'smtp',
                'smtp_host' => '103.211.216.225',
                'smtp_user' => 'info@techvyaserp.in',
                'smtp_pass' => 'info@12345##',
                'smtp_port' => 587,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            ));
            
            
            $this->email->from('info@techvyaserp.in', 'Beryl Systems');
            $this->email->to($toemail);
            $this->email->bcc('');
            
            $this->email->subject('Reset Password');
            $this->email->message($body);
            
            $this->email->send();
            
            //$this->db->query("update tbl_user_mst set password_status='S' where user_id = '$id' ");
            $this->session->set_flashdata('message', 'Please check your mail for reset password ');
            redirect('master/forgot_page');
        } else {
            $this->session->set_flashdata('message', 'Email Id did not match to admin account !');
            redirect('master/forgot_page');
        }
        
    }
    
    
    /*function resetPasswordPage()
    {
    
    if($this->input->get() != "")
    {
    $confirmemail = $this->input->get('cnfrmail');
    $id        = $this->input->get('id');
    
    $sql   = "select * from tbl_user_mst where confirm_email = '".$confirmemail."' AND user_id = $id";
    $query = $this->db->query($sql)->row();
    
    if(sizeof($query) > 0)
    {
    $data['result'] = $query;
    // echo "<pre>";
    //  print_r($query);
    // echo "</pre>";
    if($query->password_status == 'R')
    {
    $this->session->set_flashdata('error', 'Password already reset, Please Login Now!');
    redirect('index');    
    }
    $this->load->view('reset-password',$data);
    }
    
    }
    
    }
    
    
    
    function passwordReset()
    {    
    
    $userid=$this->input->post('useridd');
    $email=$this->input->post('emailid');
    $newpass=$this->input->post('entrpaswrd');
    
    $query = $this->db->query("select * from tbl_user_mst where status='A' AND email_id='$email' AND user_id='$userid' ");
    $cntquery = $query->num_rows();
    
    if($cntquery > 0)
    {
    $this->db->query("update tbl_user_mst set password='$newpass',password_status='R' where user_id = '$userid' ");
    $this->session->set_flashdata('error','Password Change Successfully. Now You Can Login !');
    redirect('index');
    }
    
    }*/
    
    
    public function ciPagination($url, $totalData, $sgmnt, $showEntries)
    {
        
        $config['use_page_numbers']     = FAlSE;
        $config['page_query_string']    = TRUE;
        $config['query_string_segment'] = 'offset';
        
        $config['base_url']    = $url;
        $config['total_rows']  = $totalData;
        $config['per_page']    = $showEntries;
        $config["uri_segment"] = $sgmnt;
        //$choice                   =  $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = 2; //floor($choice);
        
        //config for bootstrap pagination class integration
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = 'First';
        $config['last_link']       = 'Last';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '&laquo';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&raquo';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        
        $this->pagination->initialize($config);
        $pages            = $_GET['offset'];
        $postlist['page'] = ($pages != "") ? $pages : 0;
        
        return array(
            'per_page' => $config['per_page'],
            'page' => $postlist['page']
        );
        
    }
    
    
    
    public function software_log_insert($slog_id, $mdl_name, $slog_name, $slog_type, $old_id, $new_id, $remarks)
    {
        
        $table_name = 'tbl_software_log';
        // date_default_timezone_set("Asia/Kolkata");
        // $dtTime = date('H:i:s');
        
        $data = array(
            'slog_id' => $slog_id,
            'mdl_name' => $mdl_name,
            'slog_name' => $slog_name,
            'slog_type' => $slog_type,
            'old_id' => $old_id,
            'new_id' => $new_id,
            'remarks' => $remarks
        );
        
        $sess       = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            //'maker_date' => date('y-m-d'),
            'author_id' => $this->session->userdata('user_id'),
            'author_date' => date('y-m-d'),
            'comp_id' => $this->session->userdata('comp_id'),
            'brnh_id' => $this->session->userdata('brnh_id')
        );
        $data_merge = array_merge($data, $sess);
        $this->Model_admin_login->insert_user($table_name, $data_merge);
        return;
        
    }
    
    
    public function message_log($type, $sub_type, $customer, $mobile, $visit_count, $message)
    {
        
        $table_name = 'tbl_message_log';
        
        date_default_timezone_set("Asia/Kolkata");
        $dtTime = date('Y-m-d H:i:s');
        
        $data = array(
            
            'type' => $type,
            'sub_type' => $sub_type,
            'customer' => $customer,
            'mobile' => $mobile,
            'visit_count' => $visit_count,
            'message_body' => $message,
            'sent_date' => $dtTime
            
        );
        
        $sess = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_id' => $this->session->userdata('user_id'),
            'author_date' => date('y-m-d')
        );
        
        $data_merge = array_merge($data, $sess);
        $this->Model_admin_login->insert_user($table_name, $data_merge);
        return;
        
    }
    
    
    
    public function cron_job_message_log($type, $sub_type, $customer, $mobile, $visit_count, $message)
    {
        
        $table_name = 'tbl_message_log';
        
        date_default_timezone_set("Asia/Kolkata");
        $dtTime = date('Y-m-d H:i:s');
        
        $data = array(
            
            'type' => $type,
            'sub_type' => $sub_type,
            'customer' => $customer,
            'mobile' => $mobile,
            'visit_count' => $visit_count,
            'message_body' => $message,
            'sent_date' => $dtTime
            
        );
        
        $sess = array(
            
            'maker_id' => "21",
            'maker_date' => date('y-m-d'),
            'author_id' => "21",
            'author_date' => date('y-m-d')
        );
        
        $data_merge = array_merge($data, $sess);
        $this->Model_admin_login->insert_user($table_name, $data_merge);
        return;
        
    }
    
    
    
}
?>