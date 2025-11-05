# 💰 E-Ling Backend API

Backend REST API untuk aplikasi **E-Ling (Easy Financial Tracking)** — sistem pencatatan pemasukan dan pengeluaran harian berbasis mobile.  
Dibangun menggunakan **PHP Native + MySQL**, dengan format pertukaran data **JSON**.

---

## 🧠 Deskripsi Singkat
E-Ling membantu pengguna mengelola keuangan pribadi dengan mencatat **pemasukan dan pengeluaran** dalam satu sistem transaksi.  
Aplikasi ini juga menampilkan **saldo terkini**, serta **laporan bulanan dan tahunan**.  
Terdapat fitur **profil pengguna** dan **autentikasi (login/register)**.

---

## ⚙️ Teknologi yang Digunakan
- **Backend:** PHP 8.x
- **Database:** MySQL (via XAMPP)
- **Format API:** JSON
- **Metode Akses:** `POST` & `GET`

---

## 📁 Struktur Folder


```
Eling-Backend/
│
├── config/
│ └── koneksi.php
│
├── auth/
│ ├── register.php
│ └── login.php
│
├── profil/
│ ├── getProfile.php
│ ├── updateProfile.php
│ └── uploadFoto.php
│
├── transaksi/
│ ├── tambahTransaksi.php
│ ├── getSaldo.php
│ ├── getLaporanBulanan.php
│ └── getLaporanTahunan.php
│
├── uploads/
│
├── eling.sql
├── .gitignore
└── README.md
```

---


---

## 🗄️ Struktur Database

### 1. `users`
| Kolom | Tipe | Keterangan |
|-------|------|-------------|
| id_user | INT (PK, AI) | ID pengguna |
| nama | VARCHAR(100) | Nama lengkap |
| email | VARCHAR(100) | Email unik |
| password | VARCHAR(255) | Password terenkripsi |

### 2. `profil`
| Kolom | Tipe | Keterangan |
|--------|------|-------------|
| id_profil | INT (PK, AI) | ID profil |
| id_user | INT | Relasi ke tabel `users` |
| no_hp | VARCHAR(20) | Nomor HP |
| alamat | TEXT | Alamat pengguna |
| foto | VARCHAR(255) | Nama file foto profil |

### 3. `transaksi`
| Kolom | Tipe | Keterangan |
|--------|------|-------------|
| id_transaksi | INT (PK, AI) | ID transaksi |
| id_user | INT | Relasi ke user |
| jenis | ENUM('pemasukan','pengeluaran') | Jenis transaksi |
| kategori | VARCHAR(100) | Jenis transaksi (contoh: Gaji, Makan, Transportasi) |
| nominal | DECIMAL(12,2) | Jumlah uang |
| keterangan | TEXT | Deskripsi transaksi |
| tanggal | DATETIME | Waktu transaksi |

---

## 🚀 Cara Menjalankan Backend

1. Clone repository:
   ```bash
   git clone https://github.com/dimasadriansah/E_link-backend.git
   ```
2. Simpan folder ke:
   ```
   C:\xampp\htdocs\Eling-Backend
   ```
3. Import file **eling.sql** ke phpMyAdmin.
4. Jalankan **Apache** & **MySQL** di XAMPP.
5. Uji API di browser atau Postman.

---

## 🔐 API Endpoint Documentation

### Auth
- `POST /auth/register.php`
- `POST /auth/login.php`

### Profil
- `GET /profil/getProfile.php?id_user=1`
- `POST /profil/updateProfile.php`
- `post /profil/uploadFot.php`

### Transaksi
- `POST /transaksi/tambahTransaksi.php`
- `GET /transaksi/getSaldo.php?id_user=1`
- `GET /transaksi/getLaporanBulanan.php?id_user=1&bulan=11&tahun=2025`
- `GET /transaksi/getLaporanTahunan.php?id_user=1&tahun=2025`


---

## 👨‍💻 Pengembang
**Nama:** Dimas (dan tim)  
**Proyek:** E-Ling — Aplikasi Manajemen Keuangan  
**Tahun:** 2025
