<?php

/*
 * CI Generator
 * http://ci-generator.keithics.com/
 * Copyright (c) 2011 Keith Levi Lumanog
 * Dual MIT and GPL licenses.
 *
 * A CI genetor to easily generates CRUD CODE, feel free to improve my code or customized it the way you like.
 * as inspired by Gii of Yii Framework. Last update April 3, 2011
 */
 

class Codegen extends CI_Controller
{
    function index(){
        $data = '';
        $this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
        if ($this->input->post('table_data') || !$_POST)
        {
            // get table data
            $this->form_validation->set_rules('table', 'Table', 'required|trim|xss_clean|max_length[200]');

            if ($this->form_validation->run() == false)
            {
				
            } else
            {

                $table = $this->db->list_tables();
                $data['table'] = $table[$this->input->post('table')];
                $result = $this->db->query("SHOW FIELDS from " . $data['table']);
                $data['alias'] = $result->result();
                

                
            }
            
            
            $this->load->view('codegen', $data);

        } else
            if ($this->input->post('generate'))
            {
                $this->load->helper('file');
                
                $all_files = array(
                    'application/config/form_validation.php',
                    'application/controllers/'.$this->input->post('controller').'.php',
                    'application/models/codegen_model.php',
                    'application/views/'.$this->input->post('view').'/add.php',
                    'application/views/'.$this->input->post('view').'/edit.php',
                    'application/views/'.$this->input->post('view').'/list.php'
                    );

                //checking of files if they existed. comment if you want to overwrite files!
                $err = 0;
                /*** // uncomment me to allow overwrites
                foreach($all_files as $af){
                    if($this->fexist($af)){
                        $err++;
                        echo $this->fexist($af)."<br>";    
                    }
                }
                
                if($err > 0){
					echo 'Files Exists - Generator stopped.<br>';
                    echo '<h3>Post Data Below:</h3><br>';
                    echo '<pre>';
                    print_r($_POST);
                    echo '<pre>';
                    exit;
                }
                ***/
                $rules = $this->input->post('rules');
                $label = $this->input->post('field');
                $type = $this->input->post('type');
                $lang = array();

                $lang[] = '<?php ';
                
                
                // looping of labels and forms , for edit and add
                foreach($label as $k => $v){
                    if($type[$k][0] != 'exclude'){
                    $labels[] = $v;
                    $form_fields[] = $k;
                    if($rules[$k][0] != 'required'){
                        $required = '';
                    }else{
                        $required = '<span class="required">*</span>';        
                    }

                    $lang[] = '$lang["'.$k.'"] = "'.$v.'";';

                    // this will create a form for Add and Edit , quite dirty for now
                    if($type[$k][0] == 'textarea'){
                         $add_form[] = '
                                    <div class="control-group"><label for="'.$k.'" class="control-label"><?php echo lang(\''.$k.'\');?>'.$required.': </label>
                                    <div class="controls"><textarea id="'.$k.'" name="'.$k.'" class="input-xlarge" row="3"><?php echo set_value(\''.$k.'\'); ?></textarea>
                                    <span class="help-inline"><?php echo form_error(\''.$k.'\',\'<div class="error">\',\'</div>\'); ?></span></div>
                                    </div>
                                    ';
                                    
                         $edit_form[] = '
                                    <div class="control-group"><label for="'.$k.'" class="control-label"><?php echo lang(\''.$k.'\');?>'.$required.': </label>
                                    <div class="controls"><textarea id="'.$k.'" name="'.$k.'" class="input-xlarge" row="3"><?php echo $result->'.$k.' ?></textarea>
                                    <span class="help-inline"<?php echo form_error(\''.$k.'\',\'<div class="error">\',\'</div>\'); ?></span></div>
                                    </div>
                                    ';

                         $view_form[] = '
                                    <div class="control-group"><label for="'.$k.'" class="control-label"><?php echo lang(\''.$k.'\');?></label>
                                    <div class="controls"><?php echo $result->'.$k.' ?>  </div>                                  
                                    </div>
                                    ';
                                    
                    }else if($this->input->post($k.'default')){
                        $enum = explode(',',$this->input->post($k.'default'));
                         $add_form[] = '
                                    <div class="control-group"><label for="'.$k.'" class="control-label"><?php echo lang(\''.$k.'\');?>'.$required.': </label>
                                    <div class="controls"><?php
                                    $enum = array('.$this->input->post($k.'default').'); 
                                    echo form_dropdown(\''.$k.'\', $enum); 
                                    ?>
                                    <span class="help-inline"<?php echo form_error(\''.$k.'\',\'<div class="error">\',\'</div>\'); ?></span></div>
                                    </div>
                                    ';
                        $edit_form[] = '
                                    <div class="control-group"><label for="'.$k.'" class="control-label"><?php echo lang(\''.$k.'\');?>'.$required.': </label>
                                    <div class="controls"><?php
                                    $enum = array('.$this->input->post($k.'default').');                                                                    
                                    echo form_dropdown(\''.$k.'\', $enum,$result->'.$k.'); ?>
                                    <span class="help-inline"<?php echo form_error(\''.$k.'\',\'<div class="error">\',\'</div>\'); ?></span></div>
                                    </div>
                                    ';

                        $view_form[] = '
                                    <div class="control-group"><label for="'.$k.'" class="control-label"><?php echo lang(\''.$k.'\');?></label>
                                    <div class="controls"><?php echo $result->'.$k.' ?></div>
                                    </div>
                                    ';
                    }
                    else{
                        //input
                        $class = "";

                        if($type[$k][0] == "text")
                            $class =' class="input-xlarge" ';

                        $add_form[] = '
                                    <div class="control-group"><label for="'.$k.'" class="control-label"><?php echo lang(\''.$k.'\');?>'.$required.': </label>
                                    <div class="controls"><input id="'.$k.'" type="'.$type[$k][0].'" name="'.$k.'" value="<?php echo set_value(\''.$k.'\'); ?>" '.$class.' />
                                    <span class="help-inline"<?php echo form_error(\''.$k.'\',\'<div class="error">\',\'</div>\'); ?></span></div>
                                    </div>
                                    ';
                        $edit_form[] = '
                                    <div class="control-group"><label for="'.$k.'" class="control-label"><?php echo lang(\''.$k.'\');?>'.$required.': </label>
                                    <div class="controls"><input id="'.$k.'" type="'.$type[$k][0].'" name="'.$k.'" value="<?php echo $result->'.$k.' ?>" '.$class.' />
                                    <span class="help-inline"<?php echo form_error(\''.$k.'\',\'<div class="error">\',\'</div>\'); ?></span></div>
                                    </div>
                                    ';

                        $view_form[] = '
                                    <div class="control-group"><label for="'.$k.'" class="control-label"><?php echo lang(\''.$k.'\');?></label>
                                    <div class="controls"><?php echo $result->'.$k.' ?></div>
                                    </div>
                                    ';
                        }
                    }
                }
              
                // this will ensure that the primary key will be selected first.
                $fields_list[] = $this->input->post('primaryKey');
                // looping of rules 
                foreach($rules as $k => $v){
                    $rules_array = array();
                    if($type[$k][0] != 'exclude'){
                        
                        foreach($rules[$k] as $k1 => $v1){
                            if($v1){
                            $rules_array[] = $v1;
                            }
                        }
                        $form_rules = implode('|',$rules_array);
                        $form_val_data[] = "array(
                                \t'field'=>'".$k."',
                                \t'label'=>'".$label[$k]."',
                                \t'rules'=>'".$form_rules."'
                                )";
                        $controller_form_data[] = "'".$k."' => set_value('".$k."')";
                        $controller_form_editdata[] = "'".$k."' => \$this->input->post('".$k."')";
                        $fields_list[] = $k;   
                    }
                }
                
                
                $fields = implode(',',$fields_list);
                
                $form_data = implode(','."\n\t\t\t\t\t\t\t\t",$form_val_data);
                
                $file_validation = 'output/config/form_validation.php';
                $file_lang = 'output/lang/english.php';
                
                $search_form = array('{validation_name}','{form_val_data}');
                $replace_form = array($this->input->post('validation'),$form_data);
                $form_content = str_replace($search_form,$replace_form,file_get_contents('templates/form_validation.php'));
                
               ////////////////////
                $c_path = 'output/controllers/';
                $m_path = 'output/models/';
                $v_path = 'output/views/';
                
                ///////////////// controller
                $controller = file_get_contents('templates/controller.php');
                $search = array('{controller_name}', '{view}', '{table}','{validation_name}',
                '{data}','{edit_data}','{controller_name_l}','{primaryKey}','{fields_list}');
                $replace = array(
                            ucfirst($this->input->post('controller')), 
                            $this->input->post('view'),
                            $this->input->post('table'),
                             $this->input->post('validation'),
                             implode(','."\n\t\t\t\t\t",$controller_form_data),
                             implode(','."\n\t\t\t\t\t",$controller_form_editdata),
                             $this->input->post('controller'),
                             $this->input->post('primaryKey'),
                             $fields
                            );

                $c_content = str_replace($search, $replace, $controller);

                $model = file_get_contents('templates/crud_model.php');
                $file_controller = $c_path . $this->input->post('controller') . '.php';
                $file_model = $m_path . $this->input->post('controller') . '_model.php';
                $m_content = str_replace('{Crud_model}', ucfirst($this->input->post('controller').'_model'), $model);

              
                // create view/form, TODO, make this a function! and make a stop overwriting files
                
                //VIEW/LIST FORM
                $list_v = file_get_contents('templates/list.php');
                
                $list_content = str_replace('{controller_name_l}',$this->input->post('controller'),$list_v);
                
 
                
                //ADD FORM
                $add_v = file_get_contents('templates/add.php');
                
                $add_content = str_replace('{forms_inputs}',implode("\n",$add_form),$add_v);
                
                //EDIT FORM
                $edit_v = file_get_contents('templates/edit.php');
                $edit_search = array('{forms_inputs}','{primary}');
                $edit_replace = array(implode("\n",$edit_form),'<?php echo form_hidden(\''.$this->input->post('primaryKey').'\',$result->'.$this->input->post('primaryKey').') ?>');
                
                $edit_content = str_replace($edit_search,$edit_replace,$edit_v);


                //view page
                $view_v = file_get_contents('templates/view.php');
                $view_search = array('{forms_inputs}');
                $view_replace = array(implode("\n",$view_form));

                $view_content = str_replace($view_search,$view_replace,$view_v);

                $lang[] = '?> ';

                $lang_content = implode("\n", $lang);

                if(!is_dir($v_path.$this->input->post('view')))
                {
                    mkdir($v_path.$this->input->post('view'),0777,true);
                }

                $write_files = array(
                                'Controller' => array($file_controller, $c_content),
                                'model' => array($file_model, $m_content),
                                'view_edit'  => array($v_path.$this->input->post('view').'/edit.php', $edit_content),
                                'view_list'  => array($v_path.$this->input->post('view').'/list.php', $list_content),
                                'view_add'  => array($v_path.$this->input->post('view').'/add.php', $add_content),
                                'view_view'  => array($v_path.$this->input->post('view').'/view.php', $view_content)
                                );
                foreach($write_files as $wf){
                    if($this->writefile($wf[0],$wf[1])){
                        $err++;
                        echo $this->writefile($wf[0],$wf[1]);
                    }
                }


                $this->writefile($file_validation,$form_content, "a"); // appent mode validation file
                $this->writefile($file_lang,$lang_content, "a"); // appent mode validation file
                                                    
               if($err >0){
                    exit;
                }else{                                       
                    echo 'DONE!';
                }   
            }// if generate
    }
    
    function fexist($path){
             if (file_exists($path))
            {
                // todo , automatically adds new validation
                return $path.' - File exists <br>';                    
            }
            else{
                return false;
            }        
    }
    
    function writefile($file,$content, $perm = "w+"){
        
        if (!write_file($file, $content, $perm))
        {
            return $file. ' - Unable to write the file';
        } else
        {
            return false;
        }
    }


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/crud.php */
