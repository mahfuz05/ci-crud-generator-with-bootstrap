<?php

class Absents extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'codegen_helper'));
        $this->load->model('common_model', '', TRUE);
    }

    function index() {
        $this->manage();
    }

    function manage() {
        $this->load->library('table');
        $this->load->library('pagination');

        //paging
        $config['base_url'] = site_url() . '/absents/manage/';
        $config['total_rows'] = $this->common_model->count('absents');
        $config['per_page'] = 3;
        $this->pagination->initialize($config);
        // make sure to put the primarykey first when selecting ,
        //eg. 'userID,name as Name , lastname as Last_Name' , Name and Last_Name will be use as table header.
        // Last_Name will be converted into Last Name using humanize() function, under inflector helper of the CI core.
        $this->data['results'] = $this->common_model->get('absents', 'id,employee_id,date,reason,pre_notified', '', $config['per_page'], $this->uri->segment(3));

        $this->load->view('absents_list', $this->data);
        //$this->template->load('content', 'absents_list', $this->data); // if have template library , http://maestric.com/doc/php/codeigniter_template
    }

    function add() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('absents') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'employee_id' => set_value('employee_id'),
                'date' => set_value('date'),
                'reason' => set_value('reason'),
                'pre_notified' => set_value('pre_notified')
            );

            if ($this->common_model->add('absents', $data) == TRUE) {
                //$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
                // or redirect
                redirect(site_url() . '/absents/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->load->view('absents_add', $this->data);
        //$this->template->load('content', 'absents_add', $this->data);
    }

    function edit() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('absents') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'employee_id' => $this->input->post('employee_id'),
                'date' => $this->input->post('date'),
                'reason' => $this->input->post('reason'),
                'pre_notified' => $this->input->post('pre_notified')
            );

            if ($this->common_model->edit('absents', $data, 'id', $this->input->post('id')) == TRUE) {
                redirect(site_url() . '/absents/manage/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->common_model->get('absents', 'id,employee_id,date,reason,pre_notified', 'id = ' . $this->uri->segment(3), NULL, NULL, true);

        $this->load->view('absents_edit', $this->data);
        //$this->template->load('content', 'absents_edit', $this->data);
    }

    function delete() {
        $ID = $this->uri->segment(3);
        $this->common_model->delete('absents', 'id', $ID);
        redirect(site_url() . '/absents/manage/');
    }

}

/* End of file absents.php */
/* Location: ./system/application/controllers/absents.php */