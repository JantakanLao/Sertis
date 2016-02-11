<?php
class ModelPage extends CI_Model{
    
    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();	
            $this->load->database();
            $this->load->library('session');
	       	
    }
    public function regis($username='',$email='',$confirmpassword='')
    {
    	$this->db->insert('user_account',[
    				'username' => $username,
					'email'    => $email,
					'password' => $confirmpassword,    
				]);
                
        $user_id = $this->db->insert_id();
	    $newdata = array(
	       'username'  => $username,
           'email'     => $email,
           'password'  => $confirmpassword,
           'logged_in' => TRUE,
		   'user_id'   => $user_id,
		);

		$this->session->set_userdata($newdata);
        
        return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : false;
    }
    public function check_email($email='')
    {
        $query = $this->db->get_where('user_account', ['email' => $email]);
        $num   = $query->num_rows();
        
        return $num;
    }
    public function login($email='',$password='')
    {

        $query = $this->db->get_where('user_account', array(
        		'email'  	=> $email,
                'password'	=> $password				
        ));

        foreach ($query->result_array() as $row)
        {
                $user_id    = $row['user_id'];
                $username    = $row['username'];

        }  

        $newdata = array(
        	   'username'  => $username,
               'email'     => $email,
               'password'  => $password,
               'logged_in' => TRUE,
               'user_id'   => $user_id,
            );
            
		$this->session->set_userdata($newdata);
        $num = $query->num_rows();
        return ( $num > 0)? true : false;   
    }
    public function retrieve_allinfo()
	{
		$result = [];
		$query1 = $this->db->get_where('card', [
					'status' => "public"			
			]);

		foreach($query1->result_array() as $row)
		{
			$result[] = [
				'card_id'	    => $row['card_id'],
	            'name'	    	=> $row['name'],
	            'status'	    => $row['status'],
	            'content'	    => $row['content'],
	            'category'	    => $row['category'],
	            'author'	    => $row['author'],
	            'user_id'	    => $row['user_id'],
			];
		}
		
		return $result;   
	} 
	public function retrieve_info($user_id = '')
	{
		$result = [];
		$this->db->order_by("card_id", "desc"); 
		$query1 = $this->db->get_where('card',['user_id' => $user_id ]);
		foreach ($query1->result_array() as $row)
		{
			$result[] = [
				'card_id'	    => $row['card_id'],
	            'name'	    	=> $row['name'],
	            'status'	    => $row['status'],
	            'content'	    => $row['content'],
	            'category'	    => $row['category'],
	            'author'	    => $row['author'],
	            'user_id'	    => $row['user_id'],
			];
		}
		return $result;
	}   
	public function add_newcard($user_id='',$name='',$status='',$content='',$category='',$author='')
	{
		$this->db->insert('card',[
				'name'          => $name,
				'status'	    => $status,
	            'content'	    => $content,
	            'category'	    => $category,
	            'author'	    => $author,
	            'user_id'	    => $user_id,

			]);

		return ($this->db->affected_rows() == 1) ? true : false;
	
	}
	public function retrieve_editcard($card_id)
	{
		$query = $this->db->get_where('card',['card_id' => $card_id ]);
		foreach ($query->result_array() as $row)
		{
			
			$result= array(  
					  	'card_id'	    => $row['card_id'],
			            'name'	    	=> $row['name'],
			            'status'	    => $row['status'],
			            'content'	    => $row['content'],
			            'category'	    => $row['category'],
			            'author'	    => $row['author'],
			            'user_id'	    => $row['user_id'],
			);	  
		}
		return $result;
	}

	public function edit_oldcard($card_id=0,$name='',$status='',$content='')
	{
		$where = "card_id = {$card_id}";
        $this->db->update('card',[
            'name'    => $name,
            'status'  => $status,
            'content' => $content,
        ],$where);
	
    return ($this->db->affected_rows() >= 1) ? TRUE:FALSE;
	}
	public function delete_card($card_id)
    {
	    $this->db->where('card_id', $card_id);
		$this->db->delete('card'); 
		
		return ($this->db->affected_rows() == 1) ? TRUE:FALSE;
    }
    public function retrieve_category($category='')
	{
		$result = [];
		$query1 = $this->db->get_where('card', [
					'category' => $category,
					'status'   => "public"	
			]);

		foreach($query1->result_array() as $row)
		{
			$result[] = [
				'card_id'	    => $row['card_id'],
	            'name'	    	=> $row['name'],
	            'status'	    => $row['status'],
	            'content'	    => $row['content'],
	            'category'	    => $row['category'],
	            'author'	    => $row['author'],
	            'user_id'	    => $row['user_id'],
			];
		}
		
		return $result;   
	} 
}
?>