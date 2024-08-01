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

// Oyunları sorgulama
$sql = "SELECT o.id, o.oyun_adi, o.gorsel, o.aktif_oyuncu_sayisi, k.kategori_adi, o.aciklama, o.yapimci, o.yayinlanma_tarihi, o.rating 
        FROM oyunlar o
        LEFT JOIN kategoriler k ON o.kategori_id = k.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oyunlar</title>
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
                        <h2>Oyunlar</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="login spad">
        <div class="container">
            <table class="table table-striped" style="color: white;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Oyun Adı</th>
                        <th scope="col">Görsel</th>
                        <th scope="col">AOS</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Açıklama</th>
                        <th scope="col">Yapımcı</th>
                        <th scope="col">Yayınlanma Tarihi</th>
                        <th scope="col">Rating</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo htmlspecialchars($row["oyun_adi"]); ?></td>
                                <td><img src="<?php echo htmlspecialchars($row["gorsel"]); ?>" alt="<?php echo htmlspecialchars($row["oyun_adi"]); ?>" style="max-width: 100px;"></td>
                                <td><?php echo $row["aktif_oyuncu_sayisi"]; ?></td>
                                <td><?php echo htmlspecialchars($row["kategori_adi"]); ?></td>
                                <td><?php echo htmlspecialchars($row["aciklama"]); ?></td>
                                <td><?php echo htmlspecialchars($row["yapimci"]); ?></td>
                                <td><?php echo $row["yayinlanma_tarihi"]; ?></td>
                                <td><?php echo $row["rating"]; ?></td>
                                <td>
                                    <a href="oyun_duzenle.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Düzenle</a>
                                    <a href="oyun_sil.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bu oyunu silmek istediğinize emin misiniz?');">Sil</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">Henüz oyun eklenmemiş.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
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