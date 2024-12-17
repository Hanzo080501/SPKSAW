# SPK SAW - Rekomendasi Mobil Listrik 🚗⚡

![SPK SAW Logo](https://img.icons8.com/ios/452/electric-car.png)

Sistem Pendukung Keputusan (SPK) menggunakan metode **Simple Additive Weighting (SAW)** untuk memberikan rekomendasi mobil listrik terbaik berdasarkan kriteria yang dimasukkan oleh pengguna. Backend aplikasi dibangun dengan **Laravel 11** dan frontend menggunakan **React.js 18**.

Aplikasi ini memungkinkan pengguna untuk memilih berbagai mobil listrik berdasarkan beberapa faktor seperti harga, jarak tempuh, kecepatan maksimum, dan lainnya. SPK SAW menghitung skor untuk setiap mobil dan memberikan rekomendasi terbaik.

---

## 🔧 Fitur Utama

- **Rekomendasi Mobil Listrik**: Menggunakan algoritma SAW untuk memberikan rekomendasi mobil listrik terbaik berdasarkan input pengguna.
- **Backend dengan Laravel 11**: Menangani logika bisnis, API, dan database.
- **Frontend dengan React.js 18**: Menampilkan daftar mobil listrik dengan interaksi dinamis dan responsif.
- **CRUD Data Mobil**: Admin dapat menambah, mengubah, atau menghapus data mobil listrik.
- **Pengguna Dapat Menginput Kriteria**: Pengguna dapat memilih kriteria yang ingin digunakan untuk mendapatkan rekomendasi mobil listrik.

---

## 🚀 Cara Menggunakan Aplikasi

### 1. **Clone Repository**

Clone repository ini ke komputer lokal Anda dengan perintah berikut:

```bash
git clone https://github.com/username/spk-saw-rekomendasi-mobil-listrik.git
```

### 2. **Setup Backend (Laravel 11)**

- **Instalasi Laravel 11:**

  Pindah ke direktori backend aplikasi, lalu jalankan perintah untuk menginstal dependensi:

  ```bash
  cd spk-saw-rekomendasi-mobil-listrik/backend
  composer install
  ```

- **Konfigurasi Environment:**

  Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database dan layanan lain yang dibutuhkan:

  ```bash
  cp .env.example .env
  ```

  Setelah itu, buat database dan atur pengaturan `.env` seperti berikut:

  ```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=nama_database
  DB_USERNAME=root
  DB_PASSWORD=
  ```

- **Jalankan Migrasi Database:**

  Setelah konfigurasi selesai, jalankan migrasi database untuk membuat tabel yang diperlukan:

  ```bash
  php artisan migrate
  ```

- **Menjalankan Backend:**

  Untuk menjalankan server Laravel, gunakan perintah berikut:

  ```bash
  php artisan serve
  ```

  Backend akan berjalan di `http://localhost:8000`.

### 3. **Setup Frontend (React.js 18)**

- **Instalasi Dependensi Frontend:**

  Pindah ke direktori frontend, lalu jalankan perintah untuk menginstal dependensi menggunakan npm atau yarn:

  ```bash
  cd spk-saw-rekomendasi-mobil-listrik/frontend
  npm install
  ```

  Atau jika Anda menggunakan `yarn`:

  ```bash
  yarn install
  ```

- **Jalankan Frontend:**

  Setelah instalasi selesai, jalankan aplikasi React:

  ```bash
  npm start
  ```

  Frontend akan berjalan di `http://localhost:3000`.

### 4. **Mengakses Aplikasi**

Setelah mengikuti langkah-langkah di atas, Anda bisa mengakses aplikasi di browser:

- **Frontend**: [http://localhost:3000](http://localhost:3000)
- **Backend API**: [http://localhost:8000](http://localhost:8000)

---

## 🛠 Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: React.js 18
- **Database**: MySQL (atau database lain sesuai konfigurasi)
- **API**: RESTful API
- **Metode SPK**: Simple Additive Weighting (SAW)
- **UI/UX**: Tailwind CSS untuk styling yang responsif

---

## 📄 Struktur Folder

```plaintext
spk-saw-rekomendasi-mobil-listrik/
├── backend/                  # Laravel backend
│   ├── app/                  # Logic aplikasi
│   ├── config/               # Konfigurasi Laravel
│   ├── database/             # Migrasi dan seeders
│   └── routes/               # Definisi API
├── frontend/                 # React frontend
│   ├── src/                  # Sumber kode React
│   └── public/               # File statis
├── .env                      # File konfigurasi environment
└── README.md                 # Dokumentasi
```

---

## 📚 Dokumentasi API

- **GET `/api/mobil`**: Mendapatkan daftar semua mobil listrik.
- **GET `/api/mobil/{id}`**: Mendapatkan detail mobil listrik berdasarkan ID.
- **POST `/api/rekomendasi`**: Mengirimkan data kriteria pengguna dan mendapatkan rekomendasi mobil listrik.

---

## 💬 Kontribusi

Jika Anda tertarik untuk berkontribusi pada proyek ini, silakan lakukan fork dan kirimkan pull request. Semua kontribusi yang membangun dan bermanfaat sangat diterima!

---

## 📝 Lisensi

Aplikasi ini dilisensikan di bawah **MIT License**. Lihat file [LICENSE](LICENSE) untuk informasi lebih lanjut.
