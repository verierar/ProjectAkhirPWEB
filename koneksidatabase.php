<?php
$host = "localhost";
$user = "root";
$pwd = "";
$db = "foto";
$conn = @mysqli_connect($host,$user,$pwd) or die("Koneksi gagal : " . mysqli_error());
mysqli_select_db($conn,"foto");
?>