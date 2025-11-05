<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

$id_user = $_GET['id_user'];
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];

$q = mysqli_query($koneksi, "
    SELECT jenis, SUM(nominal) AS total 
    FROM transaksi 
    WHERE id_user='$id_user' 
    AND MONTH(tanggal)='$bulan' 
    AND YEAR(tanggal)='$tahun'
    GROUP BY jenis
");

$pemasukan = 0;
$pengeluaran = 0;

while ($row = mysqli_fetch_assoc($q)) {
    if ($row['jenis'] == 'pemasukan') $pemasukan = $row['total'];
    if ($row['jenis'] == 'pengeluaran') $pengeluaran = $row['total'];
}

$saldo = $pemasukan - $pengeluaran;

echo json_encode([
    "success" => true,
    "bulan" => $bulan,
    "tahun" => $tahun,
    "total_pemasukan" => $pemasukan,
    "total_pengeluaran" => $pengeluaran,
    "saldo" => $saldo
]);
?>
