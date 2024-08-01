<?php
require_once '../db.php'; // Veritabanı bağlantısı

// Veritabanından filmleri seç
$query = "SELECT * FROM filmler WHERE kategori_id = ?"; // kategori_id kısmını kendi kategorinizi belirtmek için düzenleyin
$stmt = $conn->prepare($query);
$kategori_id = 5;
$stmt->bind_param("i", $kategori_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="tr">
  <head>
    <title>Filmler - Korku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../../css?family=Montserrat:300,300i,400,400i,500,600,700,800%7CPoppins:600">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
  </head>
  <body>
    <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="../images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
      <div class="preloader-inner">
        <div class="preloader-top">
          <div class="preloader-top-sun"><img src="../images/preloader-default-90x73.png" alt="" width="90" height="73">
          </div>
        </div>
      </div>
    </div>
    <div class="page">
      <header class="section page-header page-header-1 context-dark">
        <div class="page-header-1-figure m-parallax">
          <div class="page-header-1-image m-parallax-image" style="background-image: url(../images/film-kategori-bg/korku.png);"></div>
        </div>
        <!-- Navbar Başlangıç -->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="1px" data-xl-stick-up-offset="1px" data-xxl-stick-up-offset="1px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <div class="rd-navbar-panel">
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <div class="rd-navbar-brand"><a class="brand" href="../index.php"><img class="brand-logo-dark" src="../images/logo-default-220x68.png" alt="" width="110" height="34"><img class="brand-logo-light" src="../images/logo-inverse-220x68.png" alt="" width="110" height="34"></a>
                  </div>
                </div>
                <div class="rd-navbar-nav-wrap">
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../index.php">ANASAYFA</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../hakkimizda.php">HAKKIMIZDA</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../iletisim.php">İLETİŞİM</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../filmler.php">FİLMLER</a></li>
                  </ul>
                </div>
                <div class="rd-navbar-search">
                  <button class="rd-navbar-search-toggle rd-navbar-fixed-element-2" data-rd-navbar-toggle=".rd-navbar-search"><span></span></button>
                  <form class="rd-search rd-search-custom" action="aramasonuc.php" data-search-live="rd-search-results-live" method="GET">
                    <div class="form-wrap">
                      <label class="form-label" for="rd-navbar-search-form-input">Arama Yap...</label>
                      <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off">
                      <div class="rd-search-results-live" id="rd-search-results-live"></div>
                    </div>
                    <button class="rd-search-form-submit fa-search" type="submit"></button>
                  </form>
                </div>
              </div>
            </div>
          </nav>
        </div>
        <!-- Navbar Bitiş -->
        <section class="breadcrumbs-custom">
          <div class="breadcrumbs-custom-inner">
            <div class="container">
              <div class="breadcrumbs-custom-main m-parallax-content">
                <h2 class="breadcrumbs-custom-title">Korku</h2>
                <p>
                Korku filmleri, izleyiciyi geren, korkutan ve heyecanlandıran öykülerle dolu bir film türüdür. 
                Bu tür, genellikle ürpertici atmosferler, gizemli olaylar ve korku unsurlarıyla karakterize edilir. 
                Türk korku sineması da bu geleneği sürdürerek yerli izleyicilere kendi kültürel ve folklorik ögelerini de içeren korku deneyimleri sunar. 
                Korku filmleri, izleyicileri gerilim dolu bir yolculuğa çıkarırken aynı zamanda insan psikolojisi üzerine de derinlikli düşüncelere yol açabilir. 
                Türk korku filmleri, geleneksel ve çağdaş korku unsurlarını bir araya getirerek kendi özgün kimliğini ortaya koyar.
                </p>
              </div>
            </div>
          </div>
        </section>
      </header>
      <section class="section section-lg bg-gray-100">
        <div class="container">
          <div class="row row-50 flex-lg-row-reverse">
            <div class="col-lg-4">
              <h4>Kategoriler</h4>
              <div class="box-right">
                <div class="box-tina">
                  <ul class="box-tina-list">
                    <li><a href="aksiyon.php">Aksiyon</a></li>
                    <li><a href="animasyon.php">Animasyon</a></li>
                    <li><a href="drama.php">Drama</a></li>
                    <li><a href="klasik.php">Klasik</a></li>
                    <li><a href="korku.php">Korku</a></li>
                    <li><a href="gerilim.php">Gerilim</a></li>
                    <li><a href="komedi.php">Komedi</a></li>
                    <li><a href="nostaljik.php">Nostaljik</a></li>
                    <li><a href="romantik.php">Romantik</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <h4>Filmler</h4>
              <?php while ($film = $result->fetch_assoc()) : ?>
                <article class="tour-modern">
                  <div class="tour-modern-media"><a class="tour-modern-figure" href="tumfilmler/<?php echo strtolower(str_replace(' ', '-', $film['film_adi'])); ?>.php"><img class="tour-modern-image" src="../uploads/<?php echo $film['kapak_foto']; ?>" alt="<?php echo $film['film_adi']; ?>" width="210" height="264"></a></div>
                  <div class="tour-modern-main">
                    <h5 class="tour-modern-title"><a href="tumfilmler/<?php echo strtolower(str_replace(' ', '-', $film['film_adi'])); ?>.php"><?php echo $film['film_adi']; ?></a></h5>
                    <div class="tour-modern-info">
                      Çıkış Tarihi: <?php $cikis_tarihi = new DateTime($film['cikis_tarihi']); echo $cikis_tarihi->format('d-m-Y');?><br>
                      Süre: <?php echo $film['film_suresi']; ?> dk
                    </div>
                    <p><?php echo $film['aciklama']; ?></p>
                  </div>
                </article>
              <?php endwhile; ?>
              <nav class="pagination-outer text-center">
                <ul class="pagination">
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </section>
      <!-- Footer Başlangıç -->
      <footer class="section footer-modern context-dark">
        <div class="footer-modern-main">
          <div class="container">
            <div class="row row-30 justify-content-lg-between">
              <div class="col-sm-5 col-md-3 col-lg-3">
                <p class="footer-modern-title">Hızlı Bağlantılar</p>
                <div class="footer-modern-item-block">
                  <ul class="list list-1">
                    <li><a href="../index.php">Anasayfa</a></li>
                    <li><a href="../hakkimizda.php">Hakkımızda</a></li>
                    <li><a href="../iletisim.php">İletişim</a></li>
                    <li><a href="../filmler.php">Filmler</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-7 col-md-5 col-lg-4">
                <p class="footer-modern-title">Film Kategorileri</p>
                <div class="footer-modern-item-block" style="max-width: 300px;">
                  <div class="row row-13">
                    <div class="col-6">
                      <ul class="list list-1">
                        <li><a href="aksiyon.php">Aksiyon</a></li>
                        <li><a href="animasyon.php">Animasyon</a></li>
                        <li><a href="drama.php">Drama</a></li>
                        <li><a href="klasik.php">Klasik</a></li>
                        <li><a href="korku.php">Korku</a></li>
                      </ul>
                    </div>
                    <div class="col-6">
                      <ul class="list list-1">
                        <li><a href="gerilim.php">Gerilim</a></li>
                        <li><a href="komedi.php">Komedi</a></li>
                        <li><a href="nostaljik.php">Nostaljik</a></li>
                        <li><a href="romantik.php">Romantik</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-lg-3">
                <p class="footer-modern-title">Politikalar & Sözleşmeler</p>
                <div class="footer-modern-item-block">
                  <ul class="list list-1">
                    <li><a href="../kvkk-sozlesmesi.php">KVKK Sözleşmesi</a></li>
                    <li><a href="../gizlilik-politikasi.php">Gizlilik Politikası</a></li>
                    <li><a href="../sss.php">S.S.S.</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-modern-aside">
          <div class="container">
            <div class="footer-modern-aside-layout"><a class="brand" href="../index.php"><img class="brand-logo-dark" src="../images/logo-default-220x68.png" alt="" width="110" height="34"><img class="brand-logo-light" src="../images/logo-inverse-220x68.png" alt="" width="110" height="34"></a>
              <p class="rights"><span>&copy;&nbsp; </span><span class="copyright-year"></span><span>&nbsp;</span><span>Tüm
                  Hakları Saklıdır.&nbsp;</span></p>
              <div>
                <div class="group group-sm"><a class="link-1 icon mdi mdi-instagram" target="_blank" href="https://www.instagram.com/sedefahishavi/"></a><a class="link-1 icon mdi mdi-whatsapp" target="_blank" href="https://wa.me/905511908748"></a><a class="link-1 icon mdi mdi-gmail" target="_blank" href="mailto: sedefahishavi@gmail.com"></a></div>
              </div>
            </div>
          </div>
        </div>
        </footer>
        <!-- Footer Bitiş -->
    </div>
    <div class="snackbars" id="form-output-global"></div>
    <script src="../js/core.min.js"></script>
    <script src="../js/script.js"></script>
  </body>
</html>