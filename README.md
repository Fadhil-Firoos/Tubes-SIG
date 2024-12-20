# PENGEMBANGAN SISTEM INFORMASI GEOGRAFIS PELAPORAN PERBAIKAN JALAN
## Studi Kasus: Kec. Sukarame, Bandar Lampung


<div style="display: flex; align-items: center;">
    <img src="https://github.com/Fadhil-Firoos/Tubes-SIG/blob/development/public/images/logo.png" alt="FlowBite Logo" style="height: 32px; margin-right: 12px;" />
    <span style="font-size: 24px; font-weight: 600; color: black;">GEOPALA</span>
</div>



## Deskripsi Proyek

Proyek ini bertujuan untuk mengembangkan sistem pelaporan dan pemantauan perbaikan jalan di Kecamatan Sukarame, Bandar Lampung. Sistem ini akan memfasilitasi komunikasi antara vendor (kontraktor) dan Dinas PUPR dalam melaporkan dan memantau perbaikan jalan.

## Masalah yang Dihadapi

- Pelaporan progress perbaikan kerusakan jalan masih dilakukan secara manual oleh Dinas PUPR.
- Kurangnya transparansi dan efisiensi dalam pelaporan dan pemantauan status perbaikan jalan.

## Aktor Utama

- **Admin (Dinas PUPR)**:
  - Mengelola dashboard yang menampilkan data perbaikan berdasarkan status (ditolak, sedang dikerjakan, diterima).
  - Mengakses peta yang menunjukkan keseluruhan laporan yang sedang dikerjakan dan diterima.

- **Vendor (Kontraktor)**:
  - Melihat peta yang berisi proyek-proyek yang dikerjakan oleh vendor tersebut.
  - Menggunakan fitur untuk membuat laporan perbaikan jalan.

## Fitur Utama

- **Pelaporan Kerusakan Jalan**:
  - Vendor dapat melaporkan jenis kerusakan jalan dengan data inputan seperti foto, lebar perbaikan, panjang perbaikan, nama lokasi, nama company, dan tanggal mulai.
  - Laporan dapat diterima atau ditolak oleh Admin berdasarkan kriteria tertentu.

- **Tracking Status Pekerjaan**:
  - Setelah laporan diterima, lokasi kerusakan akan ditampilkan dalam bentuk titik-titik pada peta.

## Tujuan Website

- Meningkatkan efisiensi pelaporan dan pemantauan perbaikan jalan.
- Memfasilitasi komunikasi yang lebih baik antara vendor dan Dinas PUPR.
- Menyediakan data yang akurat dan real-time mengenai status perbaikan jalan.

## Website

Kunjungi website kami di: [http://geopala.my.id](http://geopala.my.id)


# Team 🤝 :
|          Nama         | NIM |       ROLE       |
|:---------------------:|:----------:|:----------------:|
| Fadhil Firoos | 121140142  | Back End |
| Adi Sulaksono | 120140038 | Back End |
| Inori Muira Sitanggang | 121140020 | Technical Writer |
| Henry Carnegie | 121140054 | Front End |
| Nikola Arinanda | 121140202 | Front End |


## Instalasi dan Persyaratan

### Persyaratan

- **Laravel**: Versi 11
- **PHP**: Minimum 8.2
- **Database**: PostgreSQL dengan PostGIS dan pgAdmin
- **Peta**: Leaflet.js

### Instalasi

1. Clone repositori ini:
   ```bash
   git clone https://github.com/Fadhil-Firoos/Tubes-SIG.git


