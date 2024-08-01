<?php
session_start();
require_once 'db.php'; // Veritabanı bağlantısı

// Giriş formu gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre'];

    // Kullanıcı doğrulaması
    $query = "SELECT * FROM kullanicilar WHERE kullanici_adi=? AND sifre=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $kullanici_adi, $sifre);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        // Kullanıcı bulundu, oturum başlat
        $_SESSION['loggedin'] = true;
        $_SESSION['kullanici_adi'] = $kullanici_adi;
        header('Location: admin/index.php');
        exit;
    } else {
        $error = "Kullanıcı adı veya şifre yanlış.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css?family=Montserrat:300,300i,400,400i,500,600,700,800%7CPoppins:600">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
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
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-custom" style="padding-left: 10%;">
    <a class="navbar-brand" href="index.php">← Anasayfa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
</header>
<div class="container mt-5">
        <h3 class="mb-4">Giriş Yap</h3>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="kullanici_adi">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" class="form-control" id="sifre" name="sifre" required>
            </div><br>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
