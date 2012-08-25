<?php

$config = array(
                 'absents' => array(
                                array(
                                	'field'=>'employee_id',
                                	'label'=>'Employee_id',
                                	'rules'=>'required|trim|xss_clean'
                                ),
								array(
                                	'field'=>'date',
                                	'label'=>'Date',
                                	'rules'=>'required|trim|xss_clean'
                                ),
								array(
                                	'field'=>'reason',
                                	'label'=>'Reason',
                                	'rules'=>'required|trim|xss_clean'
                                ),
								array(
                                	'field'=>'pre_notified',
                                	'label'=>'Pre_notified',
                                	'rules'=>'required|trim|xss_clean'
                                )
				)
			   );
			   
?>