# Tera Codeigniter 4

## Apa itu Tera?

Tera adalah sebuah aplikasi untuk pendaftaran, pembayaran, dan pengujian Alat UTTP di Dinperindag.

## Fitur Super Admin

- Mengelola Admin
- Mengelola User
- Mengelola Aparatur
- Mengelola Data Master

## Fitur Petugas Pendaftaran

- Pendaftaran Tera Kantor / Luar Kantor
- Melihat riwayat pendaftaran Tera Kantor / Luar Kantor dan Tempat Pakai
- Pengajuan Tera Tempat Pakai

## Fitur Bendahara Penerimaan Pembantu

- Pembayaran Retribusi Tera Kantor / Luar Kantor dan Tempat Pakai
- SKRD
- SSRD
- SKRDKB
- SKRDLB
- Keringanan

## Fitur Pegawai Yang Berhak

- Pengujian Jenis UTTP Tera yang sudah lunas / keringanan retribusi
- Cetak Berita Acara
- Cetak Hasil Pengujian 1
- Cetak Hasil Pengujian 2
- Cetak Hasil Pengujian 3

## Fitur Petugas Loket

- Riwayat Pengujian Jenis UTTP Tera yang sudah lunas / keringanan retribusi
- Cetak Hasil Pengujian 1
- Cetak Hasil Pengujian 2
- Cetak Hasil Pengujian 3

## Kebutuhan Server

PHP versi 7.2 atau lebih tinggi, dengan extension yang sudah diinstall atau diaktifkan:

- [intl](http://php.net/manual/en/intl.requirements.php)
- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

Database defaultnya adalah PostgreSql, namun anda juga bisa mengubahnya ke Mysql, untuk lebih jelas silahkan lihat cara instalasinya

## Instalasi

1. Download repositori ini dan taruh di htdocs(Xampp) atau www (Laragon) atau webserver yang lain.
2. Silahkan buka di vscode atau text editor yang lain
3. untuk vs code silahkan klik ctrl+` (\`` diatas key tab).
4. di terminal ketikkan _composer install_ untuk menginstall codeigniter 4 ke projek.
5. rename file env menjadi .env dan ubah sesuai kebutuhan, untuk cara mengubahnya silahkan cari di google
6. setelah disetting silahkan gunakkan perintah _php spark migrate:refresh_ untuk membuat table ke databasenya, dan _php spark db:seed InitSeeder_ untuk memasukkan data awal ke table yang telah dibuat
7. selesai

## Akun

1. Akun Superadmin

- Username: superadmin
- Password: 123456

2. Akun Petugas Pendaftaran

- Username: 19681124 199603 1 006
- Password: 123456

3. Akun Bendahara Penerimaan Pembantu

- Username: 19681122 199603 1 006
- Password: 123456

4. Akun Pegawai Yang Berhak

- Username: 19681123 199603 1 006
- Password: 123456

5. Akun Petugas Loket

- Username: 19681125 199603 1 006
- Password: 123456

# Lisensi

Cek link ini untuk melihat lisensi Codeigniter [Lisensi Codeigniter 4](https://github.com/codeigniter4/CodeIgniter4).

# Resources

- [Codeigniter User Guide](https://codeigniter.com/docs)

Laporkan isu keamanan ke [Email kerentanan aplikasi](mailto:herayafpm@gmail.com)
Terima kasih.
