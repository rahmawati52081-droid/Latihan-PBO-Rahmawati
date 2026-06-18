<?php
// [Tahap 4] Mengimplementasikan inheritance kelas anak

require_once 'Tiket.php';

// 1. Subclass TiketRegular
class TiketRegular extends Tiket {
    // Properti tambahan spesifik
    private $tipeAudio;
    private $lokasiBaris;

    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $tipeAudio, $lokasiBaris) {
        // Memanggil constructor dari abstract class parent
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->tipeAudio = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
    }

    // Implementasi wajib metode hitungTotalHarga
    public function hitungTotalHarga() {
        // Misal: Regular tidak ada biaya tambahan, hanya harga dasar dikali jumlah kursi
        return $this->hargaDasarTiket * $this->jumlah_kursi;
    }

    // Implementasi wajib metode tampilkanInfoFasilitas
    public function tampilkanInfoFasilitas() {
        return "Tipe Audio: " . ($this->tipeAudio ?? "Standar") . " | Kursi: " . $this->lokasiBaris;
    }
}

// 2. Subclass TiketIMAX
class TiketIMAX extends Tiket {
    // Properti tambahan spesifik
    private $kacamata3dId;
    private $efekGerakFitur;

    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $kacamata3dId, $efekGerakFitur) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->kacamata3dId = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
    }

    public function hitungTotalHarga() {
        // Misal: IMAX ada tambahan biaya surcharge Rp 25.000 per kursi karena fasilitas mewah
        $surcharge = 25000;
        return ($this->hargaDasarTiket + $surcharge) * $this->jumlah_kursi;
    }

    public function tampilkanInfoFasilitas() {
        return "ID Kacamata 3D: " . ($this->kacamata3dId ?? "Tidak Ada") . " | Efek Gerak: " . ($this->efekGerakFitur ?? "Standar");
    }
}

// 3. Subclass TiketVelvet
class TiketVelvet extends Tiket {
    // Properti tambahan spesifik
    private $bantalSelimutPack;
    private $layananButler;

    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $bantalSelimutPack, $layananButler) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler = $layananButler;
    }

    public function hitungTotalHarga() {
        // Misal: Velvet kelas super premium, ada tambahan biaya Rp 50.000 per paket/kursi
        $premiumService = 50000;
        return ($this->hargaDasarTiket + $premiumService) * $this->jumlah_kursi;
    }

    public function tampilkanInfoFasilitas() {
        return "Fasilitas Kamar: " . $this->bantalSelimutPack . " | Layanan Butler: " . $this->layananButler;
    }
}
?>