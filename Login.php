<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sumbangyuk");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        echo "Login berhasil!";
        // Redirect ke halaman utama
        // header("Location: index.html");
    } else {
        echo "Password salah!";
    }
} else {
    echo "Username tidak ditemukan!";
}

$stmt->close();
$conn->close();
?>