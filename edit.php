<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$data_tabel = mysqli_query($koneksi, "SELECT * FROM tugas ORDER BY id DESC");

if(isset($_POST['update'])){
    $judul_tugas = $_POST['judul_tugas'];
    $status = $_POST['status'];
    $tanggal = $_POST['tanggal'];

    mysqli_query($koneksi, "UPDATE tugas SET judul_tugas='$judul_tugas', status='$status', tanggal='$tanggal' WHERE id='$id'");
    
    header("location:edit.php");
    exit;
}

$d_form = null;
if ($id != '') {
    $query_form = mysqli_query($koneksi, "SELECT * FROM tugas WHERE id='$id'");
    $d_form = mysqli_fetch_array($query_form);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
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
        <h1>Silahkan Edit Tugas</h1>
        
        <table>
            <tr>
                <th>No</th>
                <th>Judul Tugas</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
            <?php 
            $no = 1;
            while($row = mysqli_fetch_array($data_tabel)){ 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['judul_tugas']; ?></td>
                <td><?php echo statusBadge($row['status']); ?></td>
                <td><?php echo formatTanggal($row['tanggal']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <br><br>

        <?php if($d_form != null): ?>
            <h3>Form Edit Data</h3>
            <form method="post" action="edit.php?id=<?php echo $id; ?>">

                <input type="text" name="judul_tugas" value="<?php echo $d_form['judul_tugas']; ?>" required><br><br>

                <select name="status">
                    <option value="Belum" <?php echo ($d_form['status'] == 'Belum') ? 'selected' : ''; ?>>Belum</option>
                    <option value="Selesai" <?php echo ($d_form['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                </select><br><br>

                <input type="date" name="tanggal" value="<?php echo $d_form['tanggal']; ?>" required><br><br>
                <button type="submit" name="update">Update</button>

            </form>
        <?php else: ?>
        <?php endif; ?>
    </div>
    <footer>
        <p>&copy; Aplikasi Website To Do List
Dibuat oleh Ahmad Syaifulloh
Pemrograman Web 2026. All rights reserved.</p>
    </footer>
</body>
</html>