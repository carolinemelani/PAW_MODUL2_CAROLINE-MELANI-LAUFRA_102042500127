<?php
require 'koneksi.php';

// Ambil data mobil dulu supaya bisa ditampilkan di halaman konfirmasi
// (bagian ini sudah lengkap, sama seperti detail.php).
$id = (int) ($_GET['id'] ?? 0);
$hasil = mysqli_query($conn,
    "SELECT * FROM showroom_mobil WHERE id = $id");
$mobil = mysqli_fetch_assoc($hasil);
if (!$mobil) {
    exit('Mobil tidak ditemukan. Kembali ke daftar mobil.');
}

// =====================================================================
// TODO 1 - Hapus hanya saat tombol konfirmasi ditekan
// TODO 2 - Perintah SQL hapus
// =====================================================================
if (isset($_POST['hapus'])) {
    mysqli_query($conn, "DELETE FROM showroom_mobil WHERE id = $id");
    header('Location: index.php?pesan=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus mobil - ShowRoom EAD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body><main>
<p class="label">SHOWROOM EAD / KONFIRMASI</p>
<h1>Hapus mobil?</h1>

<!-- ===================================================================
     TODO 3 - Tampilkan mobil yang akan dihapus
     =================================================================== -->
<p><?= $mobil['nama_mobil'] ?>
   (<?= $mobil['kode_mobil'] ?>) akan dihapus.</p>
<p>Data yang sudah dihapus tidak bisa dikembalikan.</p>

<!-- ===================================================================
     TODO 4 - Method form
     TODO 5 - Tombol konfirmasi
     TODO 6 - Tombol batal
     =================================================================== -->
<form method="post">
    <button name="hapus" class="bahaya">Ya, hapus mobil</button>
    <a href="detail.php?id=<?= $id ?>">Batal</a>
</form>
</main></body>
</html>