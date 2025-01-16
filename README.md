# Brand Identity Guidelines

Proyek ini dikembangkan selama masa magang di **Shafwah Group divisi Creative Marketing & Content Creator**. Website ini dibuat menggunakan **Laravel** sebagai framework backend dan **Tailwind CSS** untuk desain antarmuka.

## 🚀 Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal:

### Prasyarat

- **PHP** >= 8.1
- **Composer**
- **Web Server**

### Langkah Instalasi

1. **Clone repositori**:

   ```bash
   git clone https://github.com/mrizqiramadhani/design-guideline

   atau

   download zip https://github.com/mrizqiramadhani/design-guideline

   Ekstrak file ZIP ke folder server lokal Anda:

   XAMPP: \xampp\htdocs
   Laragon: \laragon\www
   ```

2. **Masuk ke direktori proyek**:

   ```bash
   cd design-guideline
   ```

3. **Install dependencies menggunakan Composer:**

   ```bash
   composer install
   ```

4. **Update dependencies**:

   ```bash
   composer update
   ```

5. **Salin file konfigurasi .env.example menjadi .env**:

   ```bash
   cp .env.example .env
   ```

6. **Edit konfigurasi database** di file `.env`:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=project-magang (sesuaikan dengan database anda)
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Jalankan application key**:

   ```bash
   php artisan key:generate
   ```

8. **Jalankan untuk membuat symbolic link antara folder storage dan public**:

   ```bash
   php artisan storage:link
   ```

9. **Jalankan migrasi database**:

   ```bash
   php artisan migrate
   ```

10. **Tambahkan data awal dengan seeder**:

    ```bash
    php artisan db:seed --class=AdminSeeder
    php artisan db:seed --class=UnitSeeder
    ```

    **Username**: `admin@demo.com`  
    **Password**: `admin12345`

11. **Jalankan Server Lokal**.

    ```
    php artisan serve
    ```

12. **Sistem siap digunakan**.

    Akses halaman di:

    ```
    http://localhost:8000
    ```

---

## 🎨 Teknologi yang Digunakan

- **Backend**: Laravel
- **Frontend**: Tailwind CSS
- **Database**: MySQL
- **Tools**: Composer, Git

---

# 👥 Tim Pengembang

| Nama                     | Role                 |     |
| ------------------------ | -------------------- | --- |
| Muhammad Rizqi Ramadhani | front-end & back-end |     |
| Muhammad Rayyan          | front-end & back-end |     |

## 🌟 Credit readme

makasih template readMe nya wak 😂

### Muhammad Ganang Ramadhan

[![Instagram](https://img.shields.io/badge/Instagram-%23E4405F.svg?logo=Instagram&logoColor=white)](https://instagram.com/username)  
[![LinkedIn](https://img.shields.io/badge/LinkedIn-%230077B5.svg?style=flat&logo=linkedin&logoColor=white)](https://linkedin.com/in/username)  
[![GitHub](https://img.shields.io/badge/GitHub-%23121011.svg?logo=github&logoColor=white)](https://github.com/pawpawly)

### Muhammad Mashaan Navarin

[![Instagram](https://img.shields.io/badge/Instagram-%23E4405F.svg?logo=Instagram&logoColor=white)](https://instagram.com/username)  
[![LinkedIn](https://img.shields.io/badge/LinkedIn-%230077B5.svg?style=flat&logo=linkedin&logoColor=white)](https://linkedin.com/in/username)  
[![GitHub](https://img.shields.io/badge/GitHub-%23121011.svg?logo=github&logoColor=white)](https://github.com/RinnHehe) |
