<?php
class ItemCRUDModel extends CI_Model{

	public function __construct() {

      parent::__construct(); 

		$CI = &get_instance();
		$this->db1 = $CI->load->database('default', TRUE);
		$this->db2 = $CI->load->database('kP_Authentication', TRUE);
		$this->db3 = $CI->load->database('kP_Wallet', TRUE);
		$this->db4 = $CI->load->database('ZAP_Gateway', TRUE);
		$this->db5 = $CI->load->database('Webcash_Gateway', TRUE);

   }
	
	
	


    public function get_itemCRUD(){

        if(!empty($this->input->get("search"))){

          /* $this->db1->like('title', $this->input->get("search"));

          $this->db1->or_like('description', $this->input->get("search"));  */

        }

       // $query = $this->db4->select("items");
	   $this->db4->where("STATUS",1);
	   $this->db4->where("wallet_topup_completed != 1");
	   $this->db4->where("DATE(created_at) >= '2018-12-07'");
	  
        $query = $this->db4->get("transactions");

        return $query->result();

    }


    public function insert_item()

    {    

        $data = array(

            'title' => $this->input->post('title'),

            'description' => $this->input->post('description')

        );

        return $this->db1->insert('items', $data);

    }


    public function update_item($id) 

    {

        $data=array(

            'title' => $this->input->post('title'),

            'description'=> $this->input->post('description')

        );

        if($id==0){

            return $this->db1->insert('items',$data);

        }else{

            $this->db->where('id',$id);

            return $this->db1->update('items',$data);

        }        

    }


    public function find_item($id)

    {

        return $this->db1->get_where('items', array('id' => $id))->row();

    }


    public function delete_item($id)

    {

        return $this->db1->delete('items', array('id' => $id));

    }

}

?>