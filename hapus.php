<?php
include 'koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($koneksi,"delete from tugas where id='$id'");
}

header("location:edit.php");
?>  

