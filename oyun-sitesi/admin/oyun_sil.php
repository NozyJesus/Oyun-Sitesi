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

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Seçili oyunu sil
    $sql = "DELETE FROM oyunlar WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $basari = "Oyun başarıyla silindi";
    } else {
        $hata = "Silme hatası: " . $conn->error;
    }
} else {
    echo "Geçersiz istek.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Oyun Sil">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oyun Sil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4">Oyun Sil</h3>
        <?php if (isset($basari)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $basari; ?>
            </div>
        <?php elseif (isset($hata)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $hata; ?>
            </div>
        <?php endif; ?>
        <a href="oyunlar.php" class="btn btn-primary">Geri</a>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>