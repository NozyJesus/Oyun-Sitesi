<?php
session_start();
require_once "../db.php";

// Oyun ID'sini al
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $oyun_id = $_GET['id'];
} else {
    echo "Geçersiz oyun IDsi.";
    exit;
}

// Oyun bilgilerini çekme
$sql_oyun = "SELECT * FROM oyunlar WHERE id = ?";
$stmt_oyun = $conn->prepare($sql_oyun);
$stmt_oyun->bind_param("i", $oyun_id);
$stmt_oyun->execute();
$result_oyun = $stmt_oyun->get_result();

if ($result_oyun->num_rows > 0) {
    $row = $result_oyun->fetch_assoc();
    $oyun_adi = $row['oyun_adi'];
    $aktif_oyuncu_sayisi = $row['aktif_oyuncu_sayisi'];
    $aciklama = $row['aciklama'];
    $yapimci = $row['yapimci'];
    $yayinlanma_tarihi = $row['yayinlanma_tarihi'];
    $rating = $row['rating'];
} else {
    echo "Oyun bulunamadı.";
    exit;
}

// Form gönderildiğinde güncelleme işlemleri
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oyun_adi = $conn->real_escape_string($_POST["oyun_adi"]);
    $aktif_oyuncu_sayisi = $conn->real_escape_string($_POST["aktif_oyuncu_sayisi"]);
    $aciklama = $conn->real_escape_string($_POST["aciklama"]);
    $yapimci = $conn->real_escape_string($_POST["yapimci"]);
    $yayinlanma_tarihi = $conn->real_escape_string($_POST["yayinlanma_tarihi"]);
    $rating = $conn->real_escape_string($_POST["rating"]);

    // Güncelleme sorgusu oluştur
    $sql_update = "UPDATE oyunlar SET 
        oyun_adi = ?,
        aktif_oyuncu_sayisi = ?,
        aciklama = ?,
        yapimci = ?,
        yayinlanma_tarihi = ?,
        rating = ?
        WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssssi", $oyun_adi, $aktif_oyuncu_sayisi, $aciklama, $yapimci, $yayinlanma_tarihi, $rating, $oyun_id);

    if ($stmt_update->execute()) {
        // Başarıyla güncellendiğinde yönlendirme veya mesaj ver
        header("Location: oyunlar.php");
        exit;
    } else {
        echo "Güncelleme sırasında hata oluştu: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Oyun Düzenleme Sayfası">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oyun Düzenle</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/plyr.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="index.php">
                            <img src="../img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li><a href="index.php">Admin Panel</a></li>
                                <li><a href="../index.php">Çıkış Yap</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <section class="normal-breadcrumb set-bg" data-setbg="../img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Oyun Düzenle</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container mt-5" style="color: white;">
        <?php if (!empty($hata)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $hata; ?>
            </div>
        <?php elseif (!empty($basari)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $basari; ?>
            </div>
        <?php endif; ?>
        <div class="oyun_form">
            <form action="" method="POST">
                <div class="oyun_item">
                    <label for="oyun_adi">Oyun Adı</label>
                    <input type="text" id="oyun_adi" name="oyun_adi" value="<?php echo htmlspecialchars($oyun_adi); ?>">
                </div>
                <div class="oyun_item">
                    <label for="aktif_oyuncu_sayisi">Aktif Oyuncu Sayısı</label>
                    <input type="text" id="aktif_oyuncu_sayisi" name="aktif_oyuncu_sayisi" value="<?php echo htmlspecialchars($aktif_oyuncu_sayisi); ?>">
                </div>
                <div class="oyun_item">
                    <label for="aciklama">Açıklama</label>
                    <textarea id="aciklama" name="aciklama"><?php echo htmlspecialchars($aciklama); ?></textarea>
                </div>
                <div class="oyun_item">
                    <label for="yapimci">Yapımcı</label>
                    <input type="text" id="yapimci" name="yapimci" value="<?php echo htmlspecialchars($yapimci); ?>">
                </div>
                <div class="oyun_item">
                    <label for="yayinlanma_tarihi">Yayınlanma Tarihi</label>
                    <input type="date" id="yayinlanma_tarihi" name="yayinlanma_tarihi" value="<?php echo htmlspecialchars($yayinlanma_tarihi); ?>">
                </div>
                <div class="oyun_item">
                    <label for="rating">Rating</label>
                    <input type="text" id="rating" name="rating" value="<?php echo htmlspecialchars($rating); ?>">
                </div>
                <button type="submit" class="site-btn">Güncelle</button>
            </form>
        </div>
    </div>
    <section style="height: 50px;"></section>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/player.js"></script>
    <script src="../js/jquery.nice-select.min.js"></script>
    <script src="../js/mixitup.min.js"></script>
    <script src="../js/jquery.slicknav.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>
