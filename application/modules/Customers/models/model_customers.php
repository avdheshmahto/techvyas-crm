<?php
class model_customers extends CI_Model
{
    
    
    function getCustomersData($last, $strat)
    {
        
        $query    = ("select * from tbl_customers where status='A' AND maker_id='" . $this->session->userdata('user_id') . "' Order by visit_date_time DESC limit $strat,$last");
        $getQuery = $this->db->query($query);
        return $result = $getQuery->result();
        
    }
    
    
    function filterCustomersData($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_customers where status='A' ";
        
        if ($_GET['search'] == 'search') {
            
            if ($_GET['nameSearch'] != '') {
                $qry .= " AND  customer_name LIKE '%" . $_GET['nameSearch'] . "%' ";
            }
            
            if ($_GET['mobileSearch'] != '') {
                $qry .= " AND  mobile_no='" . $_GET['mobileSearch'] . "' ";
            }
            
            if ($_GET['from_date'] != '' && $_GET['to_date'] != '') {
                
                $fdate = explode("/", $_GET['from_date']);
                
                $tdate = explode("/", $_GET['to_date']);
                
                $fdate1  = $fdate[0] . "-" . $fdate[1] . "-" . $fdate[2];
                $todate1 = $tdate[0] . "-" . $tdate[1] . "-" . $tdate[2];
                
                $qry .= " AND last_visit >='$fdate1' AND last_visit <='$todate1'";
            }
            
        }
        
        $qry .= " AND maker_id='" . $this->session->userdata('user_id') . "' ORDER BY visit_date_time DESC";
        $qry .= " LIMIT $pages,$perpage ";
        $data = $this->db->query($qry)->result();
        return $data;
        
    }
    
    
    function count_Customers($tableName, $get)
    {
        
        $qry = ("select count(*) as countval from $tableName where status='A' AND maker_id='" . $this->session->userdata('user_id') . "' ");
        
        if ($_GET['search'] == 'search') {
            
            if ($_GET['nameSearch'] != '') {
                $qry .= " AND  customer_name LIKE '%" . $_GET['nameSearch'] . "%' ";
            }
            
            if ($_GET['mobileSearch'] != '') {
                $qry .= " AND  mobile_no='" . $_GET['mobileSearch'] . "' ";
            }
            
            if ($_GET['from_date'] != '' && $_GET['to_date'] != '') {
                
                $fdate = explode("/", $_GET['from_date']);
                
                $tdate = explode("/", $_GET['to_date']);
                
                $fdate1  = $fdate[0] . "-" . $fdate[1] . "-" . $fdate[2];
                $todate1 = $tdate[0] . "-" . $tdate[1] . "-" . $tdate[2];
                
                $qry .= " AND last_visit >='$fdate1' AND last_visit <='$todate1'";
            }
            
        }
        
        $query = $this->db->query($qry)->result_array();
        return $query[0]['countval'];
        
    }
    
    
    
    //================================Pagination end================================
    
    
    
}
?>