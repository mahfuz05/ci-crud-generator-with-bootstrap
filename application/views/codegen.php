<html>
<head>
<title>CRUD Generator for CodeIgniter</title>
<link type="text/css" href="<?php echo base_url()?>public/css/bootstrap.min.css" >
<link type="text/css" href="<?php echo base_url()?>public/css/bootstrap-responsive.min.css" >
</head>
<body>
     <div class="container">
<table width="900" border="0" align="center" cellspacing="0" cellpadding="1" class="table">
    <tr>
        <td align="center" bgcolor="#f0f0f0">
            <h1>CodeIgniter - Code Generator </h1>
        </td>
    </tr>
    <tr>
        <td>




<form action="<?php echo current_url();?>" method="post" class="well form-horizontal">
<p>MySQL Table
<?php
$db_tables = $this->db->list_tables();
echo form_dropdown('table',$db_tables);
?>
<input type="submit" name="table_data" value="Get Table Data" /></p>
</form>
<form action="<?php echo current_url();?>" method="post">
<?php
if(isset($alias)){
?>
<input type="hidden" name="table" value="<?php echo $table ?>" />
<table class="table">
    <thead>
<tr>
    <th>
        <p>Controller Name: <input type="text" name="controller" value="<?php echo $table ?>" />      </p>
        <p>
        View Name: <input type="text" name="view" value="<?php echo $table ?>" /></p>
        <p>
        Validation Name: <input type="text" name="validation" value="<?php echo $table ?>" />
         <input type="submit" name="generate" value="Generate" /></p>    
    </th>
</tr>
</thead>
<tr>
    <td>
    <h3>Table Data</h3>
    <?php
    //p($alias);
    
    $type = array(
                'exclude'  =>'Do not include',
                'text' => 'text input',
                'password' => 'password',
                'textarea' => 'textarea' , 
                'dropdown' => 'dropdown',
                'checkbox' => 'checkbox',
                'radio' => 'radio',
                'hidden' => 'hidden'
                );
    
   
   $sel = '';
    if(isset($alias)){
        foreach($alias as $a){
             $email_default = FALSE;
            echo '<p> Field: '.$a->Field.'<br>Label:'.form_input('field['.$a->Field.']', ucfirst($a->Field)).' '.$a->Type;
            
           
            if(strpos($a->Type,'enum') !== false){
                echo ' <br>Enum Values (CSV): <input size="50" type="text" value="'.htmlspecialchars ("'0'=>'Value','1'=>'Another Value'").'" name="'.$a->Field.'default">';
                $sel = 'dropdown';
            }elseif(strpos($a->Type,'blob') !== false || strpos($a->Type,'text') !== false){
                $sel = 'textarea';
            }else if($a->Key == 'PRI'){
                $sel = 'exclude';
                echo form_hidden('primaryKey',$a->Field);
            }else if(strpos($a->Field,'password') !== false){
                $sel = 'password';
            }else if(strpos($a->Field,'email') !== false){
                $email_default = TRUE;
            }else{
                 $sel = 'text';
            }
             echo '<br> Type::'.form_dropdown('type['.$a->Field.'][]', $type,$sel);
            echo '<br>';
            echo form_checkbox('rules['.$a->Field.'][]', 'required', TRUE) . ' required :: ';
            echo form_checkbox('rules['.$a->Field.'][]', 'trim', TRUE) . ' trim :: ';
            echo form_checkbox('rules['.$a->Field.'][]', 'valid_email', $email_default) . ' email :: ';
            echo form_checkbox('rules['.$a->Field.'][]', 'xss_clean', TRUE) . ' xss_clean ::';
            //echo ':: custom rule '. form_input('rules['.$a->Field.'][]', '');
            echo '</p>';
            
        }
    }
    ?>
    </td>
</tr>
</table>

</form>
<?php
}
?>

            </td>
    </tr>

    </table>
     </div>
    <script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.1.8.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>public/js/bootstrap.min.js"></script>
</body>
</html>
