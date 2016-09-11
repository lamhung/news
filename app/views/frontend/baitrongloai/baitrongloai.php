<div id="baitrongloai">
<?php foreach($listbai as $row ){ 

?>
<div class="motbai">
<img src="<?=BASE_URL?>assets/frontend/img/<?=$row['urlHinh']?>" align="left">
<h4><a href="<?=BASE_URL.$alias.'/'.$row['Alias'].'.html';?>"><?=$row['TieuDe']?></a></h4>
<div class="xem">
  Xem: <?=$row['SoLanXem']?> . 
  Ngày đăng: <?=date('d/m/Y',strtotime($row['Ngay']))?>
</div>
<p class="tomtat"><?=$row['TomTat']?></p>
</div>
<?php } ?>
</div>
<div>
<?php echo $this->pagination->pageslist();?>
	
</div>

