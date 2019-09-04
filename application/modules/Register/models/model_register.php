<?php
class model_register extends CI_Model
{
    
    
    //=============================Contact Master===============================
    
    function contact_get($last, $strat)
    {
        $query = $this->db->query("select * from tbl_contact_m where status='A' ORDER BY contact_id DESC limit $strat,$last");
        return $result = $query->result();
    }
    
    function filterContactList($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_contact_m where status = 'A'";
        
        $qry .= " LIMIT $pages,$perpage";
        $data = $this->db->query($qry)->result();
        return $data;
        
    }
    
    function count_contact($tableName, $status = 0, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where status='A'";
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        
        return $query[0]['countval'];
        
    }
    
}
?>