<?php if ($this->current_action=="index") {?>
<div id="content1"><?php include "app/views/frontend/bainoibat/bainoibat.php"; ?></div>
<div id="info">  </div>
<div id="content2"><?php include "app/views/frontend/baixemnhieu/baixemnhieu.php"; ?></div>  
<?php }?>  
<div id="content3">  </div>
<div id="quangcao">
	<a href="#"> <img src="<?=BASE_URL?>assets/frontend/img/template/qc1.jpg" width="400" height="90" align=left> </a>
	<a href="#"> <img src="<?=BASE_URL?>assets/frontend/img/template/qc4.gif" width="385" height="90" align=left> </a>
</div>
<div id="content4">
<?php 
	switch($this->current_action) {
		case 'cat' : include "app/views/frontend/baitrongloai/baitrongloai.php";break;
		case 'detail' : include "app/views/frontend/detail/detail.php";break;
		default : include "app/views/frontend/baimoi/baimoi.php";break;
	}
?>
</div>   