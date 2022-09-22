# Petunjuk Penggunaan RajaOngkir API Wrapper untuk Laravel dan Lumen

## Integrasi
### Lumen
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

### Laravel
Dalam file `config/app.php`, masukkan baris berikut pada bagian `providers`
```php
'providers' => [
    ...
    Dipantry\Rajaongkir\ServiceProvider::class,
],
```
dan tambahkan baris berikut pada bagian `aliases`
```php
'aliases' => [
    'Rajaongkir' => Dipantry\Rajaongkir\Facade::class,
],
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
    'table_prefix' => 'Untuk migrasi dan seeding data',
    'timeout' => 'Waktu timeout untuk API RajaOngkir',
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
use Dipantry\Rajaongkir\Constants\RajaongkirCourier;

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
use Dipantry\Rajaongkir\Constants\RajaongkirCourier;

\Rajaongkir::getInternationalOngkirCost(
    int $origin, int $destination, int $weight, string $courier,
    int $length = null, int $width = null, int $height = null, int $diameter = null
)

// Contoh
\Rajaongkir::getInternationalOngkirCost(
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
use Dipantry\Rajaongkir\Constants\RajaongkirCourier;

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