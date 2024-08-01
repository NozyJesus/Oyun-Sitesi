
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oyun_sitesi";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$kategori_adi = "Korku";

$stmt = $conn->prepare("SELECT * FROM oyunlar WHERE kategori_id = (SELECT id FROM kategoriler WHERE kategori_adi = ?)");
$stmt->bind_param("s", $kategori_adi);
$stmt->execute();
$result = $stmt->get_result();
$oyunlar = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $oyunlar[] = $row;
    }
}
$stmt->close();

$result = $conn->query("SELECT * FROM kategoriler");
$kategoriler = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $kategoriler[] = $row;
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
    <title>Korku</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
                                    <?php foreach ($kategoriler as $kategori) : ?>
                                        <li><a href="<?php echo strtolower(str_replace(" ", "_", $kategori["kategori_adi"])); ?>.php"><?php echo $kategori["kategori_adi"]; ?></a></li>
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
    <section class="normal-breadcrumb set-bg" data-setbg="../img/kategoriler/korku.png" alt="Korku" style="height:500px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Korku</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="row">
                            <?php foreach ($oyunlar as $oyun) : ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="../oyunlar/<?php echo strtolower(str_replace(" ", "_", $oyun["oyun_adi"])); ?>.php">
                                        <div class="product__item__pic set-bg" data-setbg="../img/yuklemeler/<?php echo strtolower(str_replace(" ", "_", $oyun["oyun_adi"])); ?>.png">
                                        </div>
                                        </a>
                                        <div class="product__item__text">
                                            <h5><a href="../oyunlar/<?php echo strtolower(str_replace(" ", "_", $oyun["oyun_adi"])); ?>.php"><?php echo $oyun["oyun_adi"]; ?></a></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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
    <script src="../js/player.js"></script>
    <script src="../js/jquery.nice-select.min.js"></script>
    <script src="../js/mixitup.min.js"></script>
    <script src="../js/jquery.slicknav.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>