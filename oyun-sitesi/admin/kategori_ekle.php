<?php
session_start();

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

// Oturum kontrolü
if (!isset($_SESSION['username'])) {
    header("Location: ../admingirisyap.php"); // Giriş sayfasına yönlendir
    exit();
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori_adi = trim($_POST['kategori_adi']);
    
    // Dosya yükleme işlemi
    $target_dir = "../img/kategoriler/";
    $target_file = $target_dir . basename($_FILES["gorsel"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Görselin gerçek bir görsel olup olmadığını kontrol et
    $check = getimagesize($_FILES["gorsel"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Dosya bir görsel değil.";
        $uploadOk = 0;
    }

    // Dosyanın zaten var olup olmadığını kontrol et
    if (file_exists($target_file)) {
        echo "Üzgünüz, dosya zaten mevcut.";
        $uploadOk = 0;
    }

    // Dosya boyutunu kontrol et (5MB ile sınırlayabilirsiniz)
    if ($_FILES["gorsel"]["size"] > 5000000) {
        echo "Üzgünüz, dosya çok büyük.";
        $uploadOk = 0;
    }

    // Yalnızca belirli dosya formatlarına izin ver
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Üzgünüz, sadece JPG, JPEG, PNG ve GIF dosya formatlarına izin veriliyor.";
        $uploadOk = 0;
    }

    // Hata olup olmadığını kontrol et
    if ($uploadOk == 0) {
        echo "Üzgünüz, dosyanız yüklenemedi.";
    } else {
        if (move_uploaded_file($_FILES["gorsel"]["tmp_name"], $target_file)) {
            // Kategori adını kontrol etme
            if (!empty($kategori_adi)) {
                // Kategori adını ve görsel yolunu veritabanına ekleme
                $stmt = $conn->prepare("INSERT INTO kategoriler (kategori_adi, gorsel) VALUES (?, ?)");
                $stmt->bind_param("ss", $kategori_adi, $target_file);

                if ($stmt->execute()) {
                    echo "Kategori ve görsel başarıyla eklendi.";

                    // Yeni kategori için sayfa oluşturma
                    $dosya_adi = "../kategoriler/" . strtolower(str_replace(' ', '_', $kategori_adi)) . ".php";
                    $dosya_icerigi = '
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oyun_sitesi";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$kategori_adi = "' . $kategori_adi . '";

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
    <title>' . $kategori_adi . '</title>
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
            <div class="col-lg-2">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
    <section class="normal-breadcrumb set-bg" data-setbg="' . $target_file . '" alt="' . $kategori_adi . '" style="height:500px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>' . $kategori_adi . '</h2>
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
</html>';

                    // Dosya oluşturma
                    if (file_put_contents($dosya_adi, $dosya_icerigi)) {
                        echo " Kategori sayfası başarıyla oluşturuldu.";
                    } else {
                        echo " Kategori sayfası oluşturulurken bir hata oluştu.";
                    }
                } else {
                    echo "Kategori eklenirken bir hata oluştu: " . $stmt->error;
                }
                
                $stmt->close();
            } else {
                echo "Lütfen bir kategori adı girin.";
            }
        } else {
            echo "Üzgünüz, dosyanız yüklenirken bir hata oluştu.";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Kategori Ekle">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Ekle</title>
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
                        <h2>Kategori Ekle</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="login spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="oyun_form">
                <form action="kategori_ekle.php" method="POST" enctype="multipart/form-data">
                    <div class="oyun_item">
                        <input type="text" name="kategori_adi" placeholder="Kategori Adı" required>
                    </div>
                    <div class="oyun_item">
                        <input type="file" name="gorsel" required style="background: none;">
                    </div>
                    <button type="submit" class="site-btn">Ekle</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </section>
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