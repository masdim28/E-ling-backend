<?php
header('Content-Type: application/json');
include_once("../config/koneksi.php");

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    echo json_encode([
        "success" => true,
        "message" => "Login berhasil",
        "data" => [
            "id_user" => $user['id_user'],
            "username" => $user['username'],
            "email" => $user['email']
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Username atau password salah"]);
}
?>
