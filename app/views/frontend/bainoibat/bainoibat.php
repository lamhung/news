<div id="bainoibat">
  <div id="top1"> 
	<?php $row=$bainb[0]; ?>
	<img src="<?=BASE_URL?>assets/frontend/img/<?=$row['urlHinh']?>" align="left">
      <div class="tieude"> <a href="<?=BASE_URL.'baiviet/detail/'.$row['idbv'];?>"><?=$row['TieuDe'];?></a> </div>
	<div class="tomtat"><?=$row['TomTat'];?></div>
  </div>
  <div id="top3">
  <?php for($i=1;$i<count($bainb);$i++){ $row = $bainb[$i]; ?>
	<div>
	<img src="<?=BASE_URL?>assets/frontend/img/<?=$row['urlHinh']?>" > <br/>
	<a href="<?=BASE_URL.'baiviet/detail/'.$row['idbv'];?>"><?=$row['TieuDe']?></a>		
	</div>	
  <?php } //for $i?>
  </div>
</div>
