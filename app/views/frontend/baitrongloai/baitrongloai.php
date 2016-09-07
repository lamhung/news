<div id="baitrongloai">
<?php foreach($listbai as $row ){ ?>
<div class="motbai">
<img src="<?=BASE_URL?>assets/frontend/img/<?=$row['urlHinh']?>" align="left">
<h4><a href="<?=BASE_URL.'home/detail/'.$row['idbv'];?>"><?=$row['TieuDe']?></a></h4>
<div class="xem">
  Xem: <?=$row['SoLanXem']?> . 
  Ngày đăng: <?=date('d/m/Y',strtotime($row['Ngay']))?>
</div>
<p class="tomtat"><?=$row['TomTat']?></p>
</div>
<?php } ?>
</div>
<div id="thanhphantrang">
<?= $this->pagination->pageslist(BASE_URL."home/cat/$idloai", $totalrows, 3,5, $currentpage);?>
</div>

