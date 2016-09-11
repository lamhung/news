<div class="page-title">
   <div class="row">
        <div class="col-md-12">
            <h4><span class="glyphicon glyphicon-log-in">&nbsp;</span>Thông tin nhân viên</h4>
        </div>
    </div>  
</div>
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tbody>
            <tr>
                <td class="col-md-2 text-right">{user_fullname}</td>
                <td class="col-md-10"><?php echo $row['fullname'];?></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_username} :</td>
                <td class="col-md-10"><?php echo $row['username'];?></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_group} :</td>
                <td class="col-md-10"><?php echo $row['groups_'];?></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_image} :</td>
                <td class="col-md-10"><img src="<?php echo $row['image_'];?>"></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_phone} :</td>
                <td class="col-md-10"><?php echo $row['phone'];?></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_email} :</td>
                <td class="col-md-10"><?php echo $row['email'];?></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_address} :</td>
                <td class="col-md-10"><?php echo $row['address'];?></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_gender} :</td>
                <td class="col-md-10"><?php echo $row['gender_'];?></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_birthday} :</td>
                <td class="col-md-10"><?php echo $row['birthday'];?></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_status} :</td>
                <td class="col-md-10"><?php echo $row['status_'];?></td>
            </tr>
            <tr>
                <td class="col-md-2 text-right">{user_create_at} :</td>
                <td class="col-md-10"><?php echo $row['create_at_'];?></td>
            </tr>        
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-offset-5">
        <a href="<?php echo  BASE_URL.'acp/user'; ?>"class="btn btn-info active">{come_back}</a>
        <a href="<?php echo  BASE_URL.'acp/user/edit/'.$row['id']; ?>" class="btn btn-warning btn-md">{edit}</a>
        <a href="<?php echo  BASE_URL.'acp/user/delete/'.$row['id']; ?>" class="btn btn-danger btn-md" onclick="return confirm('Are you sure?');">{delete}</a>
    </div>
</div> 