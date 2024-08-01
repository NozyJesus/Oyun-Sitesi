<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad_soyad = $_POST['ad_soyad'];
    $eposta = $_POST['eposta'];
    $mesaj = $_POST['mesaj'];

    $stmt = $conn->prepare("INSERT INTO iletisim (ad_soyad, eposta, mesaj) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $ad_soyad, $eposta, $mesaj);

    if ($stmt->execute()) {
        $basari = "Mesajınız başarıyla gönderildi!";
    } else {
        $hata = "Mesajınız gönderilirken bir hata oluştu.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="tr">
  <head>
    <title>İletişim</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css?family=Montserrat:300,300i,400,400i,500,600,700,800%7CPoppins:600">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
  </head>
  <body>
    <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
      <div class="preloader-inner">
        <div class="preloader-top">
          <div class="preloader-top-sun"><img src="images/preloader-default-90x73.png" alt="" width="90" height="73">
          </div>
        </div>
      </div>
    </div>
    <div class="page">
      <header class="section page-header page-header-1 context-dark">
        <div class="page-header-1-figure m-parallax">
          <div class="page-header-1-image m-parallax-image" style="background-image: url(images/bg-image-1.jpg);"></div>
        </div>
        <!-- Navbar Başlangıç -->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="1px" data-xl-stick-up-offset="1px" data-xxl-stick-up-offset="1px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <div class="rd-navbar-panel">
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <div class="rd-navbar-brand"><a class="brand" href="index.php"><img class="brand-logo-dark" src="images/logo-default-220x68.png" alt="" width="110" height="34"><img class="brand-logo-light" src="images/logo-inverse-220x68.png" alt="" width="110" height="34"></a>
                  </div>
                </div>
                <div class="rd-navbar-nav-wrap">
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item"><a class="rd-nav-link" href="index.php">ANASAYFA</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="hakkimizda.php">HAKKIMIZDA</a></li>
                    <li class="rd-nav-item active"><a class="rd-nav-link" href="iletisim.php">İLETİŞİM</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="filmler.php">FİLMLER</a></li>
                  </ul>
                </div>
                <div class="rd-navbar-search">
                  <button class="rd-navbar-search-toggle rd-navbar-fixed-element-2" data-rd-navbar-toggle=".rd-navbar-search"><span></span></button>
                  <form class="rd-search rd-search-custom" action="search-results.php" data-search-live="rd-search-results-live" method="GET">
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
        <!-- Banner Başlangıç -->
        <section class="breadcrumbs-custom">
          <div class="breadcrumbs-custom-inner">
            <div class="container">
              <div class="breadcrumbs-custom-main m-parallax-content">
                <h2 class="breadcrumbs-custom-title">İletişim</h2>
              </div>
            </div>
          </div>
        </section>
        <!-- Banner Bitiş -->
      </header>
        <!-- Adres Başlangıç -->
        <section class="section section-md bg-gray-100">
        <div class="container">
          <div class="row row-30">
            <div class="col-sm-6 col-lg-4">
              <!-- Box 1-->
              <address class="box-1">
                <p class="heading-5 box-1-title">Adres</p>
                <p class="box-1-address">Açılış Saati (Hafta İçi): 09:00 - 17:00</p>
                <p class="box-1-tel heading-6">Yalova Üniversitesi Safran Yerleşkesi, Yalova Meslek Yüksekokulu, Dere Mahallesi, Mehmet Durman Caddesi No: 87 Merkez/YALOVA</p>
              </address>
            </div>
            <div class="col-sm-6 col-lg-4">
              <!-- Box 1-->
              <address class="box-1">
                <p class="heading-5 box-1-title">Tel No</p>
                <p class="box-1-address">Sorunuz mu var? Arayın!</p>
                <p class="box-1-tel heading-5"><a href="tel:#">+90 123 456 78 90</a></p>
              </address>
            </div>
            <div class="col-sm-6 col-lg-4">
              <!-- Box 1-->
              <address class="box-1">
                <p class="heading-5 box-1-title">E-Posta</p>
                <p class="box-1-address">Sorularınızı, öneri veya şikayetlerinizi bize bildirin!</p>
                <p class="box-1-tel heading-6"><a href="mailto: sedefahishavi@gmail.com">sedefahishavi@gmail.com</a></p>
              </address>
            </div>
          </div>
        </div>
        </section>
        <!-- Adres Bitiş -->
        <!-- İletişime Geç Başlangıç -->
        <article class="box-2">
          <div class="box-2-inner">
            <h5>Buradan Bizimle İletişime Geçebilirsin!</h5>
            <?php if (isset($basari)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $basari; ?>
            </div>
            <?php elseif (isset($hata)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $hata; ?>
            </div>
            <?php endif; ?>
            <form class="rd-form rd-mailform form-lg" data-form-output="form-output-global" data-form-type="contact" method="post" action="">
              <div class="form-wrap form-wrap-icon">
                <input class="form-input" id="ad_soyad" type="text" name="ad_soyad" data-constraints="@Required">
                <label class="form-label" for="ad_soyad">Ad - Soyad</label>
                <div class="icon form-icon mdi mdi-account-outline"></div>
              </div>
              <div class="form-wrap form-wrap-icon">
                <input class="form-input" id="eposta" type="email" name="eposta" data-constraints="@Email @Required">
                <label class="form-label" for="eposta">E-Posta</label>
                <div class="icon form-icon mdi mdi-email-outline"></div>
              </div>
              <div class="form-wrap form-wrap-icon">
                <label class="form-label" for="mesaj">Mesaj</label>
                <textarea class="form-input" id="mesaj" name="mesaj" data-constraints="@Required"></textarea>
                <div class="icon form-icon mdi mdi-message-outline"></div>
              </div>
              <div class="form-wrap form-wrap-button text-center">
                <button class="button button-lg button-primary" type="submit">Gönder</button>
              </div>
            </form>
          </div>
        </article>
        <!-- İletişime Geç Bitiş -->
        <!-- Footer Başlangıç -->
      <footer class="section footer-modern context-dark">
        <div class="footer-modern-main">
          <div class="container">
            <div class="row row-30 justify-content-lg-between">
              <div class="col-sm-5 col-md-3 col-lg-3">
                <p class="footer-modern-title">Hızlı Bağlantılar</p>
                <div class="footer-modern-item-block">
                  <ul class="list list-1">
                    <li><a href="index.php">Anasayfa</a></li>
                    <li><a href="hakkimizda.php">Hakkımızda</a></li>
                    <li><a href="iletisim.php">İletişim</a></li>
                    <li><a href="filmler.php">Filmler</a></li>
                    <li><a href="girisyap.php">Admin</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-7 col-md-5 col-lg-4">
                <p class="footer-modern-title">Film Kategorileri</p>
                <div class="footer-modern-item-block" style="max-width: 300px;">
                  <div class="row row-13">
                    <div class="col-6">
                      <ul class="list list-1">
                        <li><a href="filmler/aksiyon.php">Aksiyon</a></li>
                        <li><a href="filmler/animasyon.php">Animasyon</a></li>
                        <li><a href="filmler/drama.php">Drama</a></li>
                        <li><a href="filmler/klasik.php">Klasik</a></li>
                        <li><a href="filmler/korku.php">Korku</a></li>
                      </ul>
                    </div>
                    <div class="col-6">
                      <ul class="list list-1">
                        <li><a href="filmler/gerilim.php">Gerilim</a></li>
                        <li><a href="filmler/komedi.php">Komedi</a></li>
                        <li><a href="filmler/nostaljik.php">Nostaljik</a></li>
                        <li><a href="filmler/romantik.php">Romantik</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-lg-3">
                <p class="footer-modern-title">Politikalar & Sözleşmeler</p>
                <div class="footer-modern-item-block">
                  <ul class="list list-1">
                    <li><a href="kvkk-sozlesmesi.php">KVKK Sözleşmesi</a></li>
                    <li><a href="gizlilik-politikasi.php">Gizlilik Politikası</a></li>
                    <li><a href="sss.php">S.S.S.</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-modern-aside">
          <div class="container">
            <div class="footer-modern-aside-layout"><a class="brand" href="index.php"><img class="brand-logo-dark" src="images/logo-default-220x68.png" alt="" width="110" height="34"><img class="brand-logo-light" src="images/logo-inverse-220x68.png" alt="" width="110" height="34"></a>
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
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
  </body>

</html>