<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

$id_user = $_GET['id_user'];
$tahun = $_GET['tahun'];

$q = mysqli_query($koneksi, "
    SELECT MONTH(tanggal) AS bulan, jenis, SUM(nominal) AS total 
    FROM transaksi 
    WHERE id_user='$id_user' AND YEAR(tanggal)='$tahun'
    GROUP BY MONTH(tanggal), jenis
");

$data = [];

for ($i = 1; $i <= 12; $i++) {
    $data[$i] = [
        "bulan" => $i,
        "total_pemasukan" => 0,
        "total_pengeluaran" => 0
    ];
}

while ($row = mysqli_fetch_assoc($q)) {
    if ($row['jenis'] == 'pemasukan') {
        $data[$row['bulan']]['total_pemasukan'] = $row['total'];
    } else {
        $data[$row['bulan']]['total_pengeluaran'] = $row['total'];
    }
}

echo json_encode([
    "success" => true,
    "tahun" => $tahun,
    "laporan" => array_values($data)
]);
?>
