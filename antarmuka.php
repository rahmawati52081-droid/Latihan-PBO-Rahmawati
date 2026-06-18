<?php
// [Tahap 6] Membuat halaman antarmuka (View) pengelompokan tiket dengan Polimorfisme

// 1. Menyertakan file koneksi database dan kelas-kelas objek
require_once 'koneksi.php'; // Pastikan nama file koneksi Anda sesuai (misal: koneksi.php)
require_once 'Tiket.php';
require_once 'KelasAnakTiket.php'; // File tempat kelas TiketRegular, TiketIMAX, TiketVelvet berada

// 2. Mengambil seluruh data dari tabel_tiket
$sql = "SELECT * FROM tabel_tiket";
$result = $conn->query($sql);

// 3. Menyiapkan array penampung kelompok studio
$listRegular = [];
$listIMAX = [];
$listVelvet = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Pemetaan dari Single Table Inheritance database menjadi Objek Polimorfisme
        if ($row['jenis_studio'] == 'regular') {
            $listRegular[] = new TiketRegular(
                $row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], 
                $row['jumlah_kursi'], $row['harga_dasar_tiket'], 
                $row['type_audio'], $row['lokasi_baris']
            );
        } elseif ($row['jenis_studio'] == 'IMAX') {
            $listIMAX[] = new TiketIMAX(
                $row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], 
                $row['jumlah_kursi'], $row['harga_dasar_tiket'], 
                $row['kacamata_3d_id'], $row['efek_gerak_fitur']
            );
        } elseif ($row['jenis_studio'] == 'Velvet') {
            $listVelvet[] = new TiketVelvet(
                $row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], 
                $row['jumlah_kursi'], $row['harga_dasar_tiket'], 
                $row['bantal_selimut_pack'], $row['layanan_butler']
            );
        }
    }
}

// Fungsi bantu untuk mencetak baris tabel menggunakan Polimorfisme
function cetakTabelTiket($daftarTiket) {
    if (empty($daftarTiket)) {
        echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data tiket.</td></tr>";
        return;
    }
    
    foreach ($daftarTiket as $tiket) {
        // Menggunakan Getter/Reflection atau Properti Akses jika diizinkan, 
        // Namun karena properti parent bersifat protected, kita bisa membuat fungsi bantu 
        // atau jika belum ada, kita tampilkan infonya lewat metode polimorfik yang wajib.
        
        // Catatan: Karena properti protected di parent tidak bisa langsung dibaca dari luar (instansiasi),
        // Kita gunakan trik Reflection PHP bawaan agar tidak mengubah file induk (Tiket.php) yang sudah dikunci.
        $reflector = new ReflectionClass($tiket);
        
        $propId = $reflector->getProperty('id_tiket');
        $propId->setAccessible(true);
        
        $propNama = $reflector->getProperty('nama_film');
        $propNama->setAccessible(true);
        
        $propJadwal = $reflector->getProperty('jadwal_tayang');
        $propJadwal->setAccessible(true);
        
        $propKursi = $reflector->getProperty('jumlah_kursi');
        $propKursi->setAccessible(true);
        
        $propHarga = $reflector->getProperty('hargaDasarTiket');
        $propHarga->setAccessible(true);

        echo "<tr>";
        echo "<td>" . $propId->getValue($tiket) . "</td>";
        echo "<td><strong>" . $propNama->getValue($tiket) . "</strong></td>";
        echo "<td>" . $propJadwal->getValue($tiket) . "</td>";
        echo "<td>" . $propKursi->getValue($tiket) . " Kursi</td>";
        echo "<td>Rp " . number_format($propHarga->getValue($tiket), 0, ',', '.') . "</td>";
        
        // PANGGILAN POLIMORFISME UTAMA:
        echo "<td class='fasilitas'>" . $tiket->tampilkanInfoFasilitas() . "</td>";
        echo "<td class='total-harga'>Rp " . number_format($tiket->hitungTotalHarga(), 0, ',', '.') . "</td>";
        echo "</tr>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Tiket Bioskop - Polimorfisme View</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 30px; color: #333; }
        h1 { text-align: center; color: #2c3e50; margin-bottom: 30px; }
        h2 { color: #2980b9; border-bottom: 2px solid #2980b9; padding-bottom: 5px; margin-top: 40px; }
        .velvet-title { color: #8e44ad; border-bottom: 2px solid #8e44ad; }
        .regular-title { color: #27ae60; border-bottom: 2px solid #27ae60; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 20px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #34495e; color: white; font-weight: bold; }
        tr:hover { background-color: #f9f9f9; }
        td.fasilitas { font-style: italic; color: #555; }
        td.total-harga { font-weight: bold; color: #c0392b; }
    </style>
</head>
<body>

    <h1>SISTEM MANAJEMEN TIKET BIOSKOP (VIEW)</h1>

    <h2 class="regular-title">Daftar Tiket - Studio Regular</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Film</th>
                <th>Jadwal Tayang</th>
                <th>Jumlah Kursi</th>
                <th>Harga Dasar</th>
                <th>Spesifikasi Fasilitas (Polimorfik)</th>
                <th>Total Harga (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php cetakTabelTiket($listRegular); ?>
        </tbody>
    </table>

    <h2>Daftar Tiket - Studio IMAX</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Film</th>
                <th>Jadwal Tayang</th>
                <th>Jumlah Kursi</th>
                <th>Harga Dasar</th>
                <th>Spesifikasi Fasilitas (Polimorfik)</th>
                <th>Total Harga (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php cetakTabelTiket($listIMAX); ?>
        </tbody>
    </table>

    <h2 class="velvet-title">Daftar Tiket - Studio Velvet</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Film</th>
                <th>Jadwal Tayang</th>
                <th>Jumlah Kursi</th>
                <th>Harga Dasar</th>
                <th>Spesifikasi Fasilitas (Polimorfik)</th>
                <th>Total Harga (Polimorfik)</th>
            </tr>
        </thead>
        <tbody>
            <?php cetakTabelTiket($listVelvet); ?>
        </tbody>
    </table>

</body>
</html>