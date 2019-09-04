<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class Campaign extends my_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('model_campaign');
        $this->load->model('Model_admin_login');
    }
    
    
    public function manage_campaign()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('manage-campaign');
        } else {
            redirect('index');
        }
        
    }
    

    function welcome_sms_log()
    {

        if($this->session->userdata('is_logged_in')) {
            $data=$this->Show_WelcomeSmsLog();
            $this->load->view('welcome-sms-log',$data);
        } else {
            redirect('index');
        }
    }

    function Show_WelcomeSmsLog()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_message_log';
        //$url        = site_url('/report/Report/searchLead?');
        $sgmnt          = "4";
        
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_campaign->count_welcome_sms($table_name, $this->input->get());
        
        
        if ($_GET['entries'] != '') {
            $url = site_url('/Campaign/welcome_sms_log?entries=' . $_GET['entries']);
        } else {
            $url = site_url('/Campaign/welcome_sms_log?');
        }
        
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        $data['result'] = $this->model_campaign->get_welcome_sms_data($pagination['per_page'], $pagination['page']);
        
        return $data;
                
    
    }

    //=================================BIRTHDAY======================

    function birthday_sms_log()
    {

        if($this->session->userdata('is_logged_in')) {
            $data=$this->Show_BirthdaySmsLog();
            $this->load->view('birthday-sms-log',$data);
        } else {
            redirect('index');
        }
    }

    function Show_BirthdaySmsLog()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_message_log';
        //$url        = site_url('/report/Report/searchLead?');
        $sgmnt          = "4";
        
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_campaign->count_birthday_sms($table_name, $this->input->get());
        
        
        if ($_GET['entries'] != '') {
            $url = site_url('/Campaign/birthday_sms_log?entries=' . $_GET['entries']);
        } else {
            $url = site_url('/Campaign/birthday_sms_log?');
        }
        
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        $data['result'] = $this->model_campaign->get_birthday_sms_data($pagination['per_page'], $pagination['page']);
        
        return $data;
                
    
    }


    //======================Anniversary==========================


    function anniversary_sms_log()
    {

        if($this->session->userdata('is_logged_in')) {
            $data=$this->Show_AnniversarySmsLog();
            $this->load->view('anniversary-sms-log',$data);
        } else {
            redirect('index');
        }
    }

    function Show_AnniversarySmsLog()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_message_log';
        //$url        = site_url('/report/Report/searchLead?');
        $sgmnt          = "4";
        
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_campaign->count_anniversary_sms($table_name, $this->input->get());
        
        
        if ($_GET['entries'] != '') {
            $url = site_url('/Campaign/anniversary_sms_log?entries=' . $_GET['entries']);
        } else {
            $url = site_url('/Campaign/anniversary_sms_log?');
        }
        
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        $data['result'] = $this->model_campaign->get_anniversary_sms_data($pagination['per_page'], $pagination['page']);
        
        return $data;
                
    
    }    
    
    //=================================template=============
    
    
    function add_edit_template()
    {
        
        @extract($_POST);
        
        //print_r($_POST);die;
        
        $table_name = 'tbl_template';
        $pri_col    = 'template_id';
        
        $temp_id = $this->input->post('temp_id');
        
        $data  = array(
            
            'type' => $this->input->post('type'),
            'sub_type' => $this->input->post('sub_type'),
            'template_type' => $this->input->post('template_type'),
            'template_text' => $this->input->post('template_text')
            
            
        );
        $sesio = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
            
        );
        
        
        if ($temp_id != '') {
            $this->Model_admin_login->update_user($pri_col, $table_name, $cmpId, $data);
            echo 2;
        } else {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            echo 1;
        }
        
    }
    
    
    function set_template_value()
    {
        
        $tempid = $this->input->post('tid');
        $temp   = $this->db->query("select * from tbl_template where template_id='$tempid' ");
        $result = $temp->row();
        
        if (sizeof($result) > 0) {
            echo json_encode($result, true);
        } else {
            echo false;
        }
    }
    
    //============================end=======================
    
    public function birthday_wishes()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('birthday-wishes');
        } else {
            redirect('index');
        }
        
    }
    
    
    public function anniversary_wishes()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('anniversary-wishes');
        } else {
            redirect('index');
        }
        
    }
    
    
    public function welcome_campaign()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('welcome-campaign');
        } else {
            redirect('index');
        }
        
    }
    
    
    public function bblc_campaign()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('bblc-campaign');
        } else {
            redirect('index');
        }
        
    }
    
    public function cwic_campaign()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('cwic-campaign');
        } else {
            redirect('index');
        }
        
    }
    
    
    
    public function events_campaign()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('events-campaign');
        } else {
            redirect('index');
        }
        
    }
    
    
    
    public function loyalty_campaign()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('loyalty-campaign');
        } else {
            redirect('index');
        }
        
    }
    
    //=============================Birthday=============================
    
    
    function birthday_campaign()
    {
        
        @extract($_POST);
        
        //print_r($_POST);die;
        
        $table_name = 'tbl_campaign';
        $pri_col    = 'campaign_id';
        
        $cmpId = $this->input->post('cmpgn_id');
        
        $data  = array(
            
            'type' => $this->input->post('type'),
            'sub_type' => $this->input->post('sub_type'),
            'title' => $this->input->post('title'),
            'language' => $this->input->post('language'),
            'wishes_text' => $this->input->post('wishes_text'),
            'send_before_days' => $this->input->post('send_before_days'),
            'valid_till_days' => $this->input->post('valid_till_days'),
            'vaild_till' => $this->input->post('vaild_till')
            
        );
        $sesio = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
            
        );
        
        
        if ($cmpId != '') {
            $this->Model_admin_login->update_user($pri_col, $table_name, $cmpId, $data);
            echo 2;
        } else {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            echo 1;
        }
        
    }
    
    function ajex_BirthDayListData()
    {
        $this->load->view('load-birthday-data');
    }
    
    //===============================Anniversary==============================
    
    function anniversary_campaign()
    {
        
        @extract($_POST);
        
        //print_r($_POST);die;
        
        $table_name = 'tbl_campaign';
        $pri_col    = 'campaign_id';
        
        $cmpId = $this->input->post('cmpgn_id');
        
        $data  = array(
            
            'type' => $this->input->post('type'),
            'sub_type' => $this->input->post('sub_type'),
            'title' => $this->input->post('title'),
            'language' => $this->input->post('language'),
            'wishes_text' => $this->input->post('wishes_text'),
            'send_before_days' => $this->input->post('send_before_days'),
            'valid_till_days' => $this->input->post('valid_till_days'),
            'vaild_till' => $this->input->post('vaild_till')
            
        );
        $sesio = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
            
        );
        
        
        if ($cmpId != '') {
            $this->Model_admin_login->update_user($pri_col, $table_name, $cmpId, $data);
            echo 2;
        } else {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            echo 1;
        }
        
    }
    
    function ajex_AnniversaryListData()
    {
        $this->load->view('load-anniversary-data');
    }
    
    
    //========================================Welcome=======================
    
    function add_edit_welcome()
    {
        
        @extract($_POST);
        
        //print_r($_POST);die;
        
        $table_name = 'tbl_campaign';
        $pri_col    = 'campaign_id';
        
        $cmpId = $this->input->post('cmpgn_id');
        
        $data  = array(
            
            'type' => $this->input->post('type'),
            
            'title' => $this->input->post('title'),
            'language' => $this->input->post('language'),
            'wishes_text' => $this->input->post('wishes_text'),
            'valid_till_days' => $this->input->post('valid_till_days'),
            'vaild_till' => $this->input->post('vaild_till')
            
        );
        $sesio = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
            
        );
        
        
        if ($cmpId != '') {
            $this->Model_admin_login->update_user($pri_col, $table_name, $cmpId, $data);
            echo 2;
        } else {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            echo 1;
        }
        
    }
    
    function ajex_welcomeListData()
    {
        $this->load->view('load-welcome-data');
    }
    
    //===============================Events & Festival=====================
    
    function add_edit_events()
    {
        
        @extract($_POST);
        
        //print_r($_POST);die;
        
        $table_name = 'tbl_campaign';
        $pri_col    = 'campaign_id';
        
        $cmpId = $this->input->post('cmpgn_id');
        
        $data  = array(
            
            'type' => $this->input->post('type'),
            'sub_type' => $this->input->post('sub_type'),
            
            'title' => $this->input->post('title'),
            'language' => $this->input->post('language'),
            'wishes_text' => $this->input->post('wishes_text'),
            'sent_date' => $this->input->post('sent_date'),
            'vaild_till' => $this->input->post('vaild_till')
            
        );
        $sesio = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
            
        );
        
        
        if ($cmpId != '') {
            $this->Model_admin_login->update_user($pri_col, $table_name, $cmpId, $data);
            echo 2;
        } else {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            echo 1;
        }
        
    }
    
    function ajex_eventsListData()
    {
        $this->load->view('load-events-data');
    }
    
    //======================================Loyalty==========================
    
    function add_edit_loyalty()
    {
        
        @extract($_POST);
        
        //print_r($_POST);die;
        
        $table_name = 'tbl_campaign';
        $pri_col    = 'campaign_id';
        
        $cmpId = $this->input->post('cmpgn_id');
        
        
        $data  = array(
            
            'type' => $this->input->post('type'),
            'visits' => $this->input->post('visits'),
            'free_items' => $this->input->post('free_items'),
            'discount' => $this->input->post('discount'),
            'discount_value' => $this->input->post('discount_value'),
            'maximum_discount' => $this->input->post('maximum_discount'),
            'minimum_billing' => $this->input->post('minimum_billing'),
            //'items'              => $this->input->post('items'),
            'wishes_text' => $this->input->post('wishes_text')
            
        );
        $sesio = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
            
        );
        
        
        if ($cmpId != '') {
            $this->Model_admin_login->update_user($pri_col, $table_name, $cmpId, $data);
            echo 2;
        } else {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            echo 1;
        }
        
    }
    
    function ajex_loyaltyListData()
    {
        $this->load->view('load-loyalty-data');
    }
    
    
    //=============================Bring Back Lost Customer====================
    
    function add_edit_bblc()
    {
        
        @extract($_POST);
        
        //print_r($_POST);die;
        
        $table_name = 'tbl_campaign';
        $pri_col    = 'campaign_id';
        
        $cmpId = $this->input->post('cmpgn_id');
        
        
        $data = array(
            
            'type' => $this->input->post('type'),
            
            'title' => $this->input->post('title'),
            'language' => $this->input->post('language'),
            'last_visited' => $this->input->post('last_visited'),
            'till_day' => $this->input->post('till_day'),
            'wishes_text' => $this->input->post('wishes_text'),
            'start_date' => $this->input->post('start_date'),
            'vaild_till' => $this->input->post('vaild_till'),
            'gender' => $this->input->post('gender'),
            'customer_source' => $this->input->post('customer_source'),
            'customer_category' => $this->input->post('customer_category'),
            'category' => $this->input->post('category')
            
        );
        
        $sesio = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
            
        );
        
        
        if ($cmpId != '') {
            $this->Model_admin_login->update_user($pri_col, $table_name, $cmpId, $data);
            echo 2;
        } else {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            echo 1;
        }
        
    }
    
    function ajex_bblcListData()
    {
        $this->load->view('load-bblc-data');
    }
    
    
    //==============================convert walkin into customer================
    
    function add_edit_cwic()
    {
        
        @extract($_POST);
        
        //print_r($_POST);die;
        
        $table_name = 'tbl_campaign';
        $pri_col    = 'campaign_id';
        
        $cmpId = $this->input->post('cmpgn_id');
        
        
        $data = array(
            
            'type' => $this->input->post('type'),
            'sub_type' => $this->input->post('sub_type'),
            
            'title' => $this->input->post('title'),
            'language' => $this->input->post('language'),
            'last_visited' => $this->input->post('last_visited'),
            'till_day' => $this->input->post('till_day'),
            'wishes_text' => $this->input->post('wishes_text'),
            'start_date' => $this->input->post('start_date'),
            'vaild_till' => $this->input->post('vaild_till'),
            'gender' => $this->input->post('gender'),
            'customer_source' => $this->input->post('customer_source'),
            'customer_category' => $this->input->post('customer_category'),
            'category' => $this->input->post('category')
            
        );
        
        $sesio = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
            
        );
        
        
        if ($cmpId != '') {
            $this->Model_admin_login->update_user($pri_col, $table_name, $cmpId, $data);
            echo 2;
        } else {
            $dataall = array_merge($data, $sesio);
            $this->Model_admin_login->insert_user($table_name, $dataall);
            echo 1;
        }
        
    }
    
    function ajex_cwicListData()
    {
        $this->load->view('load-cwic-data');
    }
    
    
    
    //=================================Send SMS==================================
    
    /*function sendsms($mobileno, $message)
    {
    
    $message = urlencode($message);
    $sender = 'SEDEMO';
    $apikey = 'API_KEY_HERE';
    $baseurl = 'https://http://api.sms2support.com/api/web/send?apikey='.$apikey;
    
    $url = $baseurl.'&sender='.$sender.'&to='.$mobileno.'&message='.$message;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Use file get contents when CURL is not installed on server.
    if(!$response)
    {
    $response = file_get_contents($url);
    }
    }
    */
    
    
    /*function curl($url)
    {
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
    }
    
    $mobile            =    "xxxxxxxxxx,xxxxxxxxxx "; //enter Mobile numbers comma seperated
    
    $username        =    "xxxxxx";   //your username
    $password        =    "xxxxxx";   //your password 
    $sender            =    "xxxxxx";    //Your senderid
    
    $username        =    urlencode($username);
    $password        =    urlencode($password);
    $sender            =    urlencode($sender);
    
    $messagecontent =    "xxxxxx "; //Type Of Your Message
    $message        =    urlencode($messagecontent);
    $url="http://domainname/sendsms?uname=$username&pwd=$password&senderid=$sender&to=$mobile&msg=$message&route=T";
    $response = curl($url);*/
    
    //========================Cron Job Scheduling Messages==============================
    
    function sendbblcMessage()
    {
        
        $cst = $this->db->query("select * from tbl_customers where maker_id='21' AND last_visit != 'N/A' ");
        
        foreach ($cst->result() as $getCst) {
            # code...
            $lstVst = $getCst->last_visit;
            $cmp    = $this->db->query("select * from tbl_campaign where type='Lost Customers' AND maker_id='21' ");
            //$count=0;
            foreach ($cmp->result() as $getCmp) {
                # code...
                $cmpVisit = $getCmp->last_visited;
                $Date1    = date('d-m-Y');
                $Date2    = date('d-m-Y', strtotime($lstVst . " + " . $cmpVisit . " day"));
                
                if ($Date1 == $Date2) {
                    //$count++;
                    $mobile  = $getCst->mobile_no;
                    $cname   = $getCst->first_name;
                    $message = $getCmp->wishes_text;
                    $visit   = $getCst->visit_count;
                    $this->sendLostCustomerMessage($mobile, $cname, $message, $visit);
                    //$this->testCronJob();            
                }
                
            }
        }
        
        //echo $count;
        
    }
    
    function sendLostCustomerMessage($mobile, $cname, $message, $visit)
    {
        
        //echo $mobile." ".$cname." ".$message." ".$visit;die;
        
        $sql    = $this->db->query("select * from tbl_user_mst WHERE user_id='21'");
        $getSql = $sql->row();
        $bname  = $getSql->buseiness_name;
        
        //$subjectVal = "It was nice meeting you. May you shine bright.";     
        // $resStr = str_replace('you', 'him', $subjectVal);
        $msg0    = $message;
        $repMsg0 = str_replace('#cname', $cname, $msg0);
        $msg1    = $repMsg0;
        $repMsg1 = str_replace('#bname', $bname, $msg1);
        $msg2    = $repMsg1;
        $repMsg2 = str_replace('#count', $visit, $msg2);
        
        //echo $repMsg2;die;
        
        $mobile = $mobile; //enter Mobile numbers comma seperated
        
        $username = "berylsystems"; //your username
        $password = "changeit123"; //your password 
        $sender   = "BERYLS"; //Your senderid
        
        $username = urlencode($username);
        $password = urlencode($password);
        $sender   = urlencode($sender);
        
        $messagecontent = $repMsg2; //Type Of Your Message
        $message        = urlencode($messagecontent);
        $url            = "http://api.sms2support.com/sendsms?uname=$username&pwd=$password&senderid=$sender&to=$mobile&msg=$message&route=T";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        
        $this->cron_job_message_log('Lost Customers', '', $cname, $mobile, $visit, $messagecontent);
        
        return $data;
        
        //return $response = curl($url);
        
    }
    
    
    function testCronJob()
    {
        $this->db->query("insert into tbl_cron_job_test set name='Cron Job',result='Success' ");
    }
    
    
    //==========================+Events Cron Job Function===================
    
    
    function sendEventsMessage()
    {
        
        $cst = $this->db->query("select * from tbl_customers where maker_id='21' AND last_visit != 'N/A' ");
        
        foreach ($cst->result() as $getCst) {
            
            # code...
            $cmp = $this->db->query("select * from tbl_campaign where type='Festival' AND maker_id='21' ");
            //$count=0;
            foreach ($cmp->result() as $getCmp) {
                # code...
                $eventsDate = $getCmp->sent_date;
                $crntDate   = date('Y-m-d');
                //$Date2 = date('d-m-Y', strtotime($eventsDate . " + 45 day"));
                
                if ($crntDate == $eventsDate) {
                    //$count++;
                    $mobile   = $getCst->mobile_no;
                    $cname    = $getCst->first_name;
                    $message  = $getCmp->wishes_text;
                    $visit    = $getCst->visit_count;
                    $sub_type = $getCmp->sub_type;
                    $this->eventsMessage($mobile, $cname, $message, $visit, $sub_type);
                    //$this->testCronJob();            
                }
                
            }
        }
        
        //echo $count;
        
    }
    
    function eventsMessage($mobile, $cname, $message, $visit, $sub_type)
    {
        
        //echo $mobile." ".$cname." ".$message." ".$visit;die;
        
        $sql    = $this->db->query("select * from tbl_user_mst WHERE user_id='21'");
        $getSql = $sql->row();
        $bname  = $getSql->buseiness_name;
        
        //$subjectVal = "It was nice meeting you. May you shine bright.";     
        // $resStr = str_replace('you', 'him', $subjectVal);
        
        $msg0    = $message;
        $repMsg0 = str_replace('#cname', $cname, $msg0);
        $msg1    = $repMsg0;
        $repMsg1 = str_replace('#bname', $bname, $msg1);
        $msg2    = $repMsg1;
        $repMsg2 = str_replace('#count', $visit, $msg2);
        
        //echo $repMsg2;die;
        
        $mobile = $mobile; //enter Mobile numbers comma seperated
        
        $username = "berylsystems"; //your username
        $password = "changeit123"; //your password 
        $sender   = "BERYLS"; //Your senderid
        
        $username = urlencode($username);
        $password = urlencode($password);
        $sender   = urlencode($sender);
        
        $messagecontent = $repMsg2; //Type Of Your Message
        $message        = urlencode($messagecontent);
        $url            = "http://api.sms2support.com/sendsms?uname=$username&pwd=$password&senderid=$sender&to=$mobile&msg=$message&route=T";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        
        $this->cron_job_message_log('Festival', $sub_type, $cname, $mobile, $visit, $messagecontent);
        
        return $data;
        
        //return $response = curl($url);
        
    }
    
    
    //==============================Birthday Wishes Cron Job========================
    
    
    function sendBirthdayWishes()
    {
        
        $cst = $this->db->query("select * from tbl_customers where maker_id='21' AND date_of_birth != 'N/A' ");
        
        foreach ($cst->result() as $getCst) {
            
            # code...
            $cmp = $this->db->query("select * from tbl_campaign where type='Birthday' AND maker_id='21' ");
            //$count=0;
            foreach ($cmp->result() as $getCmp) {
                # code...
                $birthDate = $getCst->date_of_birth;
                $birthDate = explode('-', $birthDate);
                $birthDate = $birthDate[1] . "-" . $birthDate[2];
                $crntDate  = date('m-d');
                //$Date2 = date('d-m-Y', strtotime($eventsDate . " + 45 day"));
                
                if ($crntDate == $birthDate) {
                    
                    $count++;
                    $mobile   = $getCst->mobile_no;
                    $cname    = $getCst->first_name;
                    $message  = $getCmp->wishes_text;
                    $visit    = $getCst->visit_count;
                    $sub_type = $getCmp->sub_type;
                    $this->birthdayMessage($mobile, $cname, $message, $visit, $sub_type);
                    //$this->testCronJob();         
                    
                }
                
            }
            
        }
        
        //echo $count;
        
    }
    
    function birthdayMessage($mobile, $cname, $message, $visit, $sub_type)
    {
        
        //echo $mobile." ".$cname." ".$message." ".$visit;die;
        
        $sql    = $this->db->query("select * from tbl_user_mst WHERE user_id='21'");
        $getSql = $sql->row();
        $bname  = $getSql->buseiness_name;
        
        //$subjectVal = "It was nice meeting you. May you shine bright.";     
        // $resStr = str_replace('you', 'him', $subjectVal);
        
        $msg0    = $message;
        $repMsg0 = str_replace('#cname', $cname, $msg0);
        $msg1    = $repMsg0;
        $repMsg1 = str_replace('#bname', $bname, $msg1);
        $msg2    = $repMsg1;
        $repMsg2 = str_replace('#count', $visit, $msg2);
        
        //echo $repMsg2;die;
        
        $mobile = $mobile; //enter Mobile numbers comma seperated
        
        $username = "berylsystems"; //your username
        $password = "changeit123"; //your password 
        $sender   = "BERYLS"; //Your senderid
        
        $username = urlencode($username);
        $password = urlencode($password);
        $sender   = urlencode($sender);
        
        $messagecontent = $repMsg2; //Type Of Your Message
        $message        = urlencode($messagecontent);
        $url            = "http://api.sms2support.com/sendsms?uname=$username&pwd=$password&senderid=$sender&to=$mobile&msg=$message&route=T";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        
        $this->cron_job_message_log('Birthday', $sub_type, $cname, $mobile, $visit, $messagecontent);
        
        return $data;
        
        //return $response = curl($url);
        
    }
    
    
    //============================Anniversary Wishes Cron Job==============================
    
    function sendAnniversaryWishes()
    {
        
        $cst = $this->db->query("select * from tbl_customers where maker_id='21' AND anniversary != 'N/A' ");
        
        foreach ($cst->result() as $getCst) {
            
            # code...
            $cmp = $this->db->query("select * from tbl_campaign where type='Anniversary' AND maker_id='21' ");
            //$count=0;
            foreach ($cmp->result() as $getCmp) {
                # code...
                $anniversaryDate = $getCst->anniversary;
                $anniversaryDate = explode('-', $anniversaryDate);
                $anniversaryDate = $anniversaryDate[1] . "-" . $anniversaryDate[2];
                $crntDate        = date('m-d');
                //$Date2 = date('d-m-Y', strtotime($eventsDate . " + 45 day"));
                
                if ($crntDate == $anniversaryDate) {
                    
                    $count++;
                    $mobile   = $getCst->mobile_no;
                    $cname    = $getCst->first_name;
                    $message  = $getCmp->wishes_text;
                    $visit    = $getCst->visit_count;
                    $sub_type = $getCmp->sub_type;
                    $this->anniversaryMessage($mobile, $cname, $message, $visit, $sub_type);
                    //$this->testCronJob();         
                    
                }
                
            }
            
        }
        
        //echo $count;
        
    }
    
    function anniversaryMessage($mobile, $cname, $message, $visit, $sub_type)
    {
        
        //echo $mobile." ".$cname." ".$message." ".$visit;die;
        
        $sql    = $this->db->query("select * from tbl_user_mst WHERE user_id='21'");
        $getSql = $sql->row();
        $bname  = $getSql->buseiness_name;
        
        //$subjectVal = "It was nice meeting you. May you shine bright.";     
        // $resStr = str_replace('you', 'him', $subjectVal);
        
        $msg0    = $message;
        $repMsg0 = str_replace('#cname', $cname, $msg0);
        $msg1    = $repMsg0;
        $repMsg1 = str_replace('#bname', $bname, $msg1);
        $msg2    = $repMsg1;
        $repMsg2 = str_replace('#count', $visit, $msg2);
        
        //echo $repMsg2;die;
        
        $mobile = $mobile; //enter Mobile numbers comma seperated
        
        $username = "berylsystems"; //your username
        $password = "changeit123"; //your password 
        $sender   = "BERYLS"; //Your senderid
        
        $username = urlencode($username);
        $password = urlencode($password);
        $sender   = urlencode($sender);
        
        $messagecontent = $repMsg2; //Type Of Your Message
        $message        = urlencode($messagecontent);
        $url            = "http://api.sms2support.com/sendsms?uname=$username&pwd=$password&senderid=$sender&to=$mobile&msg=$message&route=T";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        
        $this->cron_job_message_log('Anniversary', $sub_type, $cname, $mobile, $visit, $messagecontent);
        
        return $data;
        
        //return $response = curl($url);
        
    }
    
}
?>