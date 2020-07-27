<?php
include "koneksidatabase.php";
if(isset($_GET['id']))
{
	$id = (int) $_GET['id'];
	$namafolder="imgpost/";
	$sql = "select * from gambar where idf='$id'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) > 0 )
	{
		$data = mysqli_fetch_array($result);
		@unlink($namafolder.$data['namaf']);
		mysqli_query($conn,"delete from gambar where idf='$id'");
	}
} 
header("Location: index.php");
?>