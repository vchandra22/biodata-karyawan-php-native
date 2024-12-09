Berikut adalah instruksi lengkap untuk menjalankan aplikasi **Biodata Karyawan** baik di **Linux** maupun **Windows**, termasuk langkah ekstraksi file `biodata_karyawan.rar`, persiapan aplikasi, dan impor database dari file `lawancovid.sql`.

---

# **README - Aplikasi Biodata Karyawan**

Aplikasi ini adalah aplikasi berbasis PHP yang digunakan untuk mengelola data karyawan. Anda dapat mengikuti langkah-langkah di bawah ini untuk menjalankan aplikasi ini di sistem operasi **Linux** dan **Windows**.

---

## **Prasyarat**

Sebelum menjalankan aplikasi ini, pastikan Anda sudah menginstal **Apache**, **MySQL**, **PHP**, dan alat lainnya yang diperlukan.

### **1. Install Apache, MySQL, dan PHP di Linux (Ubuntu/Debian)**

Jika Anda belum menginstal Apache, MySQL, dan PHP, jalankan perintah berikut:

```bash
sudo apt update
sudo apt install apache2 mysql-server php php-mysqli libapache2-mod-php unzip
```

### **2. Install phpMyAdmin (Opsional)**

phpMyAdmin adalah alat berbasis web untuk mengelola database MySQL. Anda bisa menginstalnya dengan perintah berikut:

```bash
sudo apt install phpmyadmin
```

Pilih **Apache2** saat proses instalasi dan ikuti petunjuk untuk mengonfigurasi phpMyAdmin.

---

## **Langkah 1: Ekstrak File Aplikasi**

1. **Download File `biodata_karyawan.rar`**: Pertama, pastikan Anda sudah mendownload file `biodata_karyawan.rar` yang berisi aplikasi PHP ini.

2. **Ekstrak File `biodata_karyawan.rar`**: 
   Untuk mengekstrak file `.rar`, Anda perlu menginstal `unrar` di Linux:

   ```bash
   sudo apt install unrar
   ```

   Setelah itu, ekstrak file `.rar`:

   ```bash
   unrar x biodata_karyawan.rar
   ```

   Ini akan mengekstrak file-file ke dalam folder `biodata_karyawan`.

   **Di Windows**, Anda bisa menggunakan aplikasi seperti **WinRAR** atau **7-Zip** untuk mengekstrak file `biodata_karyawan.rar`.

---

## **Langkah 2: Menyiapkan Aplikasi di Apache**

### **Untuk Linux**

1. **Pindahkan Aplikasi ke Folder `htdocs`**:
   
   Apache biasanya menyimpan file website di folder `/var/www/html/`. Pindahkan folder `biodata_karyawan` ke dalam folder ini:

   ```bash
   sudo mv biodata_karyawan /var/www/html/
   ```

2. **Ubah Kepemilikan dan Izin Folder**:

   Pastikan Apache dapat mengakses dan menulis ke folder aplikasi:

   ```bash
   sudo chown -R www-data:www-data /var/www/html/biodata_karyawan
   sudo chmod -R 755 /var/www/html/biodata_karyawan
   ```

### **Untuk Windows**

1. **Install XAMPP**:
   Download dan install **XAMPP** (https://www.apachefriends.org/index.html), yang mencakup Apache, MySQL, dan PHP.

2. **Pindahkan Aplikasi ke Folder `htdocs`**:
   - Setelah menginstal XAMPP, buka folder instalasi XAMPP dan temukan folder `htdocs` (biasanya terletak di `C:\xampp\htdocs`).
   - Pindahkan folder `biodata_karyawan` yang telah diekstrak ke dalam folder `htdocs`.

3. **Set Permissions**:
   Di Windows, pastikan folder `biodata_karyawan` memiliki izin yang benar untuk diakses oleh Apache.

---

## **Langkah 3: Mengimpor Database**

1. **Masuk ke MySQL**:

   - **Linux**:
     Jalankan MySQL dan masuk ke MySQL shell:

     ```bash
     sudo mysql -u root -p
     ```

   - **Windows**:
     Buka **XAMPP Control Panel**, lalu klik **Shell** untuk membuka command prompt dan jalankan perintah berikut:

     ```bash
     mysql -u root -p
     ```

2. **Buat Database**:

   Buat database baru dengan nama `lawancovid`:

   ```sql
   CREATE DATABASE lawancovid;
   ```

3. **Pilih Database**:

   Pilih database yang baru dibuat:

   ```sql
   USE lawancovid;
   ```

4. **Impor File SQL**:

   Sekarang, impor file `lawancovid.sql` yang terdapat dalam folder aplikasi yang sudah diekstrak.

   - **Linux**:
     Jika file `lawancovid.sql` berada di dalam folder `/var/www/html/biodata_karyawan`, jalankan perintah berikut:

     ```bash
     source /var/www/html/biodata_karyawan/lawancovid.sql;
     ```

   - **Windows**:
     Anda dapat menggunakan **phpMyAdmin** (yang diinstal bersama XAMPP) untuk mengimpor file `lawancovid.sql`. Akses phpMyAdmin melalui browser di `http://localhost/phpmyadmin`, pilih database `lawancovid`, dan impor file SQL melalui antarmuka web.

---

## **Langkah 4: Menjalankan Aplikasi**

1. **Pastikan Apache dan MySQL Berjalan**:

   Periksa status Apache dan MySQL untuk memastikan keduanya berjalan dengan baik:

   - **Linux**:

     ```bash
     sudo systemctl status apache2
     sudo systemctl status mysql
     ```

     Jika salah satu tidak berjalan, Anda dapat memulai layanan dengan perintah:

     ```bash
     sudo systemctl start apache2
     sudo systemctl start mysql
     ```

   - **Windows**:
     Buka **XAMPP Control Panel**, lalu klik **Start** pada **Apache** dan **MySQL** untuk menjalankan kedua layanan.

2. **Akses Aplikasi di Browser**:

   Setelah database berhasil diimpor dan aplikasi sudah siap, buka browser dan ketikkan URL berikut untuk mengakses aplikasi:

   - **Linux**:  
     ```
     http://localhost/biodata_karyawan/public/index.php
     ```

   - **Windows**:  
     ```
     http://localhost/biodata_karyawan/public/index.php
     ```

---

## **Langkah 5: Penyelesaian Masalah**

Jika aplikasi tidak berjalan seperti yang diharapkan, berikut beberapa langkah yang dapat Anda lakukan:

1. **Periksa Izin Folder**:

   Pastikan aplikasi memiliki izin yang benar untuk diakses oleh Apache.

   - **Linux**:

     ```bash
     sudo chown -R www-data:www-data /var/www/html/biodata_karyawan
     sudo chmod -R 755 /var/www/html/biodata_karyawan
     ```

   - **Windows**: Pastikan folder `biodata_karyawan` memiliki izin yang benar di folder `htdocs`.

2. **Periksa Apache dan MySQL**:

   Pastikan kedua layanan berjalan dengan baik dan tidak ada masalah konfigurasi.

   - **Linux**: Periksa log error Apache dan MySQL:

     ```bash
     sudo tail -f /var/log/apache2/error.log
     sudo tail -f /var/log/mysql/error.log
     ```

   - **Windows**: Jika aplikasi tidak berjalan, periksa log di **XAMPP Control Panel** untuk melihat apakah ada error terkait.

3. **Cek Pengaturan Database**:

   Pastikan file `lawancovid.sql` sudah berhasil diimpor ke dalam database `lawancovid`. Anda dapat memeriksa tabel di phpMyAdmin atau dengan perintah berikut di MySQL:

   ```sql
   SHOW TABLES;
   ```

---

## **Penutupan**

Setelah mengikuti langkah-langkah di atas, aplikasi **Biodata Karyawan** seharusnya sudah dapat dijalankan di server lokal Anda, baik di Linux maupun Windows. Jika ada pertanyaan lebih lanjut, Anda dapat merujuk ke dokumentasi Apache, MySQL, atau PHP, atau membuka [dokumentasi phpMyAdmin](https://www.phpmyadmin.net/).

---