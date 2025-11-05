<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

$id_user = $_POST['id_user'];
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);

if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    $query = "UPDATE profil SET foto='$target_file' WHERE id_user='$id_user'";
    if (mysqli_query($koneksi, $query)) {
        echo json_encode(["success" => true, "message" => "Foto berhasil diupload"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database gagal diperbarui"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Gagal mengunggah foto"]);
}
?>
