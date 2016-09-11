</script><div class="page-title">
   <div class="row">
        <div class="col-md-11">
            <h4><span class="glyphicon glyphicon-log-in">&nbsp;</span>{user_list}</h4>
        </div>
        <div class="col-md-1">
            <a href="<?php echo BASE_URL.'acp/user/add';?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-open">&nbsp;</span>{new}</a>
        </div>
    </div>  
</div>
<!-- Search Form -->
<div class="row form-group">
    <form name="search-form" method="POST" action="">
        <div class="col-sm-3">
            <input type="text" name="keyword" class="form-control" value="" placeholder="Enter Full Name OR Username">
        </div>
        <div class="col-sm-2">
            <button type="submit" name="submit" value="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span> Tìm kiếm            </button>
            <input type="hidden" name="ci_csrf_token" value="" />
        </div>
    </form>
</div><div class="row">
    <div class="table-responsive col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="success">
                    <th>STT</th>
                    <th>{user_fullname}</th>
                    <th>{user_username}</th>
                    <th>{user_group}</th>
                    <th>{user_email}</th>
                    <th>{user_gender}</th>
                    <th>{user_status}</th>
                    <th>{edit}/{delete}</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            	$i = 1;
            	foreach ($rows as $row) {
            		$row = $this->model_user->conver_data($row);
            ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><a href="<?php echo BASE_URL.'acp/user/show/'.$row['id'];?>"><?php echo $row['fullname'];?></a></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['groups_'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['gender_'];?></td>
                    <td><?php echo $row['status_'];?></td>
                    <td>
                        <a href="<?php echo BASE_URL.'acp/user/edit/'.$row['id'];?>" class="btn btn-warning btn-xs">{edit}</a>
                        <a href="<?php echo BASE_URL.'acp/user/delete/'.$row['id'];?>" class="btn btn-danger btn-xs">{delete}</a>
                    </td>
                </tr> 
            <?php
        		}
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
    	<?php echo $this->pagination->pageslist();?><!--Hiển thị phân trang*/-->
    </div>
</div>