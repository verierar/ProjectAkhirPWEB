<!DOCTYPE html>
<html>
<head>
<title>Galeri Foto</title>
<link rel='stylesheet' href='wk.css'>
<style>
.marqueeart2 {width:450px;height:50;background-color:#F0FFFF;
filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0, startColorstr='#b8bfc4', endColorstr='#a19eab');
background-image:-webkit-linear-gradient(top, #b8bfc4 0%, #fcfcfc 50%, #a19eab 100%);
background-image:-moz-linear-gradient(top, #b8bfc4 0%, #fcfcfc 50%, #a19eab 100%);
background-image:-ms-linear-gradient(top, #b8bfc4 0%, #fcfcfc 50%, #a19eab 100%);
background-image:-o-linear-gradient(top, #b8bfc4 0%, #fcfcfc 50%, #a19eab 100%);
background-image:linear-gradient(top, #b8bfc4 0%, #fcfcfc 50%, #a19eab 100%);
}
 .kotakz {
     width: 700px;
     height: 90px;
     border: 2px solid #444;
     background:#ADFF2F;
     margin: 25px auto;
  
     box-shadow : 0 11px 32px rgba(0, 0, 0, 0.44) ;
   }
</style>
</head>
<body>
<?php include"koneksidatabase.php"; 
$tampil=mysqli_query($conn,"SELECT * from gambar order by idf desc");?>
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
    <center>
    	<div class="kotakz">
    	 <?php
$filecounter="counter.txt";
$fl=fopen($filecounter,"r+");

$hit=fread($fl,filesize($filecounter));

echo("<table widht=450 align=center border=1 cellspacing=0 cllpadding=0 bordercolor=#008000><tr>");
echo("<td widht=450 valign=middle align=center");
echo("<font face=verdana size=2 color=#008000><b>");
echo ("Anda pengunjung ke : ");
echo ($hit);
echo ("</b></font>");
echo ("</td>");
echo("</tr></table>");

fclose($fl);

$fl=fopen($filecounter,"w+");
$hit=$hit+1;

fwrite($fl,$hit,strlen($hit));

fclose($fl);
?>
<div class="marqueeart2"><marquee style="font-size:32px;color:#F0FFFF;text-shadow:2px 2px 4px #000;font-family:Times New Roman;padding-top:5px;">Galeri Foto (<?php $jumlah=mysqli_num_rows($tampil); echo"$jumlah";?> foto)</marquee></div>
</center>
<center>
<?php 
$dataPerPage = 12; 

if(isset($_GET['page']))
{
    $noPage = $_GET['page'];
}
else $noPage = 1;



$offset = ($noPage - 1) * $dataPerPage;



if (isset($_GET['alb']) && ($id_al=$_GET['alb']) && ($id_al !="")){
$hasil=mysqli_query($conn,"SELECT * FROM album WHERE ida='$id_al'") or die ('ERROR');
$data = mysqli_fetch_array ($hasil);
$nama_alb=$data['nma']; echo "<h2>Foto Album: $nama_alb</h2>";
$query="SELECT * FROM gambar WHERE ida=$id_al order by idf desc LIMIT $offset, $dataPerPage";
$que   = "SELECT COUNT(*) AS jumData FROM gambar WHERE idf=$id_al";}
else {$query="SELECT * FROM gambar order by idf desc LIMIT $offset, $dataPerPage";
$que   = "SELECT COUNT(*) AS jumData FROM gambar";
$id_al="";}
$result = mysqli_query($conn,$query) or die('Error');

?>
<table>
		<tr>
		<?php
$i = 1;
while ($row = mysqli_fetch_array ($result)) 
{?>
<td>
			<a href="imgpost/<?php echo $row['namaf'];?>">
			<img src="imgpost/<?php echo $row['namaf'];?>" alt="" width="200" height="200" border="0"/></a>
			<center><br/><?php echo $row['ketf'];?><br/>
			<a href="deletefoto.php?id=<?php echo $row['idf'];?>" onclick="return confirm('foto akan terhapus jika tekan OK');">Hapus Foto</a>
			</center>
</td>
		<?php
			if($i % 3 == 0){
				echo '</tr><tr>';
			}
			$i++;
		}
		?>
		</tr>
	</table>
	</center>
<?php 


$hasi  = mysqli_query($conn,$que);
$data     = mysqli_fetch_array($hasi);

$jumData = $data['jumData'];



$jumPage = ceil($jumData/$dataPerPage);



if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage-1)."&alb=".$id_al."'>&lt;&lt; Prev</a>";



for($page = 1; $page <= $jumPage; $page++)
{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
         {
 
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else echo " <a href='".$_SERVER['PHP_SELF']."?page=".$page."&alb=".$id_al."'>".$page."</a> ";
            $showPage = $page;
         }
}

if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage+1)."&alb=".$id_al."'>Next &gt;&gt;</a>";
?>
</div>

<div class='footer'>
    <p>Veriera Riski</p>
</div>

</body>
</html>