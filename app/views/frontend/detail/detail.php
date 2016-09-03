<div id="baiviet_ct">
<h4  class="tieude"><a href="#"><?=$detail['TieuDe']?></a></h4>
<img src="<?=BASE_DIR?>assets/frontend/img/<?=$detail['urlHinh'];?>" align=left width=140 height=100>
<div class="xem">
Số lần xem: <?=$detail['SoLanXem']?>  . 
Ngày đăng: <?=date('d/m/Y',strtotime($detail['Ngay']))?>
</div>
<div class="tomtat"><?=$detail['TomTat']?></div> <hr>
<div id="content"><?=$detail['Content']?></div>
</div>
