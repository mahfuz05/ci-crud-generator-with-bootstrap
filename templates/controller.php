<?php

class {controller_name} extends MX_Controller {
    
    function __construct() {
        parent::__construct();
		$this->load->library('form_validation');		
		$this->load->helper(array('form','url','codegen_helper'));
		$this->load->model('{controller_name}_model','common_model',TRUE);
                $this->lang->load("english", "english");
	}	
	
	function index(){
		$this->manage();
	}

	function manage(){
        $this->load->library('table');
        $this->load->library('pagination');
        
        //paging
        $config['base_url'] = site_url().'/{controller_name_l}/manage/';
        $config['total_rows'] = $this->common_model->count('{table}');
        $config['per_page'] = 3;	
        $this->pagination->initialize($config); 	
        // make sure to put the primarykey first when selecting , 
		//eg. 'userID,name as Name , lastname as Last_Name' , Name and Last_Name will be use as table header.
		// Last_Name will be converted into Last Name using humanize() function, under inflector helper of the CI core.
		$this->data['results'] = $this->common_model->get('{table}','{fields_list}','',$config['per_page'],$this->uri->segment(3));
       
	   $this->load->view('{view}/list', $this->data); 
       
		
    }
	
    function add(){        
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
		
        if ($this->form_validation->run('{validation_name}') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-error">'.validation_errors().'</div>' : false);

        } else
        {                            
            $data = array(
                    {data}
            );
           
			if ($this->common_model->add('{table}',$data) == TRUE)
			{
				//$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
				// or redirect
				redirect(site_url().'/{controller_name_l}/manage/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="alert alert-error"><p>An Error Occured.</p></div>';

			}
		}		   
		$this->load->view('{view}/add', $this->data);   
       
    }	
    
    function edit(){        
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
		
        if ($this->form_validation->run('{validation_name}') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-error">'.validation_errors().'</div>' : false);

        } else
        {                            
            $data = array(
                    {edit_data}
            );
           
			if ($this->common_model->edit('{table}',$data,'{primaryKey}',$this->input->post('{primaryKey}')) == TRUE)
			{
				redirect(site_url().'/{controller_name_l}/manage/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';

			}
		}

		$this->data['result'] = $this->common_model->get('{table}','{fields_list}','{primaryKey} = '.$this->uri->segment(3),NULL,NULL,true);
		
		$this->load->view('{view}/edit', $this->data);		
        
    }
	
    function delete(){
            $ID =  $this->uri->segment(3);
            $this->common_model->delete('{table}','{primaryKey}',$ID);
            redirect(site_url().'/{controller_name_l}/manage/');
    }
}

/* End of file {controller_name_l}.php */
/* Location: ./system/application/controllers/{controller_name_l}.php */