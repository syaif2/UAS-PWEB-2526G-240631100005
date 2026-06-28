<?php
include 'koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tugas ORDER BY id DESC");

if(isset($_POST['simpan'])){

    $judul_tugas = $_POST['judul_tugas'];
    $status = $_POST['status'];
    $tanggal = $_POST['tanggal'];

    mysqli_query($koneksi,
    "INSERT INTO tugas (judul_tugas, status, tanggal)
    VALUES ('$judul_tugas', '$status', '$tanggal')");

    header("location:daftar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
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
    <h1>Silahkan Tambah Data</h1>
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
    <form method="POST">
        <label for="judul_tugas">Judul Tugas:</label>
        <input type="text" name="judul_tugas" id="judul_tugas" required>

        <select name="status">
        <option value="Belum">Belum</option>
        <option value="Selesai">Selesai</option>
        </select>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" required>

        <button type="submit" name="simpan">Simpan</button>
    </form>
    </div>

<footer>
        <p>&copy; Aplikasi Website To Do List
Dibuat oleh Ahmad Syaifulloh
Pemrograman Web 2026. All rights reserved.</p>
    </footer>
</body>
</html>