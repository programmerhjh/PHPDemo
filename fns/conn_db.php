<?php 
	include('./config.php');
	function db_connect(){
		$conn =  mysqli_connect(HOST,USER,PASSWORD,DB);
		mysqli_set_charset($conn,CHARSET);
		mysqli_query($conn,"set character set 'utf8'");//读库
		mysqli_query($conn,"set names 'utf8'");//写库	
		return $conn;
	}
 ?>

