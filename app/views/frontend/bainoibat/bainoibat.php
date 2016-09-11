<?php
	
?>

<div id="bainoibat">
  <div id="top1"> 
	<?php
	 	$row=$bainb[0];
	 	$dk_alias = array(
			'select' => 'Alias',
			'where' => array('idloai' => $row['idLoai']),
		);
		$alias_loai = $this->model_phanloaibai->get_by($dk_alias);
	 ?>
	<img src="<?=BASE_URL?>assets/frontend/img/<?=$row['urlHinh']?>" align="left">
      <div class="tieude"> <a href="<?=BASE_URL.$alias_loai['Alias'].'/'.$row['Alias'].'.html';?>"><?=$row['TieuDe'];?></a> </div>
	<div class="tomtat"><?=$row['TomTat'];?></div>
  </div>
  <div id="top3">
  <?php for($i=1;$i<count($bainb);$i++){ $row = $bainb[$i];
  		$dk_alias = array(
			'select' => 'Alias',
			'where' => array('idloai' => $row['idLoai']),
		);
		$alias_loai = $this->model_phanloaibai->get_by($dk_alias);
  ?>

	<div>
	<img src="<?=BASE_URL?>assets/frontend/img/<?=$row['urlHinh']?>" > <br/>
	<a href="<?=BASE_URL.$alias_loai['Alias'].'/'.$row['Alias'].'.html';?>"><?=$row['TieuDe']?></a>		
	</div>	
  <?php } //for $i?>
  </div>
</div>
