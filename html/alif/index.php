<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CV Pribadi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php
    $nama = "Moch Alif";
    $ttl = "Bekasi, 10 april 2008";
    $alamat = "Jl. Cebek,Kab.Bandung";
    $email = "alif@example.com";
    $telepon = "0812-3456-7890";
    $deskripsi = "Saya adalah pelajar yang bersemangat dalam dunia teknologi dan pemrograman. Saya senang belajar hal baru dan mengembangkan kreativitas lewat proyek coding.";
  ?>

  <div class="cv-container">
    <div class="foto">
      <img src="bob.jpg" alt="Foto Profil">
    </div>
    
    <div class="bio fade-in">
      <h1><?= $nama; ?></h1>
      <p><strong>Tempat, Tanggal Lahir:</strong> <?= $ttl; ?></p>
      <p><strong>Alamat:</strong> <?= $alamat; ?></p>
      <p><strong>Email:</strong> <?= $email; ?></p>
      <p><strong>Telepon:</strong> <?= $telepon; ?></p>
    </div>

    <div class="tentang fade-in">
      <h2>Tentang Saya</h2>
      <p><?= $deskripsi; ?></p>
    </div>

    <div class="pendidikan fade-in">
      <h2>Pendidikan</h2>
      <ul>
        <li><strong>SDN KaramatMulya 02</strong> (2015–2020)</li>
        <li><strong>SMPN 3 Soreang</strong> (2021–2024)</li>
        <li><strong>SMKN 1 Soreang</strong> – tjkt (2024–Sekarang)</li>
      </ul>
    </div>

    <div class="keahlian fade-in">
      <h2>Keahlian</h2>
      <div class="skills">
        <span>main basket</span>
        <span>main gitar</span>
        <span>maen epep</span>
      </div>
    </div>

    <footer>
      <p>© <?= date("Y"); ?> <?= $nama; ?> | CV Pribadi</p>
    </footer>
  </div>

</body>
</html>
