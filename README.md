![Visitors](https://visitor-badge.laobi.icu/badge?page_id=hendragunadie.Buku-Tamu-Laravel)

# 📖 Buku Tamu (Laravel + Tailwind)

Website **Buku Tamu** berbasis Laravel dengan fitur webcam foto tamu, registrasi & login via email verifikasi, reset password lewat email, dan export data tamu ke PDF. 

✨ **Fitur utama**:
- Foto tamu via Webcam
- Registrasi + verifikasi email
- Reset password lewat email
- Export data tamu ke PDF
- Dashboard Modern


## 📸 Preview

**Form Tamu**
![Form Tamu](docs/form-tamu.png)


**Dashoard**
![Dashboard](docs/dashboard.png)


**Daftar Tamu**
![Daftar Tamu](docs/daftar-tamu.png)


## ⚙️ Requirements
- PHP >= 8.1
- Composer
- Node.js & NPM 
- Database:
  - SQLite (default)
  - MySQL/PostgreSQL (opsional, jika ingin scale up)

## 🚀 Installation

1. **Clone repository**
   ```bash
   git clone https://github.com/HendraGunadie/Buku-Tamu-Laravel.git
   cd Buku-Tamu-Laravel

2. **Install dependencies PHP**
   ```bash
   composer install

3. **Install dependencies JS (Tailwind + Vite)**
   ```bash
   npm install
   ```

   ```bash
   npm run dev

4. **Copy file .env**
    ```bash
    cp .env.example .env

5. **Generate app key**
    ```bash 
    php artisan key:generate

6. **Jalankan migrasi**
   ```bash 
    php artisan migration

7. **Jalankan server**
   ```bash
   php artisan serve

8. **Akses Aplikasi**
   ```bash
    Server running on [http://127.0.0.1:8000].


## 🔧 Setup Project

Setelah berhasil meng-clone repository dan meng-install dependencies, lakukan setup berikut:

## Buat App Password Agar verify email dan reset password berfungsi
1. Aktifkan 2-Step Verification (2FA)
- Masuk ke
  ```bash
  https://myaccount.google.com/security
- Aktifkan 2-Step Verification (pakai SMS atau Google Authenticator).

2. Buat App Password
- Masuk ke 
    ```bash
    https://myaccount.google.com/apppasswords



    
**Buat kata sandi aplikasi**
![Buat Sandi](docs/buat-sandi-app.png)

**Nanti akan dapat sandi 16 digit**
![Kata Sandi](docs/buat-sandi-app.png)

**Isi .env seperti ini**
![env email](docs/env-email.png)



