<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

$data = json_decode(file_get_contents("php://input"), true);

$id_user = $data['id_user'];
$jenis = $data['jenis']; // 'pemasukan' atau 'pengeluaran'
$kategori = $data['kategori'];
$nominal = $data['nominal'];
$keterangan = $data['keterangan'];
$tanggal = $data['tanggal'];

$query = "INSERT INTO transaksi (id_user, jenis, kategori, nominal, keterangan, tanggal) 
          VALUES ('$id_user', '$jenis', '$kategori', '$nominal', '$keterangan', '$tanggal')";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(["success" => true, "message" => "Transaksi berhasil ditambahkan"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal menambahkan transaksi"]);
}
?>
