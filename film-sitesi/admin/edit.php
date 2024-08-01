<?php
session_start();

// Oturum kontrolü - eğer kullanıcı oturumu başlatmışsa devam eder
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../girisyap.php');
    exit;
}

require_once '../db.php';

$id = $_GET['id'];
if (!$id) {
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM iletisim WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$message = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad_soyad = $_POST['ad_soyad'];
    $eposta = $_POST['eposta'];
    $mesaj = $_POST['mesaj'];

    $update_stmt = $conn->prepare("UPDATE iletisim SET ad_soyad=?, eposta=?, mesaj=? WHERE id=?");
    $update_stmt->bind_param("sssi", $ad_soyad, $eposta, $mesaj, $id);

    if ($update_stmt->execute()) {
        $basari = "Mesaj başarıyla güncellendi!";
    } else {
        $hata = "Mesaj güncellenirken bir hata oluştu.";
    }

    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mesaj Düzenle</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css?family=Montserrat:300,300i,400,400i,500,600,700,800%7CPoppins:600">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .navbar-custom {
            background-color: #343a40;
            padding: 0 10%; /* Sol ve sağ kenar boşlukları */
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
            font-size: 25px;
        }
        .navbar-custom .navbar-brand {
            padding-left: 10px; /* Sol kenar boşluğu */
        }
        .navbar-custom .navbar-nav {
            margin-left: auto; /* Sağda hizalama için */
        }
    </style>
</head>
<header>
<nav class="navbar navbar-expand-lg navbar-custom" style="padding-left: 10%;">
    <a class="navbar-brand" href="index.php">Admin Paneli</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Çıkış Yap</a>
            </li>
        </ul>
    </div>
</nav>
</header>
<body>
    <div class="container mt-5">
        <h3 class="mb-4">Mesaj Düzenle</h3>
        <?php if (isset($basari)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $basari; ?>
            </div>
        <?php elseif (isset($hata)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $hata; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="ad_soyad">Ad Soyad</label>
                <input type="text" class="form-control" id="ad_soyad" name="ad_soyad" value="<?php echo htmlspecialchars($message['ad_soyad']); ?>" required>
            </div>
            <div class="form-group">
                <label for="eposta">Eposta</label>
                <input type="email" class="form-control" id="eposta" name="eposta" value="<?php echo htmlspecialchars($message['eposta']); ?>" required>
            </div>
            <div class="form-group">
                <label for="mesaj">Mesaj</label>
                <textarea class="form-control" id="mesaj" name="mesaj" rows="5" required><?php echo htmlspecialchars($message['mesaj']); ?></textarea>
            </div><br>
            <button type="submit" class="btn btn-primary">Güncelle</button>
            <a href="index.php" class="btn btn-secondary">Geri Dön</a>
        </form>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
