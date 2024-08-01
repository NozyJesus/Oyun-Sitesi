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
$sql = "SELECT kategori_adi, gorsel FROM kategoriler";
$result = $conn->query($sql);

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
    <title>Kategoriler</title>
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
                                <li class="active"><a href="kategoriler.php">Kategoriler<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <?php foreach ($kategoriler as $kategori) : ?>
                                            <li><a href="kategoriler/<?php echo strtolower(str_replace(' ', '_', $kategori['kategori_adi'])); ?>.php"><?php echo $kategori['kategori_adi']; ?></a></li>
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
    <section class="normal-breadcrumb set-bg" data-setbg="img/kategori.jpg" style="height:500px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Kategoriler</h2>
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
                            <?php foreach ($kategoriler as $kategori) : ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="kategoriler/<?php echo strtolower(str_replace(' ', '_', $kategori['kategori_adi'])); ?>.php">
                                            <div class="product__item__pic set-bg" data-setbg="img/<?php echo $kategori['gorsel']; ?>" style="height:250px;"></div>
                                        </a>
                                        <div class="product__item__text">
                                            <h5><a href="kategoriler/<?php echo strtolower(str_replace(' ', '_', $kategori['kategori_adi'])); ?>.php"><?php echo $kategori['kategori_adi']; ?></a></h5>
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