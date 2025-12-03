# 💻 LAPORAN PROYEK: PENGEMBANGAN WEB SERVER DAN APLIKASI SEDERHANA

**Proyek:** Pembangunan Web Server OLS

Proyek ini dibuat untuk memenuhi tugas mata pelajaran **Administrasi Sistem Jaringan (ASJ)**, yang merupakan salah satu elemen Capaian Pembelajaran Konsentrasi Keahlian Teknik Komputer dan Jaringan (**CP KKTKJ**) pada program TJKT. Proyek ini berfokus pada implementasi layanan Web Server, konfigurasi PHP, dan pengamanan koneksi menggunakan SSL/HTTPS.

**Kenapa kita membuat web server OLS?**
karena OLS sendiri punya kelebihan yaitu 
Cepat
Ringan
Ada cache bawaan
Gratis & open-source
Mudah dikonfigurasi

namun ada juga kekurangan nya yaitu
.htaccess tidak real-time
Modul sedikit
Dokumentasi kurang lengkap
Kadang membingungkan pemula

---

### 1. 👥 Informasi Kelompok dan Spesifikasi Lingkungan Praktik

#### 1.1. Informasi Kelompok

| Peran | Nama Lengkap | Kelas |
| :--- | :--- | :--- |
| **Ketua Kelompok** | Moch.Bagja Alif S | XI TJKT 2 |
| Anggota 1 | Kirania Santana | XI TJKT 2 |
| Anggota 2 | Risma Agustin | XI TJKT 2 |
| **Nama Sekolah/Institusi** | SMKN 1 SOREANG | |

#### 1.2. Spesifikasi Alat dan Bahan (Host) 🛠️

| Komponen | Deskripsi / Versi |
| :--- | :--- |
| **Virtualisasi** | VMware Workstation 17 Pro |
| **Sistem Operasi Host** | Windows 11 Home |
| **RAM Host** | 4 GB |
| **CPU Host** | AMD A4-9125 RADEON R3 |

#### 1.3. Spesifikasi Server Virtual (VM) 🖥️

| Spesifikasi | Detail |
| :--- | :--- |
| **Sistem Operasi Tamu (Guest OS)** | Debian Trixie (13.x) |
| **Alamat IP Server** | `192.168.10.53` |
| **RAM VM** | RAM:2GB |
| **vCPU** | 2 Core|
| **Web Server yang Dipilih** | **OpenLiteSpeed** |
| **Versi PHP yang Dipakai** | **lsphp** |

---

### 2. 📝 Dokumentasi Teknis dan Langkah-Langkah Pengerjaan

#### 2.1. Persiapan Dasar (Debian Trixie di VMware)

1.  Melakukan *update* dan *upgrade* sistem.
    ```bash
    apt update && apt upgrade 
    ```
2.  Memastikan konfigurasi jaringan (Bridge/NAT/Host-Only) sudah benar.

#### 2.2. Instalasi dan Konfigurasi Web Server 🌐

Kami menggunakan **OLS**. Berikut langkah-langkah utamanya:

***Tambahkan repository OpenLiteSpeed:**
```bash
wget -O - https://repo.litespeed.sh | bash
```
* **Instalasi:**
    ```bash
    apt install openlitespeed
    ```
  **Install PHP 8.4 + modul MySQL:**
```bash
apt install lsphp84 lsphp84-mysql
```
Start dan aktifkan service:
```bash
systemctl start lsws
systemctl enable lsws
```

## Set Password Panel Admin 🔑
OpenLiteSpeed dikonfigurasi lewat browser, jadi kita perlu membuat akun agar bisa masuk ke panel pengaturannya. Berikut langkah-langkah yang perlu kamu ikuti:

Jalankan script yang sudah disediakan:
```bash
/usr/local/lsws/admin/misc/admpass.sh
```
Masukkan username (misal: admin)
Buat password → konfirmasi
Buka browser: http://ip-server:7080

## Test Website Default 🌐
Nah, sekarang kita cek apakah OpenLiteSpeed sudah aktif dan bisa diakses. Yuk, kita uji dengan membuka halaman default-nya! 🚀

Buka Web Browser → http://ip-server:8088
Jika muncul halaman default → berhasil

   ## Mengatur Versi PHP
## Atur External App

Pastikah lsphp84 sudah terinstal, untuk merubahnya ikuti tahapan beriku:
Di menu kiri pilih: Server Configuration → External App
Klik Add → pilih LiteSpeed SAPI App → Next
Isi:
Name: lsphp84
Address: uds://tmp/lshttpd/lsphp.sock
Notes: PHP 8.4
Max Connections: 35
Initial Request Timeout: 60
Retry Timeout: 0
Persistent Connection: Yes
Command: /usr/local/lsws/lsphp84/bin/lsphp
Instances: 1 (default)

**Save → Graceful Restart**

## Atur Script Handler

Masih di menu kiri: Server Configuration → Script Handler
Edit handler lsphp atau buat baru:
Suffixes: php
Handler Type: LiteSpeed SAPI
Handler Name: lsphp84

**Save → Graceful Restart**

## Ubah Port 8088 → 80 🔄
Secara default, OLS jalan di port 8088, sedangkan website pada umumnya pakai port 80 atau 443. Tenang aja, kita bisa ubah pengaturannya biar sama seperti web sungguhan! 🚀

Login ke panel admin (http://ip-server:7080)
Masuk ke Menu → Listeners → Default → Edit
Ganti Port: 80
Klik Save → Graceful Restart
Sekarang akses website di browser: 👉 http://ip-server

## Supaya index.php terbaca otomatis di OLS 📄
Biasanya, kita memakai file index.php sebagai halaman utama website. Tapi di OLS, secara default yang bisa dibaca hanya index.html. Supaya website kita bisa menjalankan file index.php, kita perlu menambahkan sedikit pengaturan tambahan.

Login ke admin panel: → http://ip-server:7080
Menu kiri → Virtual Hosts → Example → General
Cari bagian Index Files
Biasanya isinya: index.html
Ubah jadi: index.php, index.html
Artinya OLS akan mencari index.php dulu, kalau tidak ada baru index.html

**Klik Save**

## Membuat Self-Signed SSL 🔐
Supaya website kita bisa diakses lewat https, kita perlu menambahkan sertifikat SSL. Kali ini, kita akan membuat SSL self-signed, yaitu sertifikat buatan sendiri yang bisa digunakan untuk belajar atau pengujian di server lokal.

**Buat Sertifikat Self-Signed**
Mmasuk sebagai root, lalu ketik:
```bash
mkdir /etc/ssl/private
```
```bash
cd /etc/ssl/private
```
```bash
openssl req -x509 -newkey rsa:2048 -nodes -keyout self.key -out self.crt -days 365
```

Saat diminta mengisi data (Country, State, dst), boleh diisi asal atau tekan Enter saja.
Jika proses berjalan normal, kita akan memiliki dua buah file yaitu self.key dan self.crt yang tersimpan di /etc/ssl/private

## Menambahkan SSL/TSL di OLS

Login ke admin panel: → http://ip-server:7080
Masuk menu: Listeners → Add → +
Isi dengan:
Listener Name: SSL
IP Address: ANY
Port: 443
Secure: Yes
Pada bagian Virtual Host Mappings, Tambahkan:
Virtual Host: Example (atau nama virtual host kamu)
Domains: * (artinya semua domain/IP)
Save

Lalu pergi ke **Listener SSL > General

Pada tab SSL → isi:
Private Key File: /etc/ssl/private/self.key
Certificate File: /etc/ssl/private/self.crt

Save → **Graceful Restart**

* **Konfigurasi Virtual Host/Server Block:** [Jelaskan secara singkat penyesuaian konfigurasi yang Kalian lakukan pada file utama, misalnya penentuan Document Root dan port.]

---

### 3. 📊 Analisis Web Server

Berdasarkan pengalaman kami dalam proyek ini, berikut adalah analisis kelebihan dan kekurangan dari *Web Server* yang kami gunakan:

| Aspek | Kelebihan OLS 👍 | Kekurangan OLS 👎 |
| :--- | :--- | :--- |
| **Performa & Kecepatan** | Optimasi HTTP/3 & QUIC → loading lebih cepat terutama untuk mobile | Saat trafik sangat besar, butuh penyesuaian cache & worker agar stabil. |
| **Kemudahan Konfigurasi**| Banyak fitur siap pakai (SSL, cache, security rules) → tidak perlu banyak instalasi tambahan.] | Perubahan konfigurasi sering memerlukan restart (tidak semua setting live reload). |
| **Fitur & Modularitas** | Memiliki fitur lengkap bawaan seperti HTTP/3, SSL, anti-DDoS dasar, dan caching LiteSpeed | Ekosistem modul lebih sedikit dibanding Apache atau NGINX. |

---

### 4. 🧠 Refleksi Proyek: Kesan dan Kendala

#### 4.1. Kesan Selama Proses Pengerjaan ✨

[Tuliskan kesan anggota kelompok, misalnya: "Kami merasa mendapatkan banyak ilmu baru, terutama dalam praktik Version Control menggunakan Git dan GitHub yang belum pernah kami lakukan sebelumnya."]

#### 4.2. Kendala dan Solusi yang Diterapkan 💡

| Kendala yang Kalian Hadapi 🚧 | Solusi yang Ditemukan ✅ |
| :--- | :--- |
| [Tuliskan kendala teknis atau kolaborasi lain yang Kalian hadapi.] | [Jelaskan solusi spesifik Kalian.] |

---

### 5. 📂 Dokumentasi Konten Website

Seluruh *source code* (Halaman Utama dan Halaman Profil) yang berada di *document root* server telah disalin dan di-*commit* ke dalam folder `/html` di *repository* GitHub ini.

---

### 6. 🎬 Dokumentasi Video Pengerjaan

Seluruh proses pengerjaan telah direkam dan diunggah ke YouTube.

**Link Video YouTube:**

[![Thumbnail Video Pengerjaan](https://img.youtube.com/vi/1-qlNtQS1OA/0.jpg)](https://www.youtube.com/watch?v=1-qlNtQS1OA)

**PETUNJUK:** Ganti semua teks di dalam tanda kurung siku `[ ... ]` dengan informasi proyek yang relevan.
