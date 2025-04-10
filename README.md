# 🎬 PHP Film Project

Sebuah aplikasi sederhana berbasis PHP Native untuk mengelola data film. Project ini mendukung fitur seperti tambah, edit, dan hapus data film serta melakukan validasi input dan pencatatan log aktivitas.

---

## 📁 Struktur Folder

projectphp/
├── auth/ # Folder untuk halaman autentikasi
│ ├── login.php # Halaman login pengguna
│ └── register.php # Halaman registrasi pengguna
│
├── config/ # Folder untuk konfigurasi sistem
│ └── db.php # Konfigurasi koneksi ke database
│
├── functions/ # Folder untuk fungsi-fungsi pembantu (helper)
│ ├── auth.php # Fungsi terkait autentikasi
│ ├── check.php # Fungsi validasi input
│ ├── film.php # Fungsi untuk manajemen data film
│ └── logger.php # Fungsi logging aktivitas ke file
│
├── logs/ # Folder untuk menyimpan file log
│ └── app.log # File log utama aplikasi
│
├── pages/ # Folder untuk halaman utama CRUD film
│ ├── add.php # Halaman untuk menambah data film
│ ├── delete.php # Halaman untuk menghapus data film
│ ├── edit.php # Halaman untuk mengedit data film
│ └── index.php # Halaman utama yang menampilkan daftar film
│
├── index.php # Entry point utama aplikasi
└── README.md # Dokumentasi proyek

---

## ⚙️ Fitur

- Tambah data film
- Edit dan hapus data film
- Validasi input (panjang karakter, format angka, dll)
- Logging aktivitas ke file `.log`
- Struktur kode terpisah agar modular dan mudah di-maintain

---

## 🛠️ Instalasi

1. Pastikan kamu sudah menginstall [XAMPP](https://www.apachefriends.org/index.html)
2. Clone repository ini ke folder `htdocs`
   ```bash
   git clone https://github.com/username/php-project-film.git
   ```
3. Jalankan Apache & MySQL di XAMPP
4. Import database dari file SQL (jika ada)
5. Akses di browser: http://localhost/projectphp/

## 🧠 Catatan Pengembangan

- Semua validasi input dilakukan di functions/check.php
- Logger dapat ditemukan di functions/logger.php
- Log disimpan di logs/app.log dan mencatat level (INFO, WARNING, ERROR)
- Semua interaksi database melalui film.php (untuk modul film)

## 🙋‍♂️ Kontribusi

Pull request sangat diterima! Jika kamu punya ide atau perbaikan, silakan fork repo dan buat perubahanmu 😄
