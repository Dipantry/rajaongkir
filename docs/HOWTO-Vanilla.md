# Petunjuk Penggunaan RajaOngkir API Wrapper untuk Vanilla PHP

## Inisialisasi
```php
use Dipantry\Rajaongkir\Rajaongkir;

$rajaongkir = new Rajaongkir('API_KEY', 'PACKAGE', 'TIMEOUT')
```
- `API_KEY` adalah API Key yang didapat dari RajaOngkir
- `PACKAGE` adalah tipe akun RajaOngkir (starter, pro)
- `TIMEOUT` adalah waktu timeout (dalam detik) untuk API RajaOngkir, default data 30 detik

---
## Daftar Provinsi
```php
$rajaongkir->getProvince(
    int $provinceId = 0
);

// Contoh
$rajaongkir->getProvince();
$rajaongkir->getProvince($provinceId = 1);
```

## Daftar Kota
```php
$rajaongkir->getCity(
    int $cityId = 0, int $provinceId = 0
);

// Contoh
$rajaongkir->getCity();
$rajaongkir->getCity($cityId = 1);
$rajaongkir->getCity($provinceId = 2);
$rajaongkir->getCity($cityId = 1, $provinceId = 2);
```

## Daftar Kecamatan
```php
$rajaongkir->getSubDistrict(
    int $cityId, int $subDistrictId = 0
);

// Contoh
$rajaongkir->getSubDistrict($cityId = 1);
$rajaongkir->getSubDistrict($cityId = 1, $provinceId = 1);
```

## Biaya Pengiriman Lokal
```php
$rajaongkir->getOngkirCost(
    int $origin, int $destination, int $weight, string $courier,
    string $originType = 'city', string $destinationType = 'city',
    int $length = null, int $width = null, int $height = null, int $diameter = null
)

// Contoh Starter
$rajaongkir->getOngkirCost(
    $origin = 1, $destination = 200, $weight = 300, $courier = RajaongkirCourier::JNE
);

// Contoh Pro
$rajaongkir->getOngkirCost(
    $origin = 1, $destination = 200, $weight = 300, $courier = RajaongkirCourier::JNE,
    $originType = 'subdistrict', $destinationType = 'subdistrict'
);
```

## Daftar Kota Asal untuk Pengiriman Internasional
```php
$rajaongkir->getInternationalOrigin(
    int $cityId = 0, int $provinceId = 0
);

// Contoh
$rajaongkir->getInternationalOrigin();
$rajaongkir->getInternationalOrigin($cityId = 1);
$rajaongkir->getInternationalOrigin($provinceId = 2);
$rajaongkir->getInternationalOrigin($cityId = 1, $provinceId = 2);
```

## Daftar Negara Tujuan untuk Pengiriman Internasional
```php
$rajaongkir->getInternationalDestination(
    int $countryId = 0
);

// Contoh
$rajaongkir->getInternationalDestination();
$rajaongkir->getInternationalDestination($countryId = 1);
```

## Biaya Pengiriman Internasional
```php
$rajaongkir->getInternationalOngkirCost(
    int $origin, int $destination, int $weight, string $courier,
    int $length = null, int $width = null, int $height = null, int $diameter = null
);

// Contoh
$rajaongkir->getInternationalOngkirCost(
    $origin = 1, $destination = 200, $weight = 300, $courier = RajaongkirCourier::JNE,
    $length = 100, $width = 100, $height = 100, $diameter = 100
);
```

## Nilai Tukar Rupiah
```php
$rajaongkir->getCurrency();
```

## Melacak Status Pengiriman
```php
$rajaongkir->getWaybill(
    string $waybill, string $courier
);

// Contoh
$rajaongkir->getWaybill($waybill = '123456789', $courier = RajaongkirCourier::JNE);
```

---
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