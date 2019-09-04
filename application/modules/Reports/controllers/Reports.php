<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

class Reports extends my_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('model_reports');
    }
    
    
    //=========================Lead==================
    
    function manage_reports()
    {
        if ($this->session->userdata('is_logged_in')) {
            //$data = $this->Manage_Lead_Data();
            $this->load->view('manage-reports');
        } else {
            redirect('index');
        }
    }
    
    function Manage_Lead_Data()
    {
        
        
        $data['result'] = "";
        $table_name     = 'tbl_leads';
        //$url        = site_url('/report/Report/searchLead?');
        $sgmnt          = "4";
        
        if ($_GET['entries'] != '') {
            $showEntries = $_GET['entries'];
        } else {
            $showEntries = 10;
        }
        
        $totalData = $this->model_report->count_lead($table_name, $this->input->get());
        
        
        if ($_GET['entries'] != '' && $_GET['filter'] != '') {
            $url = site_url('/report/Report/manage_report?filter=' . $_GET['filter'] . '&entries=' . $_GET['entries']);
        } elseif ($_GET['search'] != '' && $_GET['entries'] != '') {
            $url = site_url('/report/Report/manage_report?filter=' . $_GET['filter'] . '&user=' . $_GET['user'] . '&status=' . $_GET['status'] . '&stage=' . $_GET['stage'] . '&from_date=' . $_GET['from_date'] . '&to_date=' . $_GET['to_date'] . '&entries=' . $_GET['entries']);
        } elseif ($_GET['entries'] != '' && $_GET['search'] == '') {
            $url = site_url('/report/Report/manage_report?entries=' . $_GET['entries']);
        } elseif ($_GET['search'] != '' && $_GET['entries'] == '') {
            $url = site_url('/report/Report/manage_report?filter=' . $_GET['filter'] . '&user=' . $_GET['user'] . '&status=' . $_GET['status'] . '&stage=' . $_GET['stage'] . '&from_date=' . $_GET['from_date'] . '&to_date=' . $_GET['to_date']);
        } else {
            $url = site_url('/report/Report/manage_report?');
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
            $data['result'] = $this->model_report->filterLeadList($pagination['per_page'], $pagination['page'], $this->input->get());
        else
            $data['result'] = $this->model_report->getLead($pagination['per_page'], $pagination['page']);
        
        return $data;
        
        
    }
    
    
}
?>