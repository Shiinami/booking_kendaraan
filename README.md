# Aplikasi Booking Kendaraan

Aplikasi web untuk monitoring dan pemesanan kendaraan perusahaan tambang, mencakup fitur pemesanan oleh admin, persetujuan berjenjang (multi-level approval), serta pelaporan konsumsi BBM dan riwayat pemakaian.

Dibuat sebagai penyelesaian **Technical Test Fullstack Developer (Intern)**.

## 📋 Spesifikasi Teknis (Requirements)

Sesuai instruksi dokumen soal, aplikasi ini dibangun menggunakan:

-   **Framework:** Laravel 12.0
-   **PHP Version:** >= 8.2
-   **Database:** SQlite
-   **Frontend:** Blade Templates (HTML5 Native, No External CSS Framework dependency)

## 🚀 Cara Instalasi (Installation)

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di komputer lokal:

1.  **Clone Repository** dengan command "git clone https://github.com/Shiinami/booking_kendaraan.git"
2.  **Install Dependencies:**
    "composer install"
3.  **Setup Environment:**
    -   Copy file `.env.example` menjadi `.env`.
4.  **Generate Key:**
    "php artisan key:generate"

5.  **Migrasi & Seeding Data (PENTING):**
    Langkah ini akan membuat tabel dan mengisi akun Admin/Approver secara otomatis.
    "php artisan migrate:fresh --seed"

6.  **Jalankan Server:**
    "php artisan serve"

7.  Buka browser dan akses: `http://127.0.0.1:8000`

---

## 🔑 Daftar Akun Login (Credentials)

Gunakan akun-akun berikut untuk menguji alur aplikasi sesuai role masing-masing:

| Role           | Nama User     | Email               | Password   | Fungsi Utama                                   |
| :------------- | :------------ | :------------------ | :--------- | :--------------------------------------------- |
| **Admin**      | Admin         | `admin@kosiwa.com`  | `password` | Input Pesanan, Export Excel, Input Laporan BBM |
| **Approver 1** | Manager       | `ardhan@kosiwa.com` | `password` | Menyetujui Pesanan Level 1                     |
| **Approver 2** | Kepala Cabang | `amir@kosiwa.com`   | `password` | Menyetujui Pesanan Level 2 (Final)             |

---

## 📖 Panduan Penggunaan (User Guide)

Berikut adalah alur kerja (workflow) untuk menguji fitur aplikasi:

### 1. Membuat Pesanan (Role: Admin)

1.  Login sebagai **Admin** (`admin@kosiwa.com`).
2.  Masuk ke menu **"Buat Pesanan Baru"** di Dashboard atau menu navigasi.
3.  Pilih Kendaraan dan Driver.
4.  **Penting:** Pilih pihak penyetuju.
    -   _Penyetuju Level 1:_ Pilih "Manager Ops".
    -   _Penyetuju Level 2:_ Pilih "Kepala Cabang".
5.  Klik Simpan. Status pemesanan akan menjadi **Pending**.

### 2. Proses Persetujuan Level 1 (Role: Approver)

1.  Logout Admin, lalu Login sebagai **Manager** (`ardhan@kosiwa.com`).
2.  Di Dashboard, klik tombol **"Cek Permintaan Masuk"**.
3.  Anda akan melihat pesanan baru. Klik **Setujui** (Approve).
4.  Status Level 1 berubah menjadi Approved, namun status global masih menunggu Level 2.

### 3. Proses Persetujuan Level 2 (Role: Approver)

1.  Logout Manager, lalu Login sebagai **Kepala Cabang** (`amir@kosiwa.com`).
2.  Masuk ke menu Persetujuan.
3.  Klik **Setujui**.
4.  Karena ini level terakhir, status global pemesanan berubah menjadi **APPROVED**.

### 4. Penyelesaian & Laporan (Role: Admin)

1.  Login kembali sebagai **Admin**.
2.  Cek Dashboard, grafik pemakaian kendaraan akan terupdate (jika pesanan sudah selesai).
3.  Masuk menu "Kelola Semua Data".
4.  Pada pesanan yang statusnya _Approved_, Admin bisa mengisi form **"Selesaikan / Input BBM"** untuk mencatat konsumsi bahan bakar dan kilometer.
5.  Klik tombol **"Export Excel"** untuk mengunduh laporan periodik.

_Technical Test Submission - PT. Sekawan Media Informatika_
