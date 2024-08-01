<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oyun_sitesi";

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

session_start();

// Oturum kontrolü
if (!isset($_SESSION['username'])) {
    header("Location: ../admingirisyap.php"); // Giriş sayfasına yönlendir
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Kategoriyi silme
    $sql = "DELETE FROM kategoriler WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: kategoriler.php");
    } else {
        echo "Hata: " . $conn->error;
    }
}
?>