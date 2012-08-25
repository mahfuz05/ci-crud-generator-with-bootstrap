<h1><?php echo 'DONE! view it here '. anchor(base_url().'index.php/'.$this->input->post('controller').'/'); ?></h1>

<h2>application/controllers/<?php echo $_POST['view'] ?>.php</h2>
<div style="border: #555 solid 2px; height: 200px; overflow:auto; padding:10px;">
<?php 
echo '<pre>'.htmlentities($controller).'</pre>';
?>
</div>


<h2>application/views/<?php echo $_POST['view'] ?>_add.php</h2>
<div style="border: #555 solid 2px; height: 200px; overflow:auto; padding:10px;">
<?php 
echo '<pre>'.htmlentities($add_content).'</pre>';
?>
</div>


<h2>application/views/<?php echo $_POST['view'] ?>_list.php</h2>
<div style="border: #555 solid 2px; height: 200px; overflow:auto; padding:10px;">
<?php 
echo '<pre>'.htmlentities($list_content).'</pre>';
?>
</div>



<h2>application/views/<?php echo $_POST['view'] ?>_edit.php</h2>
<div style="border: #555 solid 2px; height: 200px; overflow:auto; padding:10px;">
<?php 
echo '<pre>'.htmlentities($edit_content).'</pre>';
?>
</div>
