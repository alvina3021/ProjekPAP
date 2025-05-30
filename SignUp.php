<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "sumbangyuk");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
$email = $_POST['email'];

// Simpan ke database
$sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $password, $email);

if ($stmt->execute()) {
    echo "Registrasi berhasil!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>