<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tiket_pesawat WHERE id=$id");
header("Location: index.php");
?>
