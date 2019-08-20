<?php 
$yesno = array('No','Yes');
$checkbox_conf_array=array('class'=>'checkbox-inline','style'=>'color: rgba(10,120,180,50); margin-bottom:10px;');
if(!empty($user)){
;?>
<link rel='stylesheet' href='<?php echo base_url() ?>assets/css/bootstrap-fileupload.min.css' media='screen'/>
<script src='<?php echo base_url() ?>assets/js/bootstrap-fileupload.js'></script>
<div class="col col-md-8 well well-md">
  <?php echo form_open_multipart('account/edit_user/'.$user->user_id,array("id"=>"edituserForm", "role"=>"form",)); ?>
  <div style="margin-bottom: 20px;color: black;">Edit User Information for:<br/><center><h3><?php echo $user->username;?></h3></center><input type="hidden" name='username' id='username' value="<?php echo set_value('username',$user->username);?>"/></div>
  <?php echo (!empty($error) ? $error : '' ); ?>
    <fieldset>
      <legend>- Personal Information:</legend>
      <div>
        <div class="form-group">
          <div class="col-md-9">
            <div><input type="text" name='first_name' id="first_name" value="<?php echo set_value('first_name',$user->first_name);?>" class='form-control' placeholder='Name' title='First Name' required autofocus /></div>
            <div class="col-md-12" style="margin-bottom:10px;">
              <label class="radio-inline"><input type="radio" name='gender' value="1" title='Male' <?php echo isset($_POST['gender'])?($this->input->post('gender')?'checked':''):($user->gender?'checked':'');?> />Male</label>
              <label class="radio-inline"><input type="radio" name='gender' value="0" title='Female' <?php echo isset($_POST['gender'])?($this->input->post('gender')?'':'checked'):($user->gender?'':'checked');?> />Female</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="fileupload fileupload-new" data-provides="fileupload">
              <div class="fileupload-preview thumbnail" style="width: 120px; height: 140px;"><img src="<?php echo base_url().$user->picture;?>" /></div>
              <div class="text-center"> 
                <span class="btn btn-file btn-default"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                <input type="file" name="picture" id="picture" /></span>
                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none" title="Remove the selected picture">&times;</a>
              </div>  
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </fieldset>
    <fieldset>
      <legend>- Additional Information:</legend>
      <div>
        <div class="form-group">
          <div class="col-md-6"><input type='email' name='email' id='email' value="<?php echo set_value('email',$user->email);?>" class='form-control' placeholder='Email' title='Email' required /></div>
        </div>
        <div class="form-group">
          <div class="col-md-6"><input type='phone' name='phone' id='phone' value="<?php echo set_value('phone',$user->phone);?>" class='form-control' placeholder='Phone' title='Phone' required/></div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">
          <div class="col-md-12"><input type="text" name='address' id='address' value="<?php echo set_value('address',$user->address);?>" class='form-control' placeholder='Address' title='Address'/></div>
        </div>
        <?php if($this->bitauth->is_admin()){?>

            <input type="hidden" name='position' id='position' value="<?php echo set_value('position',$user->position);?>" class='form-control' placeholder='Position' title='Position'/>
    
        <?php }?>
       
        <div class="form-group">
          <div class="col-md-6"><input type="date" name='birth_date' id='birth_date' value="<?php echo set_value('birth_date',date('Y-m-d',$user->birth_date));?>" class='form-control' placeholder='Birth Date' title='Birth Date'/></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </fieldset>
    <fieldset>
      <legend>- Account Settings:</legend>
      <div>
        <?php if($this->bitauth->is_admin()){?>
        <div class="form-group">
          <div class="col-md-3"><?php echo form_label(form_checkbox('active',1,isset($_POST['active'])?($_POST['active']?TRUE:FALSE):($user->active?TRUE:FALSE),"id='active'").' Active','active',$checkbox_conf_array);?></div>
          <div class="col-md-3"><?php echo form_label(form_checkbox('enabled',1,isset($_POST['enabled'])?($_POST['enabled']?TRUE:FALSE):($user->enabled?TRUE:FALSE),"id='enabled'").' Enable','enabled',$checkbox_conf_array);?></div>
          <div class="col-md-6"><?php echo form_label(form_checkbox('password_never_expires',1,isset($_POST['password_never_expires'])?($_POST['password_never_expires']?TRUE:FALSE):($user->password_never_expires?TRUE:FALSE),"id='password_never_expires'").' Password Never Expires','password_never_expires',$checkbox_conf_array);?></div>
        </div><div class="clearfix"></div>
        <?php }if(!$this->bitauth->is_admin()){?>
        <div class="form-group" title="">
          <div class="col-md-12"><input type='password' name='old_password' id='old_password' class='form-control' placeholder='Old Password' title='Old Password'/></div>
        </div>
        <?php }?>

        <div class="form-group" title="Only enter a password if you would like to set a new one">
          <div class="col-md-6"><input type='password' name='password' id='password' class='form-control' placeholder='New Password' title='New Password'/></div>
          <div class="col-md-6"><input type='password' name='password_conf' id='password_conf' class='form-control' placeholder='Confirm New Password' title='Confirm New Password' /></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </fieldset>
    <fieldset>
      <legend>- Description:</legend>
      <div>
        <div class="form-group">
          <div class="col-md-12"><textarea name="memo" id="memo" class="form-control" rows="5"><?php echo set_value('memo',$user->memo);?></textarea></div>
        </div>
      </div>
    </fieldset>
    <div class="form-group">
      <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Update' class="form-control btn btn-info" /></div>
      <div class="col-md-6"><?php echo anchor('account/users','Cancel',array('class'=>'form-control btn btn-info'));?></div>
    </div>
  <?php echo form_close(); ?>
</div>
<?php 
}else{
  echo '<div class="alert alert-danger text-center"><h1>User Not Found</h1></div><div class="pull-right" title="Go to Users">'.anchor('account/users', '<span class="glyphicon glyphicon-arrow-left"></span>').'</div>';
}
?>
