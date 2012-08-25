<?php

class Customers extends MX_Controller {
    
    function __construct() {
        parent::__construct();
		$this->load->library('form_validation');		
		$this->load->helper(array('form','url','codegen_helper'));
		$this->load->model('common_model','',TRUE);
	}	
	
	function index(){
		$this->manage();
	}

	function manage(){
        $this->load->library('table');
        $this->load->library('pagination');
        
        //paging
        $config['base_url'] = site_url().'/customers/manage/';
        $config['total_rows'] = $this->common_model->count('customers');
        $config['per_page'] = 3;	
        $this->pagination->initialize($config); 	
        // make sure to put the primarykey first when selecting , 
		//eg. 'userID,name as Name , lastname as Last_Name' , Name and Last_Name will be use as table header.
		// Last_Name will be converted into Last Name using humanize() function, under inflector helper of the CI core.
		$this->data['results'] = $this->common_model->get('customers','customer_id,business_name,contact_no,country,city,address,postcode,email,business_reg,contact_name,menufacturer,buying_house,trader','',$config['per_page'],$this->uri->segment(3));
       
	   $this->load->view('customers_list', $this->data); 
       //$this->template->load('content', 'customers_list', $this->data); // if have template library , http://maestric.com/doc/php/codeigniter_template
		
    }
	
    function add(){        
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
		
        if ($this->form_validation->run('customers') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-error">'.validation_errors().'</div>' : false);

        } else
        {                            
            $data = array(
                    'business_name' => set_value('business_name'),
					'contact_no' => set_value('contact_no'),
					'country' => set_value('country'),
					'city' => set_value('city'),
					'address' => set_value('address'),
					'postcode' => set_value('postcode'),
					'email' => set_value('email'),
					'business_reg' => set_value('business_reg'),
					'contact_name' => set_value('contact_name'),
					'menufacturer' => set_value('menufacturer'),
					'buying_house' => set_value('buying_house'),
					'trader' => set_value('trader')
            );
           
			if ($this->common_model->add('customers',$data) == TRUE)
			{
				//$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
				// or redirect
				redirect(site_url().'/customers/manage/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="alert alert-error"><p>An Error Occured.</p></div>';

			}
		}		   
		$this->load->view('customers_add', $this->data);   
        //$this->template->load('content', 'customers_add', $this->data);
    }	
    
    function edit(){        
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
		
        if ($this->form_validation->run('customers') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-error">'.validation_errors().'</div>' : false);

        } else
        {                            
            $data = array(
                    'business_name' => $this->input->post('business_name'),
					'contact_no' => $this->input->post('contact_no'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'address' => $this->input->post('address'),
					'postcode' => $this->input->post('postcode'),
					'email' => $this->input->post('email'),
					'business_reg' => $this->input->post('business_reg'),
					'contact_name' => $this->input->post('contact_name'),
					'menufacturer' => $this->input->post('menufacturer'),
					'buying_house' => $this->input->post('buying_house'),
					'trader' => $this->input->post('trader')
            );
           
			if ($this->common_model->edit('customers',$data,'customer_id',$this->input->post('customer_id')) == TRUE)
			{
				redirect(site_url().'/customers/manage/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';

			}
		}

		$this->data['result'] = $this->common_model->get('customers','customer_id,business_name,contact_no,country,city,address,postcode,email,business_reg,contact_name,menufacturer,buying_house,trader','customer_id = '.$this->uri->segment(3),NULL,NULL,true);
		
		$this->load->view('customers_edit', $this->data);		
        //$this->template->load('content', 'customers_edit', $this->data);
    }
	
    function delete(){
            $ID =  $this->uri->segment(3);
            $this->common_model->delete('customers','customer_id',$ID);
            redirect(site_url().'/customers/manage/');
    }
}

/* End of file customers.php */
/* Location: ./system/application/controllers/customers.php */