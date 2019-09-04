<?php
class model_master extends CI_Model
{
    
    public function getuserlist()
    {
        $query = $this->db->query("select * from tbl_user_mst where status='A' AND user_id='" . $this->session->userdata('user_id') . "' ORDER BY user_id DESC");
        return $result = $query->result();
    }
    
    
    function filterUserList($perpage, $pages, $get)
    {
        
        $qry = "select * from tbl_user_mst where status = 'A'";
        
        $qry .= " LIMIT $pages,$perpage";
        $data = $this->db->query($qry)->result();
        return $data;
        
    }
    
    function count_User_List($tableName, $get)
    {
        
        $qry = "select count(*) as countval from $tableName where status='A' AND user_id='" . $this->session->userdata('user_id') . "' ";
        
        $query = $this->db->query($qry, array(
            $status
        ))->result_array();
        
        return $query[0]['countval'];
        
    }
    
    
}
?>