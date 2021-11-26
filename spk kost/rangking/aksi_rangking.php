<?php
include "../koneksi.php";
$sql="select min(c1) as min_c1, max(c2) as max_c2, max(c3) as max_c3 from tbl_nilai";
$hasil=mysqli_query($koneksi,$sql);
$row=mysqli_fetch_array($hasil);
$min_c1=$row['min_c1'];
$max_c2=$row['max_c2'];
$max_c3=$row['max_c3'];

$sql=" select * from tbl_bobot";
$hasil=mysqli_query($koneksi,$sql);
$row=mysqli_fetch_array($hasil);
$w1=$row['w1'];
$w2=$row['w2'];
$w3=$row['w3'];

$sql="select * from tbl_nilai";
$hasil=mysqli_query($koneksi,$sql);
$i=0;
while ($row=mysqli_fetch_array($hasil)) {
 $id_nilai[$i]=$row['id_nilai'];
 $c1_normalisasi=round(($min_c1/$row['c1']),2);
 $c2_normalisasi=round(($row['c2']/$max_c2),2);
 $c3_normalisasi=round(($row['c3']/$max_c3),2);

 $skor[$i]=round((($w1*$c1_normalisasi)+($w2*$c2_normalisasi)+($w3*$c3_normalisasi)),3);
 $i++;
}

$x=0;

foreach ($skor as $key => $value) {
 $sql="update tbl_nilai set skor='$value' where id_nilai='$id_nilai[$x]'";
 mysqli_query($koneksi,$sql);
 $x++;
 echo "$sql";
 echo "<br>";
}
header("location:../index.php?halaman=rangking");
?>