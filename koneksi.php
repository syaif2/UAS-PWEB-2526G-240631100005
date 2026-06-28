<?php
$koneksi = mysqli_connect("localhost","root","","todo_list");

if(!$koneksi){
    die("Koneksi gagal : " . mysqli_connect_error());
}

function formatTanggal($tanggal){
    return date("d-m-Y", strtotime($tanggal));
}

function statusBadge($status){
    return ucfirst($status);
}