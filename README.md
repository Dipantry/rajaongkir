# RajaOngkir API wrapper for PHP 8.0+
[![Latest Version](https://img.shields.io/github/v/release/dipantry/rajaongkir?label=Release&sort=semver&style=flat-square)](https://github.com/dipantry/rajaongkir/releases)
[![Packagist Version](https://img.shields.io/packagist/v/dipantry/rajaongkir?label=Packagist)](https://packagist.org/packages/dipantry/rajaongkir)
![PHP Version](https://img.shields.io/packagist/php-v/dipantry/rajaongkir?label=PHP%20Version)
[![MIT Licensed](https://img.shields.io/github/license/dipantry/rajaongkir?label=License&style=flat-square)](LICENSE)<br>
![run-tests](https://github.com/dipantry/rajaongkir/workflows/run-tests/badge.svg)
[![StyleCI](https://github.styleci.io/repos/483157402/shield?branch=master)](https://github.styleci.io/repos/483157402?branch=master)

Package Laravel atau Lumen yang menyimpan data provinsi, kota, kecamatan, dan negara yang terdaftar pada website [RajaOngkir](https://rajaongkir.com/). Package ini akan membantu Anda untuk mengambil informasi dari API RajaOngkir.

### Fitur
- [x] Data provinsi, kota, kecamatan, dan negara disimpan dalam database lokal anda.
- [x] Seeding data lokasi berdasarkan Api Key dan tipe akun yang terdaftar pada RajaOngkir
- [x] Mengambil biaya pengiriman (ongkir) untuk pengiriman lokal
- [x] Mengambil biaya pengiriman (ongkir) untuk pengiriman internasional
- [x] Mengambil nilai tukar rupiah terhadap US dollar
- [x] Mengambil atau melacak startus pengiriman berdasarkan nomor resi
- [x] Memasang exception khusus apabila terjadi kesalahan pada API RajaOngkir

### Support pada tipe akun
- [x] Starter
- [ ] Basic*
- [x] Pro

*Hingga package ini dibuat, akun basic sudah ditiadakan oleh RajaOngkir. <br>(Informasi dari Raja Ongkir Support)

---
# Instalasi
```sh
composer require dipantry/rajaongkir
```

## Petunjuk Penggunaan
### 1. [Laravel/Lumen](https://github.com/Dipantry/rajaongkir/blob/master/docs/HOWTO-Laravel.md)
### 2. [Vanilla PHP](https://github.com/Dipantry/rajaongkir/blob/master/docs/HOWTO-Vanilla.md)

---
# Testing
Jalankan testing dengan menjalankan perintah berikut ini
```sh
vendor/bin/phpunit
```