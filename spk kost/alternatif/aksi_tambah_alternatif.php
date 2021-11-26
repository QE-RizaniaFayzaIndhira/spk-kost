<?php
$nama =$_POST['nama'];
include "../koneksi.php";
$sql="insert into tbl_alternatif (nama) 
values ('$nama')";
$hasil=mysqli_query($koneksi,$sql);
//echo "$sql";
if ($hasil) {
 header("location:../index.php?halaman=data&pesan=tambah_sukses");
}else
{
 header("location:../index.php?halaman=data&pesan=tambah_gagal");
}
?>