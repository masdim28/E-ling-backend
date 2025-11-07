<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

// Pastikan id_user dikirim
if (!isset($_GET['id_user'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Parameter id_user wajib dikirim"
    ]);
    exit;
}

$id_user = intval($_GET['id_user']);

/*
    Logika:
    - Pemasukan -> tambah ke saldo (mengacu ke kolom tujuan_dana)
    - Pengeluaran -> kurangi saldo (mengacu ke kolom asal_dana)
*/

// Ambil semua transaksi user
$sql = "SELECT jenis, asal_dana, tujuan_dana, nominal 
        FROM transaksi 
        WHERE id_user = '$id_user'";

$result = $conn->query($sql);

// Inisialisasi saldo per sumber
$saldoBank = [
    "BJB" => 0, "Mandiri" => 0, "BRI" => 0,
    "BNI" => 0, "BSI" => 0, "BCA" => 0, "Lainnya" => 0
];

$saldoEwallet = [
    "GoPay" => 0, "Dana" => 0, "ShopeePay" => 0, "OVO" => 0, "Lainnya" => 0
];

$saldoCash = 0;

// Loop transaksi dan hitung saldo
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jenis = $row['jenis'];
        $asal = $row['asal_dana'];
        $tujuan = $row['tujuan_dana'];
        $nominal = floatval($row['nominal']);

        // Jika pemasukan, uang masuk ke tujuan_dana
        if ($jenis == 'pemasukan') {
            if (array_key_exists($tujuan, $saldoBank)) {
                $saldoBank[$tujuan] += $nominal;
            } elseif (array_key_exists($tujuan, $saldoEwallet)) {
                $saldoEwallet[$tujuan] += $nominal;
            } elseif ($tujuan == 'Cash') {
                $saldoCash += $nominal;
            }
        }

        // Jika pengeluaran, uang keluar dari asal_dana
        if ($jenis == 'pengeluaran') {
            if (array_key_exists($asal, $saldoBank)) {
                $saldoBank[$asal] -= $nominal;
            } elseif (array_key_exists($asal, $saldoEwallet)) {
                $saldoEwallet[$asal] -= $nominal;
            } elseif ($asal == 'Cash') {
                $saldoCash -= $nominal;
            }
        }
    }
}

// Hitung total per kategori
$totalBank = array_sum($saldoBank);
$totalEwallet = array_sum($saldoEwallet);
$totalCash = $saldoCash;

// Hitung total keseluruhan
$totalSemua = $totalBank + $totalEwallet + $totalCash;

// Kirim hasil
echo json_encode([
    "status" => "success",
    "total_semua" => $totalSemua,
    "rincian" => [
        "bank" => [
            "total" => $totalBank,
            "detail" => $saldoBank
        ],
        "ewallet" => [
            "total" => $totalEwallet,
            "detail" => $saldoEwallet
        ],
        "cash" => $saldoCash
    ]
]);
?>
