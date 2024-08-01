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
    <title>Anasayfa</title>
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
                                <li class="active"><a href="index.php">Anasayfa</a></li>
                                <li><a href="kategoriler.php">Kategoriler<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <?php foreach ($kategoriler as $kategori) : ?>
                                            <li><a href="kategoriler/<?php echo strtolower(str_replace(' ', '_', $kategori)); ?>.php"><?php echo $kategori; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li><a href="hakkimizda.php">Hakkımızda</a></li>
                                <li><a href="iletisim.php">İletişim</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                <div class="hero__items set-bg" data-setbg="img/anasayfa-1.jpg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <h2>Çok Oyunculu</h2>
                                <p>&nbsp;</p>
                                <a href="kategoriler/Çok_oyunculu.php"><span>Daha Fazla</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="img/anasayfa-2.jpg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <h2>Nişancı</h2>
                                <p>&nbsp;</p>
                                <a href="kategoriler/nişancı.php"><span>Daha Fazla</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero__items set-bg" data-setbg="img/anasayfa-3.jpg">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <h2>Ücretsiz Popüler</h2>
                                <p>&nbsp;</p>
                                <a href="kategoriler/Ücretsiz_popüler.php"><span>Daha Fazla</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Oyunlar</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="kategoriler.php" class="primary-btn">Tümünü Göster <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/yuklemeler/valorant.png">
                                        <div class="ep">1 / 6</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>Oyun</li>
                                        </ul>
                                        <h5><a href="oyunlar/valorant.php">VALORANT</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/yuklemeler/dead_by_daylight.png">
                                        <div class="ep">2 / 6</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>Oyun</li>
                                        </ul>
                                        <h5><a href="oyunlar/dead_by_daylight.php">Dead By Daylight</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/yuklemeler/no_straight_road.png">
                                        <div class="ep">3 / 6</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>Oyun</li>
                                        </ul>
                                        <h5><a href="oyunlar/no_straight_road.php">No Straight Road</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/yuklemeler/rocket_league.png">
                                        <div class="ep">4 / 6</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>Oyun</li>
                                        </ul>
                                        <h5><a href="oyunlar/rocket_league.php">Rocket League</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/yuklemeler/eve_online.png">
                                        <div class="ep">5 / 6</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>Oyun</li>
                                        </ul>
                                        <h5><a href="oyunlar/eve_online.php">Eve Online</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/yuklemeler/sift_heads_cartels.png">
                                        <div class="ep">6 / 6</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>Oyun</li>
                                        </ul>
                                        <h5><a href="oyunlar/sift_heads_cartels.php">Sift Heads Cartels</a></h5>
                                    </div>
                                </div>
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