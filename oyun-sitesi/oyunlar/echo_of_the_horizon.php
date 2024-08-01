
<?php
session_start();
require_once "../db.php";

$oyun_id = 66;

if ($oyun_id <= 0) {
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
    $oyun = $result_oyun->fetch_assoc();
    $oyun_adi = htmlspecialchars($oyun["oyun_adi"]);
    $kategori_id = $oyun["kategori_id"];
    $aktif_oyuncu_sayisi = htmlspecialchars($oyun["aktif_oyuncu_sayisi"]);
    $aciklama = htmlspecialchars($oyun["aciklama"]);
    $yapimci = htmlspecialchars($oyun["yapimci"]);
    $yayinlanma_tarihi = htmlspecialchars($oyun["yayinlanma_tarihi"]);
    $rating = htmlspecialchars($oyun["rating"]);
    $gorsel = "../img/yuklemeler/" . strtolower(str_replace(" ", "_", $oyun_adi)) . ".png";
} else {
    echo "Oyun bulunamadı.";
    exit;
}

// Kategori adını çekme
$sql_kategori = "SELECT kategori_adi FROM kategoriler WHERE id = ?";
$stmt_kategori = $conn->prepare($sql_kategori);
$stmt_kategori->bind_param("i", $kategori_id);
$stmt_kategori->execute();
$result_kategori = $stmt_kategori->get_result();
if ($result_kategori->num_rows > 0) {
    $mevcut_kategori = htmlspecialchars($result_kategori->fetch_assoc()["kategori_adi"]);
} else {
    $mevcut_kategori = "Bilinmiyor";
}

// Kategorileri çekme
$sql_kategoriler = "SELECT kategori_adi FROM kategoriler";
$result_kategoriler = $conn->query($sql_kategoriler);
$kategoriler = array();
if ($result_kategoriler->num_rows > 0) {
    while ($row = $result_kategoriler->fetch_assoc()) {
        $kategoriler[] = htmlspecialchars($row["kategori_adi"]);
    }
}

// Yorumları çekme
$sql_yorum = "SELECT adsoyad, yorum, yorum_tarihi FROM yorumlar WHERE oyun_id = ? ORDER BY yorum_tarihi DESC";
$stmt_yorum = $conn->prepare($sql_yorum);
$stmt_yorum->bind_param("i", $oyun_id);
$stmt_yorum->execute();
$result_yorum = $stmt_yorum->get_result();

$yorumlar = array();
if ($result_yorum->num_rows > 0) {
    while ($row = $result_yorum->fetch_assoc()) {
        $yorumlar[] = [
            "adsoyad" => htmlspecialchars($row["adsoyad"]),
            "yorum" => htmlspecialchars($row["yorum"]),
            "yorum_tarihi" => htmlspecialchars($row["yorum_tarihi"])
        ];
    }
}

// Yorum ekleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adsoyad = $conn->real_escape_string($_POST["adsoyad"]);
    $yorum = $conn->real_escape_string($_POST["yorum"]);

    $sql_yorum_ekle = "INSERT INTO yorumlar (oyun_id, adsoyad, yorum, yorum_tarihi) VALUES (?, ?, ?, NOW())";
    $stmt_yorum_ekle = $conn->prepare($sql_yorum_ekle);
    $stmt_yorum_ekle->bind_param("iss", $oyun_id, $adsoyad, $yorum);

    if ($stmt_yorum_ekle->execute() === TRUE) {
        header("Location: " . $_SERVER["REQUEST_URI"]);
        exit;
    } else {
        echo "Yorum eklenirken hata oluştu: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $oyun_adi; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="../index.php">
                            <img src="../img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li><a href="../index.php">Anasayfa</a></li>
                                <li><a href="../kategoriler.php">Kategoriler<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <?php foreach ($kategoriler as $kategori_nav) : ?>
                                            <li><a href="../kategoriler/<?php echo strtolower(str_replace(" ", "_", $kategori_nav)); ?>.php"><?php echo $kategori_nav; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li><a href="../hakkimizda.php">Hakkımızda</a></li>
                                <li><a href="../iletisim.php">İletişim</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="../index.php"><i class="fa fa-home"></i> Anasayfa</a>
                        <a href="../kategoriler.php">Kategoriler</a>
                        <a href="../kategoriler/<?php echo strtolower(str_replace(" ", "_", $mevcut_kategori)); ?>.php"><?php echo $mevcut_kategori; ?></a>
                        <span><?php echo $oyun_adi; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="<?php echo $gorsel; ?>">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3><?php echo $oyun_adi; ?></h3>
                            </div>
                            <p><?php echo $aciklama; ?></p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Kategori:</span> <?php echo $mevcut_kategori; ?></li>
                                            <li><span>Yapımcı:</span> <?php echo $yapimci; ?></li>
                                            <li><span>Aktif Oyuncu Sayısı:</span> <?php echo $aktif_oyuncu_sayisi; ?></li>
                                            <li><span>Rating: </span> <?php echo $rating; ?> / 10</li>
                                            <li><span>Yayınlanma Tarihi:</span> <?php echo $yayinlanma_tarihi; ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Yorumlar</h5>
                            </div>
                            <?php if (!empty($yorumlar)) : ?>
                                <?php foreach ($yorumlar as $yorum) : ?>
                                <div class="anime__review__item__pic">
                                    <img src="../img/user.png" alt="">
                                </div>
                                <div class="anime__review__item__text" style="margin-bottom: 30px;">
                                    <h6><?php echo $yorum["adsoyad"]; ?></h6>
                                    <span><?php echo date("d.m.Y", strtotime($yorum["yorum_tarihi"])); ?></span>
                                    <p><?php echo $yorum["yorum"]; ?></p>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php else : ?>
                            <p>Henüz yorum yapılmamış.</p>
                            <?php endif; ?>
                            <div class="anime__details__form">
                                <div class="section-title">
                                    <h5>Yorum Yap</h5>
                                </div>
                                <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="post">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <input type="text" name="adsoyad" placeholder="Ad Soyadınız..." required>
                                        </div>
                                    </div>
                                    <textarea name="yorum" placeholder="Yorumunuzu buraya yazınız..." required></textarea>
                                    <button type="submit" class="site-btn">Yorum Yap</button>
                                </form>
                            </div>
                        </div> 
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
                        <a href="../index.php"><img src="../img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer__nav">
                        <ul>
                            <li><a href="../index.php">Anasayfa</a></li>
                            <li><a href="../kategoriler.php">Kategoriler</a></li>
                            <li><a href="../hakkimizda.php">Hakkımızda</a></li>
                            <li><a href="../iletisim.php">İletişim</a></li>
                            <li><a href="../admingirisyap.php">Admin Giriş</a></li>
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
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.nice-select.min.js"></script>
    <script src="../js/jquery.nicescroll.min.js"></script>
    <script src="../js/jquery.barfiller.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/jquery.slicknav.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>