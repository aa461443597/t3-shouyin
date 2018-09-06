<?php
	error_reporting(0);
	$id=$_POST['id'];
	$ex_tracking_number=$_POST['ex_tracking_number'];
	$ex_status=$_POST['ex_status'];

	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");

 	$sql_update="update exchange_details set ex_tracking_number='".$ex_tracking_number."',ex_status='".$ex_status."' where id=".$id;

    mysql_query($sql_update,$con);
    echo "1";
	/*try {
		mysql_query($sql_update,$con);
		echo "1";
	} catch (Exception $e) {
		echo "0".$e->getMessage();
		exit();
	}*/
    //echo $sql_update;
	mysql_close($con);

?>