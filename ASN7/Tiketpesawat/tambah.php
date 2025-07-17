<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Proses form
if ($_POST) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_pemesan']);
    $dari = mysqli_real_escape_string($conn, $_POST['dari']);
    $ke = mysqli_real_escape_string($conn, $_POST['ke']);
    $tanggal = $_POST['tanggal_berangkat'];
    $jumlah = intval($_POST['jumlah_tiket']);
    $id_maskapai = intval($_POST['maskapai']);

    // Ambil nama & harga maskapai dari DB
    $query = mysqli_query($conn, "SELECT nama, harga FROM maskapai WHERE id = $id_maskapai");
    $m = mysqli_fetch_assoc($query);
    $maskapai = $m['nama'];
    $harga = $m['harga'];

    $sql = "INSERT INTO tiket_pesawat 
            (nama_pemesan, dari, ke, tanggal_berangkat, jumlah_tiket, maskapai, harga)
            VALUES ('$nama', '$dari', '$ke', '$tanggal', $jumlah, '$maskapai', $harga)";
    mysqli_query($conn, $sql);
    header("Location: daftar.php");
    exit;
}

// Ambil semua maskapai dari DB
$maskapaiList = mysqli_query($conn, "SELECT * FROM maskapai");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pemesanan Tiket</title>
    <style>
        <?php include 'style.css'; ?>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('Image/Pesawat2.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .form-group label {
            color: black;
        }

        .harga {
            margin-top: 10px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Pemesanan Tiket</h2>
    <form id="formTiket" action="tambah.php" method="post" onsubmit="return confirmBooking()">
        <div class="form-group">
            <label>Nama Pemesan</label>
            <input type="text" name="nama_pemesan" required>
        </div>
        <div class="form-group">
            <label>Dari</label>
            <input type="text" name="dari" required>
        </div>
        <div class="form-group">
            <label>Ke</label>
            <input type="text" name="ke" required>
        </div>
        <div class="form-group">
            <label>Tanggal Berangkat</label>
            <input type="date" name="tanggal_berangkat" required>
        </div>
        <div class="form-group">
            <label>Jumlah Tiket</label>
            <input type="number" name="jumlah_tiket" id="jumlah_tiket" required min="1">
        </div>
        <div class="form-group">
            <label>Maskapai</label>
            <select name="maskapai" id="maskapai" onchange="tampilkanHarga()" required>
                <option value="">-- Pilih Maskapai --</option>
                <?php while ($row = mysqli_fetch_assoc($maskapaiList)): ?>
                    <option value="<?= $row['id'] ?>" data-harga="<?= $row['harga'] ?>">
                        <?= $row['nama'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="harga" id="hargaMaskapai"></div>

        <button type="submit" class="btn btn-add">Simpan</button>
        <a href="index.php" class="btn btn-back">Kembali</a>
    </form>
</div>

<script>
function tampilkanHarga() {
    const select = document.getElementById("maskapai");
    const harga = select.options[select.selectedIndex].getAttribute("data-harga");
    const jumlah = parseInt(document.getElementById("jumlah_tiket").value) || 1;
    const total = harga * jumlah;
    const display = document.getElementById("hargaMaskapai");

    if (harga) {
        display.innerText = `Harga per tiket: Rp ${parseInt(harga).toLocaleString()} | Total: Rp ${total.toLocaleString()}`;
    } else {
        display.innerText = '';
    }
}

function confirmBooking() {
    const nama = document.querySelector('input[name="nama_pemesan"]').value;
    const dari = document.querySelector('input[name="dari"]').value;
    const ke = document.querySelector('input[name="ke"]').value;
    const tanggal = document.querySelector('input[name="tanggal_berangkat"]').value;
    const jumlah = document.querySelector('input[name="jumlah_tiket"]').value;
    const maskapai = document.querySelector('#maskapai option:checked').text;

    const pesan = `Konfirmasi pemesanan:\n\n` +
                  `Nama Pemesan: ${nama}\nDari: ${dari}\nKe: ${ke}\nTanggal: ${tanggal}\n` +
                  `Jumlah Tiket: ${jumlah}\nMaskapai: ${maskapai}`;
    return confirm(pesan);
}

document.getElementById("jumlah_tiket").addEventListener("input", tampilkanHarga);
</script>
</body>
</html>
