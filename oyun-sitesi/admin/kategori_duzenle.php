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

session_start();

// Oturum kontrolü
if (!isset($_SESSION['username'])) {
    header("Location: ../admingirisyap.php"); // Giriş sayfasına yönlendir
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Kategoriyi getirme
    $sql = "SELECT * FROM kategoriler WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $kategori = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $kategori_adi = $_POST['kategori_adi'];
    $gorsel = $_POST['gorsel'];

    // Kategoriyi güncelleme
    $sql = "UPDATE kategoriler SET kategori_adi=?, gorsel=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $kategori_adi, $gorsel, $id);

    if ($stmt->execute()) {
        header("Location: kategoriler.php");
    } else {
        echo "Hata: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Oyun Düzenleme Sayfası">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Düzenle</title>
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
                        <h2>Kategori Düzenle</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container mt-5" style="color: white;">
    <div class="oyun_form">
        <form action="kategori_duzenle.php" method="post">
            <input type="hidden" name="id" value="<?php echo $kategori['id']; ?>">
            <div class="oyun_item">
                <label for="kategori_adi">Kategori Adı</label>
                <input type="text" id="kategori_adi" name="kategori_adi" value="<?php echo htmlspecialchars($kategori['kategori_adi']); ?>" required>
            </div>
            <div class="oyun_item">
                <label for="gorsel">Görsel</label>
                <input type="text" id="gorsel" name="gorsel" value="<?php echo htmlspecialchars($kategori['gorsel']); ?>" required>
            </div>
            <button type="submit" class="site-btn">Kaydet</button>
        </form>
    </div>
    </div>
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