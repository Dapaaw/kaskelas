# Sistem Kas Kelas - Aplikasi Web Pengelolaan Keuangan Kelas

Selamat datang di **Sistem Kas Kelas**! 🎓💰 Aplikasi web sederhana namun powerful yang dirancang khusus untuk membantu mengelola keuangan kelas dengan mudah dan efisien. Dari pendaftaran anggota hingga laporan saldo, semua bisa dilakukan dalam satu platform yang user-friendly.

## ✨ Fitur Utama
- **Dashboard Admin**: Pantau ringkasan data kelas, anggota, dan saldo kas dalam satu tampilan.
- **Manajemen Anggota**: Tambah, edit, hapus, dan lihat data anggota kelas dengan mudah.
- **Pembayaran Kas**: Catat pembayaran, lihat riwayat, dan pantau siapa yang belum bayar.
- **Laporan & Cetak**: Generate laporan saldo dan cetak untuk keperluan administrasi.
- **Autentikasi Aman**: Sistem login/logout untuk admin (bendahara) dan member.
- **Responsive Design**: Tampilan yang menarik dan mudah digunakan di berbagai perangkat.

## 🛠️ Teknologi yang Digunakan
- **Backend**: PHP (untuk logika server-side)
- **Frontend**: HTML, CSS (untuk tampilan dan styling)
- **Database**: MySQL (untuk penyimpanan data)
- **Server**: Kompatibel dengan Apache, Nginx, atau server web lainnya yang mendukung PHP

## 📁 Struktur Proyek
Berikut adalah gambaran lengkap struktur file dan folder dalam proyek ini, beserta penjelasan singkat untuk setiap bagian:

### File Utama
- `index.html`: Halaman landing page utama aplikasi – titik masuk pertama pengguna.
- `kas_kelas.sql`: Script SQL untuk setup database awal, termasuk tabel-tabel seperti anggota, pembayaran, dan transaksi.

### Folder `admin/`
Panel kontrol untuk administrator (bendahara kelas). Semua fitur manajemen ada di sini.
- `dashboard.php`: Halaman utama admin dengan statistik dan navigasi cepat.
- `data_anggota.php`: Daftar semua anggota, dengan opsi edit/hapus.
- `edit_anggota.php`: Form edit data anggota (nama, kelas, kontak).
- `hapus_anggota.php`: Handler untuk menghapus anggota dari sistem.
- `input_anggota.php`: Formulir pendaftaran anggota baru.
- `pengaturan.php`: Halaman konfigurasi sistem (misalnya, pengaturan umum).

### Folder `assets/`
Tempat menyimpan file statis untuk tampilan aplikasi.
- `style.css`: Stylesheet utama yang membuat aplikasi terlihat menarik dan konsisten.

### Folder `auth/`
Menangani semua aspek autentikasi pengguna – aman dan sederhana.
- `login.php`: Halaman login untuk admin dan member.
- `logout.php`: Script logout yang membersihkan sesi pengguna.
- `proses_login.php`: Backend processing untuk verifikasi login.
- `register_bendahara.php`: Registrasi khusus untuk bendahara (admin pertama).

### Folder `config/`
Konfigurasi dasar aplikasi – jangan lupa sesuaikan ini!
- `koneksi.php`: File koneksi database MySQL. Edit host, username, password, dan nama DB di sini.

### Folder `member/`
Fitur khusus untuk anggota kelas yang sudah login.
- `data_pembayaran.php`: Lihat status pembayaran kas pribadi.
- `riwayat.php`: Riwayat lengkap semua transaksi pembayaran.
- `tambah_pembayaran.php`: Form untuk menambah pembayaran kas baru.
- `tambah_transaksi.php`: Form untuk transaksi lainnya (misalnya, pengeluaran kelas).

### Folder `payment/`
Fokus pada monitoring pembayaran kas.
- `belum_bayar.php`: Daftar anggota yang masih punya tunggakan – mudah dilacak!

### Folder `reports/`
Untuk generate dan cetak laporan keuangan.
- `cetak_laporan_saldo.php`: Script untuk mencetak laporan saldo kas.
- `laporan_saldo.html`: Template HTML untuk preview laporan sebelum cetak.

## 🚀 Instalasi Cepat
Ikuti langkah-langkah ini untuk menjalankan aplikasi di lokal:

1. **Persiapan Sistem**:
   - Install XAMPP, WAMP, atau LAMP stack.
   - Pastikan PHP dan MySQL aktif.

2. **Clone/Download Proyek**:
   - Salin semua file ke folder `htdocs` (XAMPP) atau root server web Anda.

3. **Setup Database**:
   - Buka phpMyAdmin atau MySQL client.
   - Buat database baru (misalnya: `kas_kelas`).
   - Import file `kas_kelas.sql` ke database tersebut.

4. **Konfigurasi**:
   - Edit `config/koneksi.php` dengan detail database Anda (host: localhost, user: root, password: kosong, db: kas_kelas).

5. **Jalankan**:
   - Akses `http://localhost/index.html` di browser.
   - Daftar sebagai bendahara via `auth/register_bendahara.php`.
   - Login dan mulai explore fitur!

## 📖 Cara Penggunaan
- **Sebagai Admin/Bendahara**: Login untuk manage anggota, lihat laporan, dan atur sistem.
- **Sebagai Member**: Login untuk cek pembayaran dan tambah transaksi.
- Navigasi intuitif – klik menu untuk pindah antar halaman.
- Untuk laporan, gunakan folder `reports/` untuk cetak atau export.

## 🤝 Kontribusi
Ingin improve aplikasi ini? Fork repo, buat branch baru, dan submit pull request. Semua kontribusi welcome! 😊

## 📄 Lisensi
Proyek ini open-source di bawah lisensi MIT. Bebas digunakan dan dimodifikasi.

## 📞 Kontak & Dukungan
Ada pertanyaan atau bug? Buat issue di repo atau email pengembang. Mari kita buat sistem kas kelas yang lebih baik bersama!

---

*Dibuat dengan ❤️ untuk memudahkan pengelolaan kas kelas. Semoga bermanfaat!* 🌟