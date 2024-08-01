<!DOCTYPE html>
<html class="wide wow-animation" lang="tr">
  <head>
  <title>RetroFilm</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css"
    href="../css?family=Montserrat:300,300i,400,400i,500,600,700,800%7CPoppins:600">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/fonts.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .ie-panel {
      display: none;
      background: #212121;
      padding: 10px 0;
      box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
      clear: both;
      text-align: center;
      position: relative;
      z-index: 1;
    }

    html.ie-10 .ie-panel,
    html.lt-ie-10 .ie-panel {
      display: block;
    }
  </style>
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
      <!-- Navbar Başlangıç -->
      <div class="rd-navbar-wrap header-main-classic">
        <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
          <div class="rd-navbar-main-outer">
            <div class="rd-navbar-main">
              <div class="rd-navbar-panel">
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                <div class="rd-navbar-brand"><a class="brand" href="index.php"><img class="brand-logo-dark" src="images/logo-default-220x68.png" alt="" width="110" height="34"><img class="brand-logo-light" src="images/logo-inverse-220x68.png" alt="" width="110" height="34"></a>
                </div>
              </div>
              <div class="rd-navbar-nav-wrap">
                <ul class="rd-navbar-nav">
                  <li class="rd-nav-item active"><a class="rd-nav-link" href="index.php">ANASAYFA</a></li>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="hakkimizda.php">HAKKIMIZDA</a></li>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="iletisim.php">İLETİŞİM</a></li>
                  <li class="rd-nav-item"><a class="rd-nav-link" href="filmler.php">FİLMLER</a></li>
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
      <!--En Çok İzlenenler Başlangıç -->
      <section class="section section-lg bg-default">
        <div class="container">
          <div class="text-center wow fadeIn" data-wow-delay="100">
            <h2>En Çok İzlenenler</h2>
            <p>İşte kullanıcılarımızın ve izleyenlerin keyif aldığı en çok izlenen filmlerden bazıları.</p>
          </div>
          <div class="owl-carousel owl-theme-1 wow fadeIn" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="3" data-xl-items="3" data-xxl-items="3" data-margin="15px" data-xxl-margin="40px" data-nav="true" data-dots="false" data-autoplay="true" data-wow-delay="100">
            <div class="item">
              <div class="box-nina">
                <div class="box-nina-media"><img src="images/anasayfa-img/Hababam Sınıfı.png" alt="filmler/tumfilmler/hababam-sınıfı.php" width="356" height="412">
                </div>
                <div class="box-nina-text">
                  <h4><a class="link-white" href="filmler/tumfilmler/hababam-sınıfı.php">Hababam Sınıfı</a></h4>
                  <div class="box-nina-info"><span class="icon mdi mdi-calendar-today"></span><span>1976, Komedi</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="box-nina">
                <div class="box-nina-media"><img src="images/anasayfa-img/Kurtlar Vadisi Irak.png" alt="filmler/tumfilmler/kurtlar-vadisi-irak.php" width="356" height="412">
                </div>
                <div class="box-nina-text">
                  <h4><a class="link-white" href="filmler/tumfilmler/kurtlar-vadisi-irak.php">Kurtlar Vadisi Irak</a></h4>
                  <div class="box-nina-info"><span class="icon mdi mdi-calendar-today"></span><span>2006, Aksiyon</span>
                  </div>
                </div>
                <div class="box-nina-badge"></div>
              </div>
            </div>
            <div class="item">
              <div class="box-nina">
                <div class="box-nina-media"><img src="images/anasayfa-img/Dabbe Bir Cin Vakası.png" alt="filmler/tumfilmler/dabbe-bir-cin-vakası.php" width="356" height="412">
                </div>
                <div class="box-nina-text">
                  <h4><a class="link-white" href="filmler/tumfilmler/dabbe-bir-cin-vakası.php">Dabbe: Bir Cin Vakası</a></h4>
                  <div class="box-nina-info"><span class="icon mdi mdi-calendar-today"></span><span>2012, Korku</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="box-nina">
                <div class="box-nina-media"><img src="images/anasayfa-img/Aşk Sana Benzer.png" alt="filmler/tumfilmler/aşk-sana-benzer.php" width="356" height="412">
                </div>
                <div class="box-nina-text">
                  <h4><a class="link-white" href="filmler/tumfilmler/aşk-sana-benzer.php">Aşk Sana Benzer</a></h4>
                  <div class="box-nina-info"><span class="icon mdi mdi-calendar-today"></span><span>2015, Romantik</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="box-nina">
                <div class="box-nina-media"><img src="images/anasayfa-img/Tosun Paşa.png" alt="filmler/tumfilmler/tosun-paşa.php" width="356" height="412">
                </div>
                <div class="box-nina-text">
                  <h4><a class="link-white" href="filmler/tumfilmler/tosun-paşa.php">Tosun Paşa</a></h4>
                  <div class="box-nina-info"><span class="icon mdi mdi-calendar-today"></span><span>1976, Nostaljik</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--En Çok İzlenenler Bitiş -->
      <!-- Popüler Kategoriler Başlangıç -->
      <section class="section section-lg bg-gray-900 context-dark">
        <div class="container">
          <div class="row row-50 flex-lg-row-reverse align-items-center justify-content-xl-between">
            <div class="col-lg-4 col-xl-5 col-xxl-4">
              <div class="block-7">
                <h2 class="wow fadeIn">Popüler<br>Kategoriler</h2>
                <p class="text-2 block-10 mt-md-20 mt-xxl-35 wow fadeIn" data-wow-delay=".025s" align="justify">RetroFilm'deki tüm içerik çeşitli kategorilere ayrılmıştır. <br>Aralarında kolayca gezinmenize ve beğendiğinizi bulmanıza yardımcı olur.
              </div>
            </div>
            <div class="col-lg-8 col-xl-7">
              <div class="row row-30">
                <div class="col-sm-6 wow fadeIn"><a class="destination-1 context-dark" href="filmler/drama.php">
                    <figure class="destination-1-figure">
                      <div class="destination-1-image bg-image" style="background-image: url(images/destinations-1-363x260.jpg);"></div>
                    </figure>
                    <div class="destination-1-caption">
                      <p class="heading-4 destination-1-title">Drama</p>
                    </div>
                  </a>
                </div>
                <div class="col-sm-6 wow fadeIn" data-wow-delay=".025s"><a class="destination-1 context-dark" href="filmler/romantik.php">
                    <figure class="destination-1-figure">
                      <div class="destination-1-image bg-image" style="background-image: url(images/destinations-7-363x260.jpg);"></div>
                    </figure>
                    <div class="destination-1-caption">
                      <p class="heading-4 destination-1-title">Romantik</p>
                    </div>
                  </a>
                </div>
                <div class="col-sm-6 wow fadeIn" data-wow-delay=".025s"><a class="destination-1 context-dark" href="filmler/korku.php">
                    <figure class="destination-1-figure">
                      <div class="destination-1-image bg-image" style="background-image: url(images/destinations-12-363x260.jpg);"></div>
                    </figure>
                    <div class="destination-1-caption">
                      <p class="heading-4 destination-1-title">Korku</p>
                    </div>
                  </a>
                </div>
                <div class="col-sm-6 wow fadeIn" data-wow-delay=".075s"><a class="destination-1 context-dark" href="filmler/komedi.php">
                    <figure class="destination-1-figure">
                      <div class="destination-1-image bg-image" style="background-image: url(images/destinations-5-363x260.jpg);"></div>
                    </figure>
                    <div class="destination-1-caption">
                      <p class="heading-4 destination-1-title">Komedi</p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Popüler Kategoriler Bitiş -->
      <!-- Uygulama Başlangıç -->
      <section class="section section-custom-2 bg-default">
        <div class="container">
          <div class="row row-40 row-60 justify-content-between">
            <div class="col-lg-5">
              <h5 class="wow fadeInUp" data-wow-delay=".025s">Uygulamamızı İndir</h5>
              <h2 class="style-title-2 wow fadeInUp" data-wow-delay=".05s">İstediğin Yerde İzle!</h2>
              <h6 class="text-gray-500 font-weight-regular ls-2 wow fadeInUp" data-wow-delay=".075s">Cihazınıza RetroFilm
                uygulamasını yükleyin ve her yerde yüksek kaliteli klasik Türk filmlerinin keyfini çıkarın.</h6>
              <div class="button-wrap wow fadeInUp" data-wow-delay="1s"><a href="#"><img src="images/button-img-01-151x49.png" alt="" width="151" height="49"></a><a href="#"><img src="images/button-img-02-153x49.png" alt="" width="153" height="49"></a></div>
            </div>
            <div class="col-lg-7 parallax-scene-js">
              <div class="section-image-1"><img src="images/section-image-1-546x33.png" alt="" width="546" height="33">
                <div class="section-image-decorative-1">
                  <div class="layer" data-depth="-.25">
                    <div class="item"></div>
                  </div>
                </div>
                <div class="section-image-decorative-2">
                  <div class="layer" data-depth="+.25">
                    <div class="item"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Uygulama Bitiş -->
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