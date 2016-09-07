<div id="baimoi">
<?php foreach($this->cacloai as $lt){?>
<div class="rows"> <h4><a href="#"><?=$lt['TenLoai']?></a></h4>

<?php
$idloai = $lt['idloai'];
	$dk = array(
		'select' => 'idloai',
		'where' => array('idloai' => $idloai),
		'where_or' =>array('idCha' => $idloai),
	);
	$dk_where_in = $this->model_phanloaibai->get_rows($dk);
		
	$dk_baimoi = array(
			'select' => "idbv,TieuDe, TomTat, urlHinh, Ngay, SoLanXem",
			'where_in' => array('idLoai'=> $dk_where_in),
			'order_by' => 'idbv',
			'limit' => '0 ,4'
	);
	$bm = $this->model_baiviet->get_rows($dk_baimoi);
	//print_r($bm);
	$bai=$bm[0];
?>
	<div class="tindau"> 
       <img src="<?=BASE_URL?>assets/frontend/img/<?=$bai['urlHinh'];?>" align=left />
       <div class="tieude"><a href="<?=BASE_URL.'baiviet/detail/'.$bai['idbv'];?>"><?=$bai['TieuDe'];?></a></div>
       <div class="tomtat"><?=$bai['TomTat'];?></div>
    </div>
    <div class="tintieptheo">
       <?php for($j =1; $j<count($bm); $j++) {$bai = $bm[$j]; ?>	
        <p class="tieude"> <a href="<?=BASE_URL.'baiviet/detail/'.$bai['idbv'];?>"><?=$bai['TieuDe']?> </a></p>
       <?php }	//for $j?>
    </div>

</div>
<?php }?>
</div>
