<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Risma Agustin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $nama = "Risma Agustin";
        $ttl = "Malang, 10 Mei 2005";
        $alamat = "Jl. Melati No. 45, Malang";
        $email = "riris.agustin@example.com";
        $telepon = "+62 812 3456 7890";
        $tentang = "Saya adalah siswi yang antusias dalam bidang desain web dan multimedia. Saya senang belajar hal baru, berkreasi dengan teknologi, dan mengembangkan ide menarik untuk tampilan digital.";
    ?>

    <div class="container">
        <div class="card">
            <div class="foto">
                <img src="risma.jpg" alt="Foto Riris">
            </div>
            <h1><?php echo $nama; ?></h1>
            <p class="title">Web Designer & Student</p>

            <div class="info">
                <p><strong>Tempat, Tanggal Lahir:</strong> <?php echo $ttl; ?></p>
                <p><strong>Alamat:</strong> <?php echo $alamat; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Telepon:</strong> <?php echo $telepon; ?></p>
            </div>

            <div class="tentang">
                <h2>Tentang Saya</h2>
                <p><?php echo $tentang; ?></p>
            </div>

            <div class="skills">
                <h2>Keahlian</h2>
                <ul>
                    <li>HTML, CSS, PHP</li>
                    <li>Canva & Figma</li>
                    <li>Desain UI/UX</li>
                    <li>Fotografi & Editing</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>