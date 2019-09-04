<?php
class model_campaign extends CI_Model
{
    
    //====================Welcome Data =============
    
    function get_welcome_sms_data($last, $strat)
    {
        
        
        $query = ("select * from tbl_message_log where type='Welcome' Order by sent_date DESC limit $strat,$last ");
        
        $getQuery = $this->db->query($query);
        
        return $result = $getQuery->result();
        
    }

    
    function count_welcome_sms($tableName, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where type='Welcome' ";
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }


    //================Birthday Data======================

    function get_birthday_sms_data($last, $strat)
    {
        
        
        $query = ("select * from tbl_message_log where type='Birthday' Order by sent_date DESC limit $strat,$last ");
        
        $getQuery = $this->db->query($query);
        
        return $result = $getQuery->result();
        
    }

    
    function count_birthday_sms($tableName, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where type='Birthday'";
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }

    //======================Anniversary Data=====================

    function get_anniversary_sms_data($last, $strat)
    {
        
        
        $query = ("select * from tbl_message_log where type='Anniversary' Order by sent_date DESC limit $strat,$last ");
        
        $getQuery = $this->db->query($query);
        
        return $result = $getQuery->result();
        
    }

    
    function count_anniversary_sms($tableName, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where type='Anniversary'";
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        return $query[0]['countval'];
    }    
    
    
}
?>