<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class Register extends my_controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('model_register');
        $this->load->model('Model_admin_login');
    }
    
    public function manage_register()
    {
        if ($this->session->userdata('is_logged_in')) {
            //$data =  $this->manage_contactJoin();
            //$this->load->view('manage-contact',$data);
            $this->load->view('manage-register');
        } else {
            redirect('index');
        }
    }
    
    function ajaxget_custPhoneData()
    {
        
        $ipt    = $this->input->post('id');
        //$sql = "select * FROM tbl_customers WHERE customer_id = $ipt";
        $sql    = "select * FROM tbl_customers WHERE mobile_no = '$ipt' ";
        $result = $this->db->query($sql)->row();
        //print_r($result);
        if (sizeof($result) > 0)
            echo json_encode($result, true);
        else
            echo false;
        
    }
    
    function ajaxget_custEmailData()
    {
        
        $ipt    = $this->input->post('id');
        //$sql = "select * FROM tbl_customers WHERE customer_id = $ipt";
        $sql    = "select * FROM tbl_customers WHERE email_id = '$ipt' ";
        $result = $this->db->query($sql)->row();
        //print_r($result);
        if (sizeof($result) > 0)
            echo json_encode($result, true);
        else
            echo false;
        
    }
    
    
    function register_customer()
    {
        
        /*echo "</pre>";
        print_r($_POST);
        echo "</pre>";
        die;*/
        @extract($_POST);
        
        $table_name = 'tbl_customers';
        $pri_col    = 'customer_id';
        
        $table_name_log = 'tbl_customers_log';
        $pri_col_log    = 'customer_log_id';
        
        $cid = $this->input->post('oldcustomer_id');
        
        
        //$dob_val           = json_encode($this->input->post('dob'),true);
        //$anniversary_val  = json_encode($this->input->post('anniversary'),true);
        
        if ($this->input->post('dob') != '') {
            $dob_val = $this->input->post('dob');
        } else {
            $dob_val = "N/A";
        }
        
        if ($this->input->post('anniversary') != '') {
            $anniversary_val = $this->input->post('anniversary');
        } else {
            $anniversary_val = "N/A";
        }
        
        $cstmrName = $this->input->post('first_name') . " " . $this->input->post('last_name');
        
        $lastDate = date('d-m-Y');
        
        $data = array(
            
            'type' => $this->input->post('c_type'),
            'last_visit' => $lastDate,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'customer_name' => $cstmrName,
            'mobile_no' => $this->input->post('mobile_no_next'),
            'email_id' => $this->input->post('email_id_next'),
            
            'date_of_birth' => $dob_val,
            'anniversary' => $anniversary_val,
            
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'sales_amount' => $this->input->post('sales_amount'),
            'categories' => $this->input->post('categories'),
            'expected_date' => $this->input->post('expected_date'),
            'remarks' => $this->input->post('remarks')
            
        );
        
        $sesio = array(
            
            'maker_id' => $this->session->userdata('user_id'),
            'author_id' => $this->session->userdata('user_id'),
            'maker_date' => date('y-m-d'),
            'author_date' => date('y-m-d')
        );
        
        
        $dataall = array_merge($data, $sesio);
        
        if ($cid == "") {
            
            $this->Model_admin_login->insert_user($table_name, $dataall);
            $id = $this->db->insert_id();
            
            if ($this->input->post('visit_count') == true) {
                $this->db->query("update tbl_customers set visit_count='1' WHERE customer_id='$id' ");
            }
            
            $logData = array(
                
                'customer_id' => $id,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'mobile_no' => $this->input->post('mobile_no_next'),
                'email_id' => $this->input->post('email_id_next'),
                'date_of_birth' => $dob_val,
                'anniversary' => $anniversary_val,
                'gender' => $this->input->post('gender'),
                'address' => $this->input->post('address'),
                'sales_amount' => $this->input->post('sales_amount'),
                'categories' => $this->input->post('categories'),
                'expected_date' => $this->input->post('expected_date'),
                'remarks' => $this->input->post('remarks')
                
            );
            
            $data_log = array_merge($logData, $sesio);
            $this->Model_admin_login->insert_user($table_name_log, $data_log);
            
            //=====================Send Welcome Message=====================
            if ($this->input->post('visit_count') == true) {
                
                $wmobile = $this->input->post('mobile_no_next');
                $wcname  = $this->input->post('first_name');
                $visit   = 1;
                
                $wlc    = $this->db->query("select * from tbl_campaign where type='Welcome' AND sub_type='Welcome' AND maker_id='" . $this->session->userdata('user_id') . "' ");
                $getWlc = $wlc->row();
                
                $dis    = $this->db->query("select * from tbl_campaign where type='Welcome' AND sub_type='Discount' AND maker_id='" . $this->session->userdata('user_id') . "' ");
                $getDis = $dis->row();
                
                if($getWlc->wishes_text != '')
                {
                    $this->sendWelcomeMessage($wmobile, $wcname, $getWlc->wishes_text, $visit);    
                }
                
                if($getDis->wishes_text != '')
                {
                    $this->sendWelcomeMessage1($wmobile, $wcname, $getDis->wishes_text, $visit);    
                }
                
                
                //redirect('/Customers/manage_customers');
                
            }
            
        } else {
            
            $this->Model_admin_login->update_user($pri_col, $table_name, $cid, $data);
            
            if ($cid != '' && $this->input->post('visit_count') == true) {
                $cnt    = $this->db->query("select * from tbl_customers WHERE customer_id='$cid' ");
                $getCnt = $cnt->row();
                $count  = $getCnt->visit_count;
                
                $this->db->query("update tbl_customers set visit_count=$count + 1 WHERE customer_id='$cid' ");
            }
            
            $logData  = array(
                
                'customer_id' => $cid,
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'mobile_no' => $this->input->post('mobile_no_next'),
                'email_id' => $this->input->post('email_id_next'),
                'date_of_birth' => $dob_val,
                'anniversary' => $anniversary_val,
                'gender' => $this->input->post('gender'),
                'address' => $this->input->post('address'),
                'sales_amount' => $this->input->post('sales_amount'),
                'categories' => $this->input->post('categories'),
                'expected_date' => $this->input->post('expected_date'),
                'remarks' => $this->input->post('remarks')
                
            );
            $data_log = array_merge($logData, $sesio);
            $this->Model_admin_login->insert_user($table_name_log, $data_log);
            
            //=================Send Loyalty Message=======================
            if ($cid != '' && $this->input->post('visit_count') == true) {
                
                $cst    = $this->db->query("select * from tbl_customers WHERE customer_id='$cid' AND maker_id='" . $this->session->userdata('user_id') . "'");
                $getCst = $cst->row();
                
                $loyalty    = $this->db->query("select * from tbl_campaign where type='Loyalty' and visits='$getCst->visit_count' AND maker_id='" . $this->session->userdata('user_id') . "' ");
                $getLoyalty = $loyalty->row();
                
                $count = $loyalty->num_rows();
                if ($count > 0) {
                    $this->sendLoyaltyMessage($getCst->mobile_no, $getCst->first_name, $getLoyalty->wishes_text, $getCst->visit_count);
                } else if ($getCst->visit_count < 5) {
                    $bal     = 5;
                    $bpoint  = $bal - $getCst->visit_count;
                    $message = "You have earned 1 visit point, you are #point visit point away from getting Balancing ,Alignment & Nitrogen Free from #bname . Your current balance is #count visit points. T&C apply.";
                    $this->sendNormalVisitMessage($getCst->mobile_no, $getCst->first_name, $message, $getCst->visit_count, $bpoint);
                } else if ($getCst->visit_count > 5) {
                    
                    $message = "You have earned 1 visit point and your net balance is #count visit points from #bname , T&C apply.";
                    $this->sendAfterVisitMessage($getCst->mobile_no, $getCst->first_name, $message, $getCst->visit_count);
                }
                
            }
            //redirect('/Customers/manage_customers');
            
        }
        
        redirect('/Customers/manage_customers');
        
    }
    
    
    function sendWelcomeMessage($mobile, $cname, $message, $visit)
    {
        
        $sql    = $this->db->query("select * from tbl_user_mst WHERE user_id='" . $this->session->userdata('user_id') . "'");
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
        
        
        $this->message_log('Welcome', 'Welcome', $cname, $mobile, $visit, $messagecontent);
        
        
        return $data;
        
        //return $response = curl($url);
        
    }
    
    function sendWelcomeMessage1($mobile, $cname, $message, $visit)
    {
        
        $sql    = $this->db->query("select * from tbl_user_mst WHERE user_id='" . $this->session->userdata('user_id') . "'");
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
        ;
        
        
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
        
        $this->message_log('Welcome', 'Discount', $cname, $mobile, $visit, $messagecontent);
        
        return $data;
        
        //return $response = curl($url);
        
    }
    
    
    //====================================Loyalty Message==========================
    
    function sendLoyaltyMessage($mobile, $cname, $message, $visit)
    {
        
        //echo $mobile." ".$cname." ".$message." ".$visit;die;
        
        $sql    = $this->db->query("select * from tbl_user_mst WHERE user_id='" . $this->session->userdata('user_id') . "'");
        $getSql = $sql->row();
        $bname  = $getSql->buseiness_name;
        
        //$subjectVal = "It was nice meeting you. May you shine bright.";     
        // $resStr = str_replace('you', 'him', $subjectVal);
        $msg1    = $message;
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
        
        $this->message_log('Loyalty', '', $cname, $mobile, $visit, $messagecontent);
        
        return $data;
        
        //return $response = curl($url);
        
    }
    
    
    
    function sendNormalVisitMessage($mobile, $cname, $message, $visit, $point)
    {
        
        //echo $mobile." ".$cname." ".$message." ".$visit;die;
        
        $sql    = $this->db->query("select * from tbl_user_mst WHERE user_id='" . $this->session->userdata('user_id') . "'");
        $getSql = $sql->row();
        $bname  = $getSql->buseiness_name;
        
        //$subjectVal = "It was nice meeting you. May you shine bright.";     
        // $resStr = str_replace('you', 'him', $subjectVal);
        $msg0    = $message;
        $repMsg0 = str_replace('#point', $point, $msg0);
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
        
        $this->message_log('Every Visit', '', $cname, $mobile, $visit, $messagecontent);
        
        return $data;
        
        //return $response = curl($url);
        
    }
    
    
    function sendAfterVisitMessage($mobile, $cname, $message, $visit)
    {
        
        //echo $mobile." ".$cname." ".$message." ".$visit;die;
        
        $sql    = $this->db->query("select * from tbl_user_mst WHERE user_id='" . $this->session->userdata('user_id') . "'");
        $getSql = $sql->row();
        $bname  = $getSql->buseiness_name;
        
        //$subjectVal = "It was nice meeting you. May you shine bright.";     
        // $resStr = str_replace('you', 'him', $subjectVal);
        
        $msg1    = $message;
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
        
        $this->message_log('After Visit', '', $cname, $mobile, $visit, $messagecontent);
        
        return $data;
        
        //return $response = curl($url);
        
    }
    
    function ajax_checkRegisterdUser()
    {
        
        $ipt    = $this->input->post('val');
        //$sql = "select * FROM tbl_customers WHERE customer_id = $ipt";
        $sql    = "select * FROM tbl_customers WHERE mobile_no = '$ipt' ";
        $result = $this->db->query($sql)->row();
        //print_r($result);
        if (sizeof($result) > 0)
            echo json_encode($result, true);
        else
            echo false;
        
    }
    
    
}
?>