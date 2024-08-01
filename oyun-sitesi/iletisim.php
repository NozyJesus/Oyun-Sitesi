<?php
session_start();
require_once 'db.php'; // Veritabanı bağlantısı

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $adsoyad = $_POST['adsoyad'];
    $eposta = $_POST['eposta'];
    $mesaj = $_POST['mesaj'];

    // Veritabanına veri eklemek için SQL sorgusu
    $sql = "INSERT INTO destek_kaydi (adsoyad, eposta, mesaj) VALUES (?, ?, ?)";

    // SQL sorgusunu hazırla
    $stmt = $conn->prepare($sql);

    // Değişkenleri bağla (bind) ve sorguyu çalıştır
    $stmt->bind_param("sss", $adsoyad, $eposta, $mesaj);

    if ($stmt->execute()) {
        // Başarıyla eklendiğinde kullanıcıyı yönlendir veya mesaj göster
        echo "<script>alert('Mesajınız başarıyla gönderildi. Teşekkür ederiz!');</script>";
    } else {
        // Hata durumunda hata mesajını göster
        echo "<script>alert('Mesajınız gönderilirken bir hata oluştu. Lütfen tekrar deneyin.');</script>";
    }

    // İşlem tamamlandıktan sonra bağlantıyı kapat
    $stmt->close();
}

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Kategorileri çekme
$sql = "SELECT kategori_adi FROM kategoriler";
$result = $conn->query($sql);

$kategoriler = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $kategoriler[] = $row['kategori_adi'];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>İletişim</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
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
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li><a href="index.php">Anasayfa</a></li>
                                <li><a href="kategoriler.php">Kategoriler<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <?php foreach ($kategoriler as $kategori) : ?>
                                            <li><a href="kategoriler/<?php echo strtolower(str_replace(' ', '_', $kategori)); ?>.php"><?php echo $kategori; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li><a href="hakkimizda.php">Hakkımızda</a></li>
                                <li class="active"><a href="iletisim.php">İletişim</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>İletişim</h2>
                    <p>Bizimle buradan iletişime geçebilirsiniz.</p>
                </div>
            </div>
        </div>
    </div>
    </section>
    <section class="login spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <div class="blog__details__title">
                    <div class="blog__details__social">
                        <a href="https://www.facebook.com/melek.aksu.92505/" class="facebook" target="_blank"><i class="fa fa-facebook-square"></i> Facebook</a>
                        <a href="https://www.instagram.com/melkaksy_/" class="instagram" target="_blank"><i class="fa fa-instagram"></i> Instagram</a>
                        <a href="#" class="whatsapp"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                    </div>
                    </div>
                    <div class="login__form">
                    <form action="iletisim.php" method="post">
                        <div class="input__item">
                            <input type="text" placeholder="Ad Soyad" name="adsoyad" id="adsoyad" required>
                            <span class="icon_profile"></span>
                        </div>
                        <div class="input__item">
                            <input type="email" placeholder="E-Mail" name="eposta" id="eposta" required>
                            <span class="icon_mail"></span>
                        </div>
                        <div class="input__item">
                            <textarea name="mesaj" id="mesaj" style="height: 100px;width: 100%;font-size: 15px;padding-left: 20%;padding-top: 5%;color: #b9b9b9;" required>Mesaj yaz...
                            </textarea>
                            <span class="icon_pencil"></span>
                        </div>
                        <button type="submit" class="site-btn">Gönder</button>
                    </form>
                </div>
            </div>
        </div>  
    </div>
    </section>
    <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer__logo">
                        <a href="index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer__nav">
                        <ul>
                            <li class="active"><a href="index.php">Anasayfa</a></li>
                            <li><a href="kategoriler.php">Kategoriler</a></li>
                            <li><a href="hakkimizda.php">Hakkımızda</a></li>
                            <li><a href="iletisim.php">İletişim</a></li>
                            <li><a href="admingirisyap.php">Admin Giriş</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Arama Yap.....">
            </form>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/player.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>