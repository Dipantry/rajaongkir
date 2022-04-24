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

## Daftarkan Service Provider dan Facade untuk Lumen
Dalam file `bootstrap/app.php`, uncomment baris berikut
```php
$app->withFacades();
$app->withEloquent();
```
dan daftarkan service provider dan alias/facade dengan menambahkan kode berikut
```php
$app->register(Dipantry\Rajaongkir\ServiceProvider::class);

// class_aliases
class_alias(Dipantry\Rajaongkir\Facade::class, 'Rajaongkir');
```

## Konfigurasi
```sh
php artisan vendor:publish --provider="Dipantry\Rajaongkir\ServiceProvider"
```

File konfigurasi terletak pada `config/rajaongkir.php`
```php
return [
    'api_key' => 'Masukkan API Key Anda',
    'package' => 'Masukkan Tipe Akun Anda (Basic, Starter, Pro)',
    'table_prefix' => 'Untuk migrasi dan seeding data'
]
```

### Jalankan migrasi
```sh
php artisan migrate
```

### Jalankan seeder untuk mengisi data provinsi, kota, kecamatan, dan negara
```sh
php artisan rajaongkir:seed
```

---
# Cara menggunakan
## Data Provinsi, Kota, Kecamatan, dan Negara
Untuk mengambil data provinsi, kota, kecamatan, dan negara dapat menggunakan model yang sudah disediakan

```php
use Dipantry\Rajaongkir\Models\ROProvince;
use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROSubDistrict;
use Dipantry\Rajaongkir\Models\ROCountry;

ROProvince::all();
ROCity::all();
ROSubDistrict::all();
ROCountry::all();
```

## Biaya Pengiriman Lokal
```php
use Dipantry\Rajaongkir\Models\RajaongkirCourier;

\Rajaongkir::getOngkirCost(
    int $origin, int $destination, int $weight, string $courier,
    string $originType = 'city', string $destinationType = 'city',
    int $length = null, int $width = null, int $height = null, int $diameter = null
)

// Contoh Starter
\Rajaongkir::getOngkirCost(
    $origin = 1, $destination = 200, $weight = 300, $courier = RajaongkirCourier::JNE
);

// Contoh Pro
\Rajaongkir::getOngkirCost(
    $origin = 1, $destination = 200, $weight = 300, $courier = RajaongkirCourier::JNE,
    $originType = 'subdistrict', $destinationType = 'subdistrict'
);
```

## Biaya Pengiriman Internasional
```php
use Dipantry\Rajaongkir\Models\RajaongkirCourier;

\Rajaongkir::getInternationalOngkirCost(
    int $origin, int $destination, int $weight, string $courier,
    int $length = null, int $width = null, int $height = null, int $diameter = null
)

// Contoh
\Rajaongkir::getOngkirCost(
    $origin = 1, $destination = 200, $weight = 300, $courier = RajaongkirCourier::JNE,
    $length = 100, $width = 100, $height = 100, $diameter = 100
);
```

## Nilai Tukar Rupiah
```php
\Rajaongkir::getCurrency()
```

## Melacak Status Pengiriman
```php
use Dipantry\Rajaongkir\Models\RajaongkirCourier;

\Rajaongkir::getWaybill(
    string $waybill, string $courier
);

// Contoh
\Rajaongkir::getWaybill(
    $waybill = '123456789', $courier = RajaongkirCourier::JNE
);
```

### Rajaongkir Courier
Package ini menyediakan model `RajaongkirCourier` yang berisi data kurir yang terdaftar pada RajaOngkir. Model tersebut mengembalikan kode kurir untuk dikirimkan ke server RajaOngkir. <br> 
*Disarankan untuk menggunakan model untuk mencegah kesalahan penulisan kode kurir.

### Response
Setiap method yang digunakan (kecuali models) mengembalikan response berupa array atau object bergantung pada isi `result` atau `results` yang diterima.

### Exception
Setiap kali sistem melakukan request ke API Raja Ongkir, jika terjadi kesalahan, maka sistem akan mengembalikan `APIResponseException` dengan pesan kesalahan yang diberikan oleh Raja Ongkir. Jika request berhasil, maka sistem akan mengembalikan hasil request yang diberikan oleh Raja Ongkir.
`APIResponseException` memiliki 2 informasi yaitu `code` dan `message`

#### Error Code
- <b>400 Bad Request</b><br>
Kode ini biasanya dikirim dari API Raja Ongkir apabila terjadi kesalahan pada request, baik kesalahan pada parameter, HTTP Method, hingga API Key yang tidak valid.
- <b>500 Internal Server Error</b><br>
Kode ini di generate otomatis oleh package ini ketika terjadi kesalahan pada server atau server tidak mengembalikan response yang valid.

---
# Testing
Jalankan testing dengan menjalankan perintah berikut ini
```sh
vendor/bin/phpunit
```