<!DOCTYPE html> <html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <base href="<?=BASE_URL?>">
   <link href="<?=BASE_URL?>assets/frontend/css/style.css" rel="stylesheet" type="text/css" />
   <link href="<?=BASE_URL?>assets/frontend/css/menu.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript" src="<?=BASE_URL?>vendor/jquery.js"></script>
   <script type="text/javascript" src="<?=BASE_URL?>assets/frontend/js/menu.js"></script>
   <title>Tin tức online</title></head>
<body>
<div id="container">
<div id="header">
	<img src="<?=BASE_URL?>assets/frontend/img/template/banner1.jpg" width="990" height="180">
	<div id="sitetitle">TIN TỨC TRỰC TUYẾN</div>
</div>
<div id="menungang">
<div id="menu">
    <ul class="menu">
    <?php
		
		foreach($this->cacloai as $row){
			
	?>
        <li><a href="<?php echo BASE_URL.$row['Alias'].'.html';?>" class="parent"><span><?php echo $row['TenLoai'];?></span></a>
        	
            <div><ul>
            <?php
			$dk_loaitin = array(
				'select' => "idloai, TenLoai,Alias",
				'where' => array('lang' => 'vi', 'AnHien' => '1', 'idCha' => $row['idloai']),
				'order_by' => 'ThuTu',
			);
				$loaitin = $this->model_phanloaibai->get_rows($dk_loaitin);
				
				if(count($loaitin) >0) {
				foreach($loaitin as $lt) {
			?>
                <li><a href="<?php echo BASE_URL.$lt['Alias'].'.html';?>" class="parent"><span><?php echo $lt['TenLoai'];?></span></a></li>
            <?php
				}
				}
			?>
            </ul></div>
        </li>
     <?php
		}
	
	 ?>
    </ul>
</div>
<div id="copyright" style="display:none">Copyright &copy; 2016 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>
</div>

