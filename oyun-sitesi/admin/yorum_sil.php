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

// Yorum ID'si alınması
if (isset($_GET['id'])) {
    $yorum_id = intval($_GET['id']);

    // Yorum silme sorgusu
    $sql = "DELETE FROM yorumlar WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $yorum_id);

    if ($stmt->execute()) {
        // Başarıyla silindi
        header("Location: oyunyorumlari.php");
        exit();
    } else {
        echo "Yorum silme sırasında hata oluştu: " . $conn->error;
    }
} else {
    echo "Geçersiz yorum ID'si.";
}
?>
