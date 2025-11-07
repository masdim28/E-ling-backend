<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

$data = json_decode(file_get_contents("php://input"), true);

$id_user = $data['id_user'];
$jenis = $data['jenis']; // pemasukan / pengeluaran / transfer
$kategori = $data['kategori'];
$nominal = $data['nominal'];
$keterangan = $data['keterangan'];
$tanggal = $data['tanggal'];
$asal_dana = $data['asal_dana']; // misal: BCA, OVO, Cash
$tujuan_dana = $data['tujuan_dana']; // misal: BCA, OVO, Cash

if (!$id_user || !$jenis || !$kategori || !$nominal || !$tanggal) {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
    exit;
}

$sql = "INSERT INTO transaksi (id_user, jenis, kategori, nominal, keterangan, tanggal, asal_dana, tujuan_dana)
        VALUES ('$id_user', '$jenis', '$kategori', '$nominal', '$keterangan', '$tanggal', '$asal_dana', '$tujuan_dana')";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Transaksi berhasil ditambahkan"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menambah transaksi"]);
}
?>
