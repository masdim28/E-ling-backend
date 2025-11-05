<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

$id_user = $_GET['id_user'];

$q_pemasukan = mysqli_query($koneksi, "SELECT SUM(nominal) AS total_pemasukan FROM transaksi WHERE id_user='$id_user' AND jenis='pemasukan'");
$q_pengeluaran = mysqli_query($koneksi, "SELECT SUM(nominal) AS total_pengeluaran FROM transaksi WHERE id_user='$id_user' AND jenis='pengeluaran'");

$pemasukan = mysqli_fetch_assoc($q_pemasukan)['total_pemasukan'] ?? 0;
$pengeluaran = mysqli_fetch_assoc($q_pengeluaran)['total_pengeluaran'] ?? 0;
$saldo = $pemasukan - $pengeluaran;

echo json_encode([
    "success" => true,
    "saldo_sekarang" => $saldo,
    "total_pemasukan" => $pemasukan,
    "total_pengeluaran" => $pengeluaran
]);
?>
