<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControlPage extends CI_Controller {
    
    public function __construct()
    {	
        parent::__construct();
        $this->load->model('ModelPage');
		$this->load->library('session');    
    }

    public function register()
    {
		$error = array(
	        'err' => 0,
	        'msg' => '',
	        'id'  => ''
	    );

    	$this->load->library('form_validation');
	    $this->load->database();
	        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|is_unique[user_account.email]'
            ,array(
            'required'      => 'Please input %s',
            'is_unique'     => 'This %s already exists.')
           );
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required|matches[password]');

		if ($this->form_validation->run() == FALSE)
        {
           $error['msg'] = validation_errors(); 
      	   $error['err'] = 1;
        }
        else
        {
        	$error['msg']     = 'Successful';
        	$error['err']     = 0;
            $username            = $this->input->post('username');
	    	$email            = $this->input->post('email');
			$password         = $this->input->post('password');
			$confirmpassword  = $this->input->post('confirmpassword');

            $error['id']  = $this->ModelPage->regis($username,$email,$confirmpassword);
		}

		 echo json_encode($error);

    }
    
    public function login()
    {
        $email	    = $this->input->post('email');
        $password	= $this->input->post('password');
        $is_member	= $this->ModelPage->check_email($email);
        $error		= [
        				'err' =>''
        			];
        
        if($is_member >= 1)
        {
            $result = $this->ModelPage->login($email,$password);
            
            if($result == true)
            {
                $error['err'] = 0;
			}
            else{ 
                $error['err'] = 1;
                $error['msg'] = "Unsuccessful";
            }
            echo json_encode($error);           
        }

        else{ 

        	$error['err'] = 1;
        	$error['msg'] = "Unsuccessful";
        	echo json_encode($error);   
   
        }
	}

    public function retrieveallinfo()
    {
    	$temp = $this->ModelPage->retrieve_allinfo();
	        $this->output
	        	->set_content_type('application/json')
	        	->set_output(json_encode($temp));

    }

    public function retrieveinfo()
    {
    	$user_id = $this->session->userdata('user_id');
    	$temp = $this->ModelPage->retrieve_info($user_id);
	        $this->output
	        	->set_content_type('application/json')
	        	->set_output(json_encode($temp));
    }
    public function addnewcard()
    {

    	$error = array(
	        'err' => '',
	        'msg' => '',
	        
	    );

    	$user_id    = $this->session->userdata('user_id');
    	$name	    = $this->input->post('name');
        $status	    = $this->input->post('status');
        $content	= $this->input->post('content');
        $category	= $this->input->post('category');
        $author	    = $this->input->post('author');

        $result     = $this->ModelPage->add_newcard($user_id,$name,$status,$content,$category,$author);
     	
     	if($result == true)
     	{
     		$error['err'] = 0;
     		$error['msg'] = "Successful";
     	}
     	else {
     		$error['err'] = 1;
            $error['msg'] = "Unsuccessful";
     	}

     	echo json_encode($error);  
    }

   public function retrieveeditcard($cardid)
   {
   		$temp = $this->ModelPage->retrieve_editcard($cardid);
	        $this->output
	        	->set_content_type('application/json')
	        	->set_output(json_encode($temp));
   }

    public function editcardpage($cardid=0)
    {
    	
        $parse_data = [
              'cardInfo' => $this->ModelPage->retrieve_editcard($cardid),
        ];

        $this->load->view('editcard', $parse_data);
     
    }
    public function editoldcard($card_id=0)
    {
    	$error = array(
	        'err' => '',
	        'msg' => '',
	        
	    );

    	$name    = $this->input->post('name');
    	$status  = $this->input->post('status');
    	$content = $this->input->post('content');
    	
    	$result  = $this->ModelPage->edit_oldcard($card_id,$name,$status,$content);
    	if($result == true)
    	{
    		$error['err'] = 0;
    		$error['msg'] = "Successful";
    	}
		else
		{	
			$error['err'] = 1;
			$error['msg'] = "Unsuccessful";
		}
		echo json_encode($error); 

    }

    public function deletecard($cardid=0)
    {	
	    $error = array(
	        'err' => '',
	        'msg' => '',
	        
	    );
	    
	    $result = $this->ModelPage->delete_card($cardid);
	    
	    if($result == true){
		    $error['err'] = 0;
		    $error['msg'] = "Successful";
	    }
	    else
	    {
		    $error['err'] = 1;
		    $error['msg'] = "Unsuccessful";
		}
        echo json_encode($error);
			
	}

	public function retrievecategory($category='')
    {
    	$temp = $this->ModelPage->retrieve_category($category);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($temp));

    }

    public function check_session()
    {
        $return = array(
            'user_id'  => 0,
            'status'    => 0,
            'username'     => ''
        );
        
       
        $return['user_id'] = $this->session->userdata('user_id');
       
        if( ! is_null($return['user_id']) )
        {
            $return['status'] = 1;
            $return['username'] = $this->session->userdata('username');
        }

       
        echo json_encode($return);
       
    }

    public function logout()
    {
            
        $array_items = array('email','password','logged_in','user_id');
        $this->session->unset_userdata($array_items);
        
        $this->load->view('login');
            
    }

    public function registerpage()
    {
    	$this->load->view('register');
    }

    public function loginpage()
    {
    	$this->load->view('login');
    }

    public function activitypage()
    {
    	$this->load->view('activity');
    }

    public function userspage()
    {
    	$this->load->view('users');
    }
    public function categorypage($category='')
    {
       
        $parse_data = [
              'category' => $category,
        ];
        $this->load->view('category',$parse_data);
    }
    
}

