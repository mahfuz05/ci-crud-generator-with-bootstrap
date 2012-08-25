<?php     
$attributes = array('class'=>'well form-horizontal');
echo form_open(current_url(),$attributes); ?>
<fieldset>
    <div class="alert alert-error">
        <?php echo $custom_error; ?>
    </div>       
<?php echo form_hidden('customer_id',$result->customer_id) ?>

                                    <div class="control-group"><label for="business_name" class="control-label"><?php echo lang('business_name');?><span class="required">*</span></label>
                                    <div class="controls"><input id="business_name" type="text" name="business_name" value="<?php echo $result->business_name ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('business_name','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="contact_no" class="control-label"><?php echo lang('contact_no');?><span class="required">*</span></label>
                                    <div class="controls"><input id="contact_no" type="text" name="contact_no" value="<?php echo $result->contact_no ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('contact_no','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="country" class="control-label"><?php echo lang('country');?><span class="required">*</span></label>
                                    <div class="controls"><input id="country" type="text" name="country" value="<?php echo $result->country ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('country','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="city" class="control-label"><?php echo lang('city');?><span class="required">*</span></label>
                                    <div class="controls"><input id="city" type="text" name="city" value="<?php echo $result->city ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('city','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="address" class="control-label"><?php echo lang('address');?><span class="required">*</span></label>
                                    <div class="controls"><input id="address" type="text" name="address" value="<?php echo $result->address ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('address','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="postcode" class="control-label"><?php echo lang('postcode');?><span class="required">*</span></label>
                                    <div class="controls"><input id="postcode" type="text" name="postcode" value="<?php echo $result->postcode ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('postcode','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="email" class="control-label"><?php echo lang('email');?><span class="required">*</span></label>
                                    <div class="controls"><input id="email" type="text" name="email" value="<?php echo $result->email ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('email','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="business_reg" class="control-label"><?php echo lang('business_reg');?><span class="required">*</span></label>
                                    <div class="controls"><input id="business_reg" type="text" name="business_reg" value="<?php echo $result->business_reg ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('business_reg','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="contact_name" class="control-label"><?php echo lang('contact_name');?><span class="required">*</span></label>
                                    <div class="controls"><input id="contact_name" type="text" name="contact_name" value="<?php echo $result->contact_name ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('contact_name','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="menufacturer" class="control-label"><?php echo lang('menufacturer');?><span class="required">*</span></label>
                                    <div class="controls"><input id="menufacturer" type="text" name="menufacturer" value="<?php echo $result->menufacturer ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('menufacturer','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="buying_house" class="control-label"><?php echo lang('buying_house');?><span class="required">*</span></label>
                                    <div class="controls"><input id="buying_house" type="text" name="buying_house" value="<?php echo $result->buying_house ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('buying_house','<div class="error">','</div>'); ?>
                                    </div>
                                    

                                    <div class="control-group"><label for="trader" class="control-label"><?php echo lang('trader');?><span class="required">*</span></label>
                                    <div class="controls"><input id="trader" type="text" name="trader" value="<?php echo $result->trader ?>"  class="input-xlarge"  /></div>
                                    <?php echo form_error('trader','<div class="error">','</div>'); ?>
                                    </div>
                                    
 <div class="form-actions">
        <?php $data = array(
    'name' => 'button',
    'id' => 'button',
    'value' => 'true',
    'type' => 'submit',
    'content' => 'Submit',
    'class'=>'btn btn-primary'        
);

echo form_button($data); ?>
 </div>
</fieldset>

<?php echo form_close(); ?>
