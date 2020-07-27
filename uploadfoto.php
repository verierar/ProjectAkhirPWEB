<!DOCTYPE html>
<html>
<head>
<title>Tambah Foto</title>
<link rel='stylesheet' href='wk.css'>
</head>
<body>
  <style>
   .kotakz {
     width: 650px;
     height: 300px;
     border: 2px solid #444;
     background: #F0FFFF;
     margin: 25px auto;
  
     box-shadow : 0 11px 32px rgba(0, 0, 0, 0.44) ;
   }
   .warnagarissisiberbeda {
    width: 500px;
    margin: 25px auto;
   border-width: 10px;
   border-style: solid;
   border-top-color: red;
   border-right-color: DarkGoldenRod;
   border-bottom-color: blue;
   border-left-color: BlueViolet;}

   .bt_signup{
  margin-top: 10px;
  margin-bottom: 15px;
  width: 200px;
  height: 50px;
  background-color: #19B5FE;
  border: none;
  border-radius: 5px;
  color: #fff;
  font-size: 18px;
}
</style>
  <div class='header'>
        <div class='logo'>
            <h1>WEBSITEKU</h1>
        </div>

        <div class='navbar'>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="uploadfoto.php">Tambah Foto</a></li>
</ul>

            </ul>
        </div>
    </div>
<?php
	include "koneksidatabase.php";
	$namafolder="imgpost/"; 
	if (isset($_POST['kirim'])) {
	for($i=0; $i<count($_FILES['nama_file']); $i++) 
	{
		if (!empty($_FILES["nama_file"]["tmp_name"][$i]))
		{
			$tgl=date("His");
			$jenis_gambar=$_FILES['nama_file']['type'][$i];
			$ket_gambar=$_POST['ket'][$i];
			
			if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
			{           
				$gambar = $namafolder.$tgl.basename($_FILES['nama_file']['name'][$i]);
				$nama_gbr= $tgl.basename($_FILES['nama_file']['name'][$i]);      
				if (move_uploaded_file($_FILES['nama_file']['tmp_name'][$i], $gambar)) {
					echo "<td><img src=\"$namafolder$nama_gbr\" width=\"100\" alt=\"$ket_gambar\" /><br />";
					echo "".$ket_gambar."<br /></td>";
					mysqli_query($conn,"insert into gambar(ida,namaf,ketf,tgl) values('$jenis_gambar','$nama_gbr','$ket_gambar',now())") or die(mysqli_error());
					
					} 
		   } 
		   else 
		   {
				echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png<br />";
		   }
	   }
	}
	echo "<td><a href=\"index.php\" >Berhasil ditambahkan , Kembali ke Home</a></td>";
	}
?>
		<div class="kotakz">
	</table>
<form action="" method="post" enctype="multipart/form-data">
 <h3 align="center" class="warnagarissisiberbeda"><marquee>Upload Foto</marquee></h3>
  <div align="center"><ul>
    Format gambar jpg/gif/png 
  </ul></div>
  <table width="600"  border="0" align="center">
    <tr><td>&nbsp;</td>
      <?php
$query = "SELECT ida, nma FROM album ORDER BY nma";
$sql = mysqli_query ($conn,$query);
?>
    </select></td></tr>
	<tr>
      <td width="48%"><div align="center"><strong>Browse Gambar</strong></div></td>
      <td width="44%"><div align="center"><strong>Deskripsi </strong></div></td>
    </tr>
    <tr>
      <td><input name="nama_file[]" type="file"/>&nbsp;</td>
      <td><textarea name="ket[]"></textarea></td>
    </tr>
  </table>
  <p align="center">
    <input name="kirim" type="submit" class="bt_signup" id="btnKirim" value="Upload" />
  
</form>
</div>
<div class='footer'>
    <p>Veriera Riski</p>
</div>
</body>
</html>