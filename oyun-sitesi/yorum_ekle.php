<?php
session_start();
require_once '../db.php';

// Oturum kontrolü
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../girisyap.php');
    exit;
}

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oyun_id = $conn->real_escape_string($_POST['oyun_id']);
    $adsoyad = $conn->real_escape_string($_POST['adsoyad']);
    $yorum = $conn->real_escape_string($_POST['yorum']);
    $yorum_tarihi = date('Y-m-d H:i:s');

    $sql = "INSERT INTO yorumlar (oyun_id, adsoyad, yorum, yorum_tarihi)
            VALUES ('$oyun_id', '$adsoyad', '$yorum', '$yorum_tarihi')";

    if ($conn->query($sql) === TRUE) {
        echo "Yorum başarıyla eklendi";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    header("Location: ../oyunlar/" . strtolower(str_replace(' ', '_', $oyun_adi)) . ".php");
}

$conn->close();
?>
