<?php
session_start();
require_once '../db.php';

// Oturum kontrolü
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../girisyap.php');
    exit;
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $film_adi = $_POST['film_adi'];
    $cikis_tarihi = $_POST['cikis_tarihi'];
    $imdb_puani = $_POST['imdb_puani'];
    $aciklama = $_POST['aciklama'];
    $yonetmenler_str = $_POST['yonetmenler'];
    $basrol_oyunculari_str = $_POST['basrol_oyunculari'];
    $film_suresi = $_POST['film_suresi'];
    $kategori_id = $_POST['kategori_id'];
    $fragman_link = $_POST['fragman_link'];
    $izleme_link = $_POST['izleme_link'];

    // Dosya yükleme işlemi
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["kapak_foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Dosyayı yükle
    if (move_uploaded_file($_FILES["kapak_foto"]["tmp_name"], $target_file)) {
        $kapak_foto = $target_file;
    } else {
        $kapak_foto = ""; // Varsayılan bir kapak fotoğrafı belirleyebilirsiniz
    }

    // Yönetmenleri virgülden ayırarak diziye dönüştürme
    $yonetmenler = explode(", ", $yonetmenler_str);

    // Başrol oyuncularını virgülden ayırarak diziye dönüştürme
    $basrol_oyunculari = explode(", ", $basrol_oyunculari_str);

    // Veritabanına film ekleme işlemi
    $insert_stmt = $conn->prepare("INSERT INTO filmler (film_adi, cikis_tarihi, imdb_puani, aciklama, film_suresi, kategori_id, kapak_foto, fragman_link, izleme_link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert_stmt->bind_param("ssdssisss", $film_adi, $cikis_tarihi, $imdb_puani, $aciklama, $film_suresi, $kategori_id, $kapak_foto, $fragman_link, $izleme_link);

    if ($insert_stmt->execute()) {
        $film_id = $insert_stmt->insert_id;

        // Yönetmenleri veritabana kaydetme işlemi
        foreach ($yonetmenler as $yonetmen) {
          // Yönetmenler tablosuna eklemek için prepare ve bind_param kullanımı
          $insert_yonet_stmt = $conn->prepare("INSERT INTO yonetmenler (film_id, yonetmen_adi) VALUES (?, ?)");
          $insert_yonet_stmt->bind_param("is", $film_id, $yonetmen);
          $insert_yonet_stmt->execute();
          $insert_yonet_stmt->close();
      }

        // Başrol oyuncularını veritabanına kaydetme işlemi
        foreach ($basrol_oyunculari as $oyuncu) {
            // Başrol oyuncuları tablosuna eklemek için prepare ve bind_param kullanımı
            $insert_basrol_stmt = $conn->prepare("INSERT INTO basrol_oyunculari (film_id, oyuncu_adi) VALUES (?, ?)");
            $insert_basrol_stmt->bind_param("is", $film_id, $oyuncu);
            $insert_basrol_stmt->execute();
            $insert_basrol_stmt->close();
        }

        // Kategori adını veritabanından alma işlemi
        $kategori_sorgu = $conn->prepare("SELECT kategori_adi FROM kategoriler WHERE kategori_id = ?");
        $kategori_sorgu->bind_param("i", $kategori_id);
        $kategori_sorgu->execute();
        $kategori_sorgu->bind_result($kategori_adi);
        $kategori_sorgu->fetch();
        $kategori_sorgu->close();

        // Dinamik sayfa oluşturma işlemi
        $film_dizin = '../filmler/tumfilmler/';
        $film_url = $film_dizin . strtolower(str_replace(' ', '-', $film_adi)) . '.php';
        $film_file = $film_dizin . strtolower(str_replace(' ', '-', $film_adi)) . '.php';

        // Dosya yolunun mevcut olup olmadığını kontrol et ve yoksa oluştur
        $dir = dirname($film_file);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Dosya içeriği
        $film_content = "<!DOCTYPE html>
<html class=\"wide wow-animation\">
  <head>
    <title>{$film_adi}</title>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width height=device-height initial-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <link rel=\"icon\" href=\"../../images/favicon.ico\" type=\"image/x-icon\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../../css?family=Montserrat:300,300i,400,400i,500,600,700,800%7CPoppins:600\">
    <link rel=\"stylesheet\" href=\"../../css/bootstrap.css\">
    <link rel=\"stylesheet\" href=\"../../css/fonts.css\">
    <link rel=\"stylesheet\" href=\"../../css/style.css\">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
  </head>
  <body>
    <div class=\"ie-panel\"><a href=\"http://windows.microsoft.com/en-US/internet-explorer/\"><img src=\"../../images/ie8-panel/warning_bar_0000_us.jpg\" height=\"42\" width=\"820\" alt=\"You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.\"></a></div>
    <div class=\"preloader\">
      <div class=\"preloader-inner\">
        <div class=\"preloader-top\">
          <div class=\"preloader-top-sun\"><img src=\"../../images/preloader-default-90x73.png\" alt=\"\" width=\"90\" height=\"73\">
          </div>
        </div>
      </div>
    </div>
    <div class=\"page\">
      <header class=\"section page-header page-header-1 context-dark\">
        <div class=\"page-header-1-figure m-parallax\">
          <div class=\"page-header-1-image m-parallax-image\"></div>
        </div>
        <!-- Navbar Başlangıç -->
        <div class=\"rd-navbar-wrap\">
          <nav class=\"rd-navbar rd-navbar-classic\" data-layout=\"rd-navbar-fixed\" data-sm-layout=\"rd-navbar-fixed\" data-md-layout=\"rd-navbar-fixed\" data-md-device-layout=\"rd-navbar-fixed\" data-lg-layout=\"rd-navbar-static\" data-lg-device-layout=\"rd-navbar-fixed\" data-xl-layout=\"rd-navbar-static\" data-xl-device-layout=\"rd-navbar-static\" data-lg-stick-up-offset=\"1px\" data-xl-stick-up-offset=\"1px\" data-xxl-stick-up-offset=\"1px\" data-lg-stick-up=\"true\" data-xl-stick-up=\"true\" data-xxl-stick-up=\"true\">
            <div class=\"rd-navbar-main-outer\">
              <div class=\"rd-navbar-main\">
                <div class=\"rd-navbar-panel\">
                  <button class=\"rd-navbar-toggle\" data-rd-navbar-toggle=\".rd-navbar-nav-wrap\"><span></span></button>
                  <div class=\"rd-navbar-brand\"><a class=\"brand\" href=\"../../index.php\"><img class=\"brand-logo-dark\" src=\"../../images/logo-default-220x68.png\" alt=\"\" width=\"110\" height=\"34\"><img class=\"brand-logo-light\" src=\"../../images/logo-inverse-220x68.png\" alt=\"\" width=\"110\" height=\"34\"></a>
                  </div>
                </div>
                <div class=\"rd-navbar-nav-wrap\">
                  <ul class=\"rd-navbar-nav\">
                    <li class=\"rd-nav-item\"><a class=\"rd-nav-link\" href=\"../../index.php\">ANASAYFA</a></li>
                    <li class=\"rd-nav-item\"><a class=\"rd-nav-link\" href=\"../../hakkimizda.php\">HAKKIMIZDA</a></li>
                    <li class=\"rd-nav-item\"><a class=\"rd-nav-link\" href=\"../../iletisim.php\">İLETİŞİM</a></li>
                    <li class=\"rd-nav-item\"><a class=\"rd-nav-link\" href=\"../../filmler.php\">FİLMLER</a></li>
                  </ul>
                </div>
                <div class=\"rd-navbar-search\">
                  <button class=\"rd-navbar-search-toggle rd-navbar-fixed-element-2\" data-rd-navbar-toggle=\".rd-navbar-search\"><span></span></button>
                  <form class=\"rd-search rd-search-custom\" action=\"aramasonuc.php\" data-search-live=\"rd-search-results-live\" method=\"GET\">
                    <div class=\"form-wrap\">
                      <label class=\"form-label\" for=\"rd-navbar-search-form-input\">Arama Yap...</label>
                      <input class=\"rd-navbar-search-form-input form-input\" id=\"rd-navbar-search-form-input\" type=\"text\" name=\"s\" autocomplete=\"off\">
                      <div class=\"rd-search-results-live\" id=\"rd-search-results-live\"></div>
                    </div>
                    <button class=\"rd-search-form-submit fa-search\" type=\"submit\"></button>
                  </form>
                </div>
              </div>
            </div>
          </nav>
        </div>
        <!-- Navbar Bitiş -->
      </header>
      <section class=\"section section-lg\">
        <div class=\"container\">
          <div class=\"row row-30 flex-column-reverse flex-lg-row\">
            <div class=\"col-lg-8\">
              <article class=\"post-info inset-1\">
                <h4 class=\"post-info-title\">{$film_adi}</h4>
                <div class=\"post-info-meta bg-gray-100\">
                  <ul class=\"post-info-meta-list\">
                    <li><span class=\"icon mdi mdi-calendar-blank\"></span><span class=\"small-text font-weight-sbold\">{$cikis_tarihi}</span></li>
                    <li><span class=\"icon mdi mdi-star-outline\"></span><span class=\"small-text font-weight-sbold\">IMDB: {$imdb_puani}/10</span></li>
                  </ul>
                </div>
                <p>{$aciklama}</p>
                <table class=\"post-info-table\">
                  <tr>
                    <td>Yönetmenler</td>
                    <td>{$yonetmenler_str}</td>
                  </tr>
                  <tr>
                    <td>Başrol Oyuncuları</td>
                    <td>{$basrol_oyunculari_str}</td>
                  </tr>
                  <tr>
                    <td>Film Süresi</td>
                    <td>{$film_suresi} dakika</td>
                  </tr>
                  <tr>
                    <td>Film Kategorisi</td>
                    <td>{$kategori_adi}</td>
                  </tr>
                  <tr>
                    <td>Fragman Linki</td>
                    <td>{$fragman_link}</td>
                  </tr>
                  <tr>
                    <td>İzleme Linki</td>
                    <td>{$izleme_link}</td>
                  </tr>
                </table>
              </article>
            </div>
            <div class=\"col-lg-4 text-center text-lg-start\">
              <div class=\"movie-page-image\"><img src=\"../../uploads/{$kapak_foto}\" alt=\"\" width=\"375\" height=\"491\">
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Footer Başlangıç -->
      <footer class=\"section footer-modern context-dark\">
        <div class=\"footer-modern-main\">
          <div class=\"container\">
            <div class=\"row row-30 justify-content-lg-between\">
              <div class=\"col-sm-5 col-md-3 col-lg-3\">
                <p class=\"footer-modern-title\">Hızlı Bağlantılar</p>
                <div class=\"footer-modern-item-block\">
                  <ul class=\"list list-1\">
                    <li><a href=\"../../index.php\">Anasayfa</a></li>
                    <li><a href=\"../../hakkimizda.php\">Hakkımızda</a></li>
                    <li><a href=\"../../iletisim.php\">İletişim</a></li>
                    <li><a href=\"../../filmler.php\">Filmler</a></li>
                  </ul>
                </div>
              </div>
              <div class=\"col-sm-7 col-md-5 col-lg-4\">
                <p class=\"footer-modern-title\">Film Kategorileri</p>
                <div class=\"footer-modern-item-block\" style=\"max-width: 300px;\">
                  <div class=\"row row-13\">
                    <div class=\"col-6\">
                      <ul class=\"list list-1\">
                        <li><a href=\"../../aksiyon.php\">Aksiyon</a></li>
                        <li><a href=\"../../animasyon.php\">Animasyon</a></li>
                        <li><a href=\"../../drama.php\">Drama</a></li>
                        <li><a href=\"../../klasik.php\">Klasik</a></li>
                        <li><a href=\"../../korku.php\">Korku</a></li>
                      </ul>
                    </div>
                    <div class=\"col-6\">
                      <ul class=\"list list-1\">
                        <li><a href=\"../../gerilim.php\">Gerilim</a></li>
                        <li><a href=\"../../komedi.php\">Komedi</a></li>
                        <li><a href=\"../../nostaljik.php\">Nostaljik</a></li>
                        <li><a href=\"../../romantik.php\">Romantik</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class=\"col-md-4 col-lg-3\">
                <p class=\"footer-modern-title\">Politikalar & Sözleşmeler</p>
                <div class=\"footer-modern-item-block\">
                  <ul class=\"list list-1\">
                    <li><a href=\"../../kvkk-sozlesmesi.php\">KVKK Sözleşmesi</a></li>
                    <li><a href=\"../../gizlilik-politikasi.php\">Gizlilik Politikası</a></li>
                    <li><a href=\"../../sss.php\">S.S.S.</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"footer-modern-aside\">
          <div class=\"container\">
            <div class=\"footer-modern-aside-layout\"><a class=\"brand\" href=\"../../index.php\"><img class=\"brand-logo-dark\" src=\"../../images/logo-default-220x68.png\" alt=\"\" width=\"110\" height=\"34\"><img class=\"brand-logo-light\" src=\"../../images/logo-inverse-220x68.png\" alt=\"\" width=\"110\" height=\"34\"></a>
              <p class=\"rights\"><span>&copy;&nbsp; </span><span class=\"copyright-year\"></span><span>&nbsp;</span><span>Tüm Hakları Saklıdır.&nbsp;</span></p>
              <div>
                <div class=\"group group-sm\"><a class=\"link-1 icon mdi mdi-instagram\" target=\"_blank\" href=\"https://www.instagram.com/sedefahishavi/\"></a><a class=\"link-1 icon mdi mdi-whatsapp\" target=\"_blank\" href=\"https://wa.me/905511908748\"></a><a class=\"link-1 icon mdi mdi-gmail\" target=\"_blank\" href=\"mailto: sedefahishavi@gmail.com\"></a></div>
              </div>
            </div>
          </div>
        </div>
        </footer>
        <!-- Footer Bitiş -->
      </div>
    <script src=\"../../js/core.min.js\"></script>
    <script src=\"../../js/script.js\"></script>
  </body>
</html>";

        // Yeni dosya oluşturma ve yazma işlemi
        file_put_contents($film_file, $film_content);

        // Başarı mesajı
        echo "";
    } else {
        echo "Hata: " . $insert_stmt->error;
    }

    $insert_stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Ekle</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .navbar-custom {
            background-color: #343a40;
            padding: 0 10%; /* Sol ve sağ kenar boşlukları */
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
            font-size: 25px;
        }
        .navbar-custom .navbar-brand {
            padding-left: 10px; /* Sol kenar boşluğu */
        }
        .navbar-custom .navbar-nav {
            margin-left: auto; /* Sağda hizalama için */
        }
    </style>
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-custom" style="padding-left: 10%;">
    <a class="navbar-brand" href="index.php">Admin Paneli</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Çıkış Yap</a>
            </li>
        </ul>
    </div>
</nav>
</header>
    <div class="container mt-5">
        <h3 class="mb-4">Film Ekle</h3>
        <?php if (isset($basari)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $basari; ?>
            </div>
        <?php elseif (isset($hata)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $hata; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="film_adi">Film Adı</label>
                <input type="text" class="form-control" id="film_adi" name="film_adi" min="3" required>
            </div><br>
            <div class="form-group">
                <label for="cikis_tarihi">Çıkış Tarihi</label>
                <input type="date" class="form-control" id="cikis_tarihi" name="cikis_tarihi" required>
            </div><br>
            <div class="form-group">
                <label for="imdb_puani">IMDB Puanı</label>
                <input type="number" step="0.1" class="form-control" id="imdb_puani" name="imdb_puani" max="10" min="0.1" required>
            </div><br>
            <div class="form-group">
                <label for="aciklama">Açıklama</label>
                <textarea class="form-control" id="aciklama" name="aciklama" rows="3" required></textarea>
            </div><br>
            <div class="form-group">
            <label for="yonetmenler">Yönetmenler (Virgülle Ayırarak)</label>
            <input type="text" class="form-control" id="yonetmenler" name="yonetmenler" required>
            <small class="form-text text-muted">Yönetmenleri virgülle ayırarak yazınız (Örneğin: David Fincher, Woody Allen, Cristopher Nolan).</small>
            </div><br>
            <div class="form-group">
            <label for="basrol_oyunculari">Başrol Oyuncuları (Virgülle Ayırarak)</label>
            <input type="text" class="form-control" id="basrol_oyunculari" name="basrol_oyunculari" required>
            <small class="form-text text-muted">Başrol oyuncularını virgülle ayırarak yazınız (Örneğin: Tom Hanks, Julia Roberts, Brad Pitt).</small>
            </div><br>
            <div class="form-group">
                <label for="film_suresi">Film Süresi (dakika)</label>
                <input type="number" class="form-control" id="film_suresi" name="film_suresi" min="1" required>
            </div><br>
            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select class="form-control" id="kategori_id" name="kategori_id" required>
                    <option value="">Kategori Seçiniz</option>
                    <!-- Kategorileri veritabanından dinamik olarak çekmek için bir sorgu yapabilirsiniz -->
                    <?php
                    $query = "SELECT * FROM kategoriler";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['kategori_id'] . '">' . $row['kategori_adi'] . '</option>';
                    }
                    ?>
                </select>
            </div><br>
            <div class="form-group">
                <label for="kapak_foto">Kapak Fotoğrafı</label><br>
                <input type="file" class="form-control-file" id="kapak_foto" name="kapak_foto" accept="image/*" required>
            </div><br>
            <div class="form-group">
                <label for="fragman_link">Fragman Linki</label>
                <input type="text" class="form-control" id="fragman_link" name="fragman_link" required>
            </div><br>
            <div class="form-group">
                <label for="izleme_link">İzleme Linki</label>
                <input type="text" class="form-control" id="izleme_link" name="izleme_link" required>
            </div><br>
            <button type="submit" class="btn btn-primary">Film Ekle</button>
        </form>
    </div><br>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>