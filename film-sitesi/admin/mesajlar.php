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

// Mesaj silme işlemi
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM iletisim WHERE id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: mesajlar.php");
    exit; // Silme işleminden sonra çıkış yaparak yönlendirmeyi kesinleştirin
}

// Mesajları veritabanından çek
$sql = "SELECT * FROM iletisim ORDER BY id ASC";
$result = $conn->query($sql);

// Mesaj ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad_soyad = $_POST['ad_soyad'];
    $eposta = $_POST['eposta'];
    $mesaj = $_POST['mesaj'];

    $stmt = $conn->prepare("INSERT INTO iletisim (ad_soyad, eposta, mesaj) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $ad_soyad, $eposta, $mesaj);

    if ($stmt->execute()) {
        $basari = "Mesaj başarıyla eklendi!";
    } else {
        $hata = "Mesaj eklenirken bir hata oluştu.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mesaj Düzenle</title>
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
        <h3 class="mb-4">İletişim Mesajları</h3>
        <?php if (isset($basari)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $basari; ?>
            </div>
        <?php elseif (isset($hata)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $hata; ?>
            </div>
        <?php endif; ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ad Soyad</th>
                    <th scope="col">Eposta</th>
                    <th scope="col">Mesaj</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <th scope="row"><?php echo $row["id"]; ?></th>
                            <td><?php echo htmlspecialchars($row["ad_soyad"]); ?></td>
                            <td><?php echo htmlspecialchars($row["eposta"]); ?></td>
                            <td><?php echo htmlspecialchars($row["mesaj"]); ?></td>
                            <td><?php echo $row["tarih"]; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Düzenle</a>
                                <a href="mesajlar.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bu mesajı silmek istediğinize emin misiniz?');">Sil</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Henüz mesaj yok.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <article class="box-2">
          <div class="box-2-inner">
            <h5 id="mesajekle"><b>Yeni Mesaj Ekle</b></h5>
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
                <input class="form-input" id="ad_soyad" type="text" name="ad_soyad" placeholder="Ad-Soyad" data-constraints="@Required">
                <label class="form-label" for="ad_soyad"></label>
                <div class="icon form-icon mdi mdi-account-outline"></div>
              </div>
              <div class="form-wrap form-wrap-icon">
                <input class="form-input" id="eposta" type="email" name="eposta" placeholder="E-Posta" data-constraints="@Email @Required">
                <label class="form-label" for "eposta"></label>
                <div class="icon form-icon mdi mdi-email-outline"></div>
              </div>
              <div class="form-wrap form-wrap-icon">
                <label class="form-label" for="mesaj"></label>
                <textarea class="form-input" id="mesaj" name="mesaj" placeholder="Mesaj" data-constraints="@Required"></textarea>
                <div class="icon form-icon mdi mdi-message-outline"></div>
              </div>
              <div class="form-wrap form-wrap-button text-center">
                <button class="button button-lg button-primary" type="submit" name="add_message">Gönder</button>
              </div>
            </form>
          </div>
        </article><br>
    </body>
</html>