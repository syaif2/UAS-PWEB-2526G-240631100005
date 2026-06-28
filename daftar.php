<?php
include 'koneksi.php';

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$data = mysqli_query($koneksi,
"SELECT * FROM tugas
WHERE judul_tugas LIKE '%$cari%'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB_UAS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <a href="index.php">Beranda</a>
                <a href="daftar.php">Daftar</a>
                <a href="tambah.php">Tambah</a>
                <a href="edit.php">Edit</a>
            </ul>
        </nav>
    </header>
    <div class="container">
    <main>
        <h1>Selamat datang di Pengumpulan Tugas!</h1>
<form method="GET">
    <input type="text"
    name="cari"
    placeholder="Cari Judul Tugas">
    <button type="submit">
    Cari
</button>
</form>
        <table>
            <tr>
                <th>No</th>
                <th>Judul Tugas</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
            <?php $no = 1;
            while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['judul_tugas']; ?></td>
                <td><?php echo statusBadge($d['status']); ?></td>
                <td><?php echo formatTanggal($d['tanggal']); ?></td>
            </tr>
            <?php } ?>
        </table>
        <p><b>Jangan lupa untuk mengumpulkan tugas tepat waktu!!!.</b></p>
    </main>
    </div>
    <footer>
        <p>&copy; Aplikasi Website To Do List
Dibuat oleh Ahmad Syaifulloh
Pemrograman Web 2026. All rights reserved.</p>
    </footer>
</body>
</html>