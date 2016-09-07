<div id="baixemnhieu">
<h4>Bài xem nhiều</h4>

<?php foreach ($baixn as $row) {?>
<p> <a href="<?php echo BASE_URL.'home/detail/'.$row['idbv'];?>"> <?=$row['TieuDe'];?> </a> </p>
<?php } ?>
</div>
