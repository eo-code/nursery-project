<?php 
include 'header.php';
?>

<?php
$a = mysql_query("select * from barang_laku");
?>
<style>
    .col-md-10{
        font-family: fantasy;
        font-size: 50px;
    }
            
</style>
<div class="col-md-10">
	<marquee bgcolor="coral">SELAMAT DATANG ADMIN</marquee> 
</div>
<!-- kalender -->
<div class="pull-right">
	<div id="kalender"></div>
</div>

<?php 
include 'footer.php';

?>