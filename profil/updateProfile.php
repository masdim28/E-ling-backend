<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

$data = json_decode(file_get_contents("php://input"), true);

$id_user = $data['id_user'];
$nama = $data['nama'];
$no_hp = $data['no_hp'];
$alamat = $data['alamat'];

$query = "UPDATE profil SET nama='$nama', no_hp='$no_hp', alamat='$alamat' WHERE id_user='$id_user'";

if (mysqli_query($koneksi, $query)) {
    echo json_encode(["success" => true, "message" => "Profil berhasil diperbarui"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal memperbarui profil"]);
}
?>
