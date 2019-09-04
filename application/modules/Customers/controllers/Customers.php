<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);
class Customers extends my_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('Model_admin_login');
        $this->load->model('model_customers');
    }
    
    
    public function manage_customers()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $data = $this->Show_Customers_Data();
            $this->load->view('manage-customers', $data);
        } else {
            redirect('index');
        }
        
    }
    
    function Show_Customers_Data()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_customers';
        //$url        = site_url('/report/Report/searchLead?');
        $sgmnt          = "4";
        
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_customers->count_Customers($table_name, $this->input->get());
        
        
        if ($_GET['entries'] != '' && $_GET['filter'] != '') {
            $url = site_url('/Customers/manage_customers?filter=' . $_GET['filter'] . '&entries=' . $_GET['entries']);
        } elseif ($_GET['search'] != '' && $_GET['entries'] != '') {
            $url = site_url('/Customers/manage_customers?filter=' . $_GET['filter'] . '&nameSearch=' . $_GET['nameSearch'] . '&mobileSearch=' . $_GET['mobileSearch'] . '&emailSearch=' . $_GET['emailSearch'] . '&from_date=' . $_GET['from_date'] . '&to_date=' . $_GET['to_date'] . '&entries=' . $_GET['entries']);
        } elseif ($_GET['entries'] != '' && $_GET['search'] == '') {
            $url = site_url('/Customers/manage_customers?entries=' . $_GET['entries']);
        } elseif ($_GET['search'] != '' && $_GET['entries'] == '') {
            $url = site_url('/Customers/manage_customers?filter=' . $_GET['filter'] . '&nameSearch=' . $_GET['nameSearch'] . '&mobileSearch=' . $_GET['mobileSearch'] . '&emailSearch=' . $_GET['emailSearch'] . '&from_date=' . $_GET['from_date'] . '&to_date=' . $_GET['to_date']);
        } else {
            $url = site_url('/Customers/manage_customers?');
        }
        
        $pagination = $this->ciPagination($url, $totalData, $sgmnt, $showEntries);
        
        
        //$data=$this->user_function();      // call permission fnctn
        $data['dataConfig'] = array(
            'total' => $totalData,
            'perPage' => $pagination['per_page'],
            'page' => $pagination['page']
        );
        $data['pagination'] = $this->pagination->create_links();
        
        if ($this->input->get('search') != '') ////filter start ////
            $data['result'] = $this->model_customers->filterCustomersData($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_customers->getCustomersData($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
    }
    
    function edit_customer()
    {
        
        
        // echo "</pre>";
        // print_r($this->session->userdata);
        // echo "</pre>";
        // die;
        @extract($_POST);
        
        $table_name = 'tbl_customers';
        $pri_col    = 'customer_id';
        
        $cid = $this->input->post('customer_id');
        
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
        
        $data = array(
            
            //'mobile_no'      => $this->input->post('mobile_no'),
            'customer_name' => $cstmrName,
            'categories' => $this->input->post('categories'),
            'first_name' => $this->input->post('first_name'),
            'email_id' => $this->input->post('email_id'),
            'last_name' => $this->input->post('last_name'),
            'gst_no' => $this->input->post('gst_no'),
            'gender' => $this->input->post('gender'),
            'pan_no' => $this->input->post('pan_no'),
            
            'date_of_birth' => $dob_val,
            'anniversary' => $anniversary_val,
            
            'address' => $this->input->post('address'),
            'remarks' => $this->input->post('remarks')
            //'sales_amount'   => $this->input->post('sales_amount'),
            //'expected_date'  => $this->input->post('expected_date'),
            
        );
        
        if ($cid != "") {
            
            $this->Model_admin_login->update_user($pri_col, $table_name, $cid, $data);
            echo 2;
            
        }
        
    }
    
    
    function ajax_customerData()
    {
        $data = $this->Show_Customers_Data();
        $this->load->view('load-customers-data', $data);
    }
    
    
    function view_customers()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('view-customers');
        } else {
            redirect('index');
        }
    }
    
    
    function Check_email()
    {
        
        $mail  = $this->input->post('mail');
        $data  = $this->db->query("select * from tbl_customers WHERE email_id='$mail' ");
        $count = $data->num_rows();
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
        
    }
    
    
    
    //=====================function to upload customer data======================
    
    public function import_customer()
    {
        
        if ($this->session->userdata('is_logged_in')) {
            $this->load->view('import-customer');
        }
        
        else {
            redirect('index');
        }
        
    }
    
    public function import_customer_list()
    {
        
        @extract($_POST);
        
        $maker_date  = date('y-m-d');
        $author_date = date('y-m-d');
        $maker_id    = $this->session->userdata('user_id');
        $author_id   = $this->session->userdata('user_id');
        
        $filename = $_FILES["customer_file"]["tmp_name"];
        
        if ($_FILES["customer_file"]["size"] > 0) {
            
            $file = fopen($filename, "r");
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
                
                if ($getData[0] != 'Phone') {
                    
                    $this->db->query("insert into tbl_customers set mobile_no='" . $getData[0] . "',first_name='" . $getData[1] . "',customer_name='" . $getData[1] . "',source='" . $getData[2] . "',anniversary='" . $getData[3] . "',date_of_birth='" . $getData[4] . "',visit_count='" . $getData[5] . "',last_visit='" . $getData[6] . "',type='" . $getData[7] . "',categories='" . $getData[8] . "',email_id='" . $getData[9] . "',gender='" . $getData[10] . "',maker_date='" . $maker_date . "',author_date='" . $author_date . "',maker_id='" . $maker_id . "',author_id='" . $author_id . "' ");
                    
                }
            }
            fclose($file);
            
        }
        
        //fclose($file);
        echo "<script>
    alert('Customers Imported Successfully');
    window.location.href = 'Customers/manage_customers';
    </script>";
        
        
        //redirect('/master/manage_item');
        
    }
    
    
}
?>