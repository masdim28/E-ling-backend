<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

$id_user = $_GET['id_user'];

$query = "SELECT * FROM profil WHERE id_user = '$id_user'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    echo json_encode(["success" => true, "data" => $data]);
} else {
    echo json_encode(["success" => false, "message" => "Profil tidak ditemukan"]);
}
?>
