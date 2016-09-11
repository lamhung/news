<div id="baixemnhieu">
<h4>Bài xem nhiều</h4>

<?php foreach ($baixn as $row) {
	$dk_alias = array(
		'select' => 'Alias',
		'where' => array('idloai' => $row['idLoai']),
	);
	$alias_loai = $this->model_phanloaibai->get_by($dk_alias);
?>	
<p> <a href="<?php echo BASE_URL.$alias_loai['Alias'].'/'.$row['Alias'].'.html';?>"> <?=$row['TieuDe'];?> </a> </p>
<?php } ?>
</div>
