<?php
session_start();

// Oturum kontrolü - eğer kullanıcı oturumu başlatmışsa devam eder
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../girisyap.php');
    exit;
}

// Oturum başlatmış kullanıcıya hoş geldiniz mesajı
$welcome_message = 'Hoş geldiniz, ' . $_SESSION['kullanici_adi'] . '!';

// Veritabanı bağlantısı
require_once '../db.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css?family=Montserrat:300,300i,400,400i,500,600,700,800%7CPoppins:600">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts.css">
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
    <section class="section section-lg bg-default">
        <div class="container">
          <div class="row row-30 mt-xl-60">
            <div class="col-sm-6 col-lg-3">
                <a href="mesajlar.php">
                    <article class="tour-minimal context-dark">
                        <div class="tour-minimal-inner" style="background-image: url(../images/iletisim.png);">
                            <div class="tour-minimal-header">
                        </div>
                        <div class="tour-minimal-main">
                            <h6 class="tour-minimal-title">İletişim Mesajları</h6>
                        </div>
                        <div class="tour-minimal-caption">
                            <p>Sitedeki mesajları görüntüleyebilir, düzenleyebilir ve silebilirsin.</p>
                        </div>
                        </div>
                    </article>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="filmekle.php">
                    <article class="tour-minimal context-dark">
                        <div class="tour-minimal-inner" style="background-image: url(../images/filmekle.png);">
                            <div class="tour-minimal-header">
                        </div>
                        <div class="tour-minimal-main">
                            <h6 class="tour-minimal-title">Film Ekle</h6>
                        </div>
                        <div class="tour-minimal-caption">
                            <p>Filmleri buradan ekleyebilirsin.</p>
                        </div>
                        </div>
                    </article>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
              <article class="tour-minimal context-dark">
                <div class="tour-minimal-inner" style="background-image: url(../images/loading.png);">
                  <div class="tour-minimal-header">
                  </div>
                  <div class="tour-minimal-main">
                    <h6 class="tour-minimal-title"><a href="movie-page.html">Geliştiriliyor...</a></h6>
                  </div>
                  <div class="tour-minimal-caption">
                    <p>Bu özellik şu anda geliştirilme/test edilme aşamasındadır.</p>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-3">
              <article class="tour-minimal context-dark">
                <div class="tour-minimal-inner" style="background-image: url(../images/loading.png);">
                  <div class="tour-minimal-header">
                  </div>
                  <div class="tour-minimal-main">
                    <h6 class="tour-minimal-title"><a href="movie-page.html">Geliştiriliyor...</a></h6>
                  </div>
                  <div class="tour-minimal-caption">
                    <p>Bu özellik şu anda geliştirilme/test edilme aşamasındadır.</p>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
