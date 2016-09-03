<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
  <div class="form-group  <?php if(isset($error['fullname'])) echo 'has-error';?>">
    <label class="col-md-3 control-label" for="fullname">{user_fullname} :</label>
    <div class="col-md-6">
      <input type="text" class="form-control"  name="fullname" id="fullname" value="<?php echo set_value('fullname', $row['fullname']);?>" placeholder="Enter Fullname">
      <?php if(isset($error['fullname'])) echo $error['fullname'];?>
    </div>
  </div>
  <div class="form-group <?php if(isset($error['username'])) echo 'has-error';?>">
    <label class="col-md-3 control-label" for="username">{user_username} :</label>
    <div class="col-md-6">
      <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username', $row['username']);?>" placeholder="Enter Username">
      <?php if(isset($error['username'])) echo $error['username'];?>
    </div>
  </div>
  <div class="form-group <?php if(isset($error['password'])) echo 'has-error';?> ">
    <label class="col-md-3 control-label" for="password">{user_password} :</label>
    <div class="col-md-6">
      <input type="password" class="form-control" name="password" id="password" placeholder="Enter PassWord">
       <?php if(isset($error['password'])) echo $error['password'];?>
    </div>
  </div>
  <div class="form-group <?php if(isset($error['re_password'])) echo 'has-error';?>">
    <label class="col-md-3 control-label" for="re_password">{user_re_password} :</label>
    <div class="col-md-6">
      <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Enter RePassWord">
       <?php if(isset($error['re_password'])) echo $error['re_password'];?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label" for="group">{user_group} :</label>
    <div class="col-md-6">
      <label class="radio-inline">
        <input type="radio" name="groups" value="1" <?php echo set_radio('groups', 1,$row['groups'] ==1);?>>
        {user_group_1} </label>
      <label class="radio-inline">
        <input type="radio" name="groups" value="0"  <?php echo set_radio('groups', 0,$row['groups'] ==0);?>>
       {user_group_0} </label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label">{user_gender} :</label>
    <div class="col-md-6">
      <label class="radio-inline">
        <input type="radio" name="gender" value="1"  <?php echo set_radio('gender', 1,$row['gender'] ==1);?>>
        {user_gender_1} </label>
      <label class="radio-inline">
        <input type="radio" name="gender" value="0" <?php echo set_radio('gender', 0,$row['gender'] ==0);?>>
        {user_gender_0} </label>
    </div>
  </div>
  <div class="form-group <?php if(isset($image_error)) echo 'has-error' ;?>">
    <label class="col-md-3 control-label" for="image">{user_image} :</label>
    <div class="col-md-2"> <img src="<?php echo $row['image_'];?>" width="120" /> </div>
    <div class="col-md-4">
      <input type="file" class="form-control" name="image">
      <?php 
	  	if(isset($image_error)){;
			echo "<span class='text-danger'>".$image_error."</span>";
		}
	  ?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label" for="phone">{user_phone} :</label>
    <div class="col-md-6">
      <input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone', $row['phone']);?>" placeholder="Enter Phone">
    </div>
  </div>
  <div class="form-group <?php if(isset($error['email'])) echo 'has-error';?>">
    <label class="col-md-3 control-label" for="email">{user_email} :</label>
    <div class="col-md-6">
      <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email', $row['email']);?>" placeholder="Enter Name">
       <?php if(isset($error['email'])) echo $error['email'];?>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label" for="address">{user_address} :</label>
    <div class="col-md-6">
      <textarea class="form-control" name="address" id="address"><?php echo set_value('address', $row['address']);?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label" for="birhday">{user_birthday} :</label>
    <div class="col-md-6">
      <div class='input-group date' >
        <input type='text' name="birthday" class="form-control datepicker" id='birthday' value="<?php echo set_value('birthday', $row['birthday']);?>" placeholder="Chose birthday"/>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3" for="status">{user_status}:</label>
    <div class="col-sm-6">
      <label class="radio-inline">
        <input type="radio" name="status" value="1" <?php echo set_radio('status', 1,$row['status'] ==1);?>>
        {user_status_1} </label>
      <label class="radio-inline">
        <input type="radio" name="status" value="0" <?php echo set_radio('status', 0,$row['status'] ==0);?> >
        {user_status_0}</label>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-offset-3 col-md-9">
      <button type="submit" name="submit" value="submit" class="btn btn-primary">Lưu</button>
    </div>
  </div>
</form>
