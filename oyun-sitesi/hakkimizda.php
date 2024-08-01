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
    <title>Hakkımızda</title>
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
                                <li class="active"><a href="hakkimizda.php">Hakkımızda</a></li>
                                <li><a href="iletisim.php">İletişim</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10">
                    <div class="blog__details__pic">
                        <img src="img/hakkimizda.png" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">
                        <div class="blog__details__text">
                            <p align="justify">
                                Hoş geldiniz! Biz, GamePlanet tutkulu oyun severler ve teknoloji meraklılarından oluşan bir ekibiz. 
                                Amacımız, siz değerli kullanıcılarımıza en iyi online oyunları tanıtarak oyun dünyasında eğlenceli ve keyifli zaman geçirmenize yardımcı olmaktır.
                            </p>
                            <p align="justify">
                                GamePlanet olarak, her türden oyun severin ihtiyaçlarına cevap verebilecek zengin içerikler sunuyoruz. 
                                Sitemizde, ücretli ve ücretsiz oyunlar ile iki kişilik oynanabilecek oyunlar gibi çeşitli kategorilerde en iyi oyunları keşfedebilirsiniz. 
                                Her oyunu detaylı incelemeler, kullanıcı yorumları ve güncel bilgilerle tanıtıyoruz. 
                                Böylece oyun seçiminizde doğru kararlar verebilmeniz için ihtiyacınız olan tüm bilgileri sağlıyoruz.
                            </p>
                            <p align="justify">
                                Misyonumuz, oyun dünyasını keşfetmek isteyen herkese rehberlik etmek ve kaliteli oyun deneyimleri sunmaktır. 
                                En yeni ve en popüler oyunları sizlerle buluştururken, aynı zamanda nostaljik klasiklerden de kopmuyoruz. 
                                Oyun dünyasında herkesin bir yeri olduğuna inanıyor ve her türden oyuncuya hitap eden içerikler üretiyoruz.
                            </p>
                            <p align="justify">
                                Vizyonumuz, oyun severlerin ilk durağı olmak ve online oyun tanıtımında en güvenilir kaynaklardan biri haline gelmektir. 
                                Yenilikçi yaklaşımımız ve geniş oyun yelpazemiz ile oyun severlerin vazgeçilmez bir dostu olmayı hedefliyoruz.
                            </p>
                            <p align="justify">
                                Geniş Oyun Yelpazesi: Ücretli, ücretsiz, iki kişilik ve daha birçok kategoride geniş oyun seçenekleri.
                            </p>
                            <p align="justify">
                                Detaylı İncelemeler: Her oyun için kapsamlı incelemeler ve güncel bilgiler.<br>
                                Kullanıcı Yorumları: Diğer oyuncuların deneyimlerini paylaşabileceği bir platform.<br>
                                Güncel İçerik: Oyun dünyasındaki en son gelişmeleri ve trendleri takip edin.<br>
                                Oyun dünyasına adım atarken doğru rehberle ilerlemek isteyen tüm oyun severleri sitemize davet ediyoruz.<br>
                                GamePlanet olarak, oyun keyfinizi en üst seviyeye çıkarmak için buradayız!
                            </p>
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