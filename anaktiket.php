<?php
// [Tahap 5] Mengimplementasikan overriding harga studio Regular, IMAX, dan Velvet

require_once 'Tiket.php';

// 1. Subclass TiketRegular
class TiketRegular extends Tiket {
    private $tipeAudio;
    private $lokasiBaris;

    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $tipeAudio, $lokasiBaris) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->tipeAudio = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
    }

    // OVERRIDING TAHAP 5: Tarif standar murni tanpa biaya tambahan
    public function hitungTotalHarga() {
        return $this->jumlah_kursi * $this->hargaDasarTiket;
    }

    public function tampilkanInfoFasilitas() {
        return "Tipe Audio: " . ($this->tipeAudio ?? "Standar") . " | Kursi: " . $this->lokasiBaris;
    }
}

// 2. Subclass TiketIMAX
class TiketIMAX extends Tiket {
    private $kacamata3dId;
    private $efekGerakFitur;

    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $kacamata3dId, $efekGerakFitur) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->kacamata3dId = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
    }

    // OVERRIDING TAHAP 5: Ditambah biaya flat Rp 35.000
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) + 35000;
    }

    public function tampilkanInfoFasilitas() {
        return "ID Kacamata 3D: " . ($this->kacamata3dId ?? "Tidak Ada") . " | Efek Gerak: " . ($this->efekGerakFitur ?? "Standar");
    }
}

// 3. Subclass TiketVelvet
class TiketVelvet extends Tiket {
    private $bantalSelimutPack;
    private $layananButler;

    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket, $bantalSelimutPack, $layananButler) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler = $layananButler;
    }

    // OVERRIDING TAHAP 5: Surcharge kelas premium sebesar 50% (* 1.50)
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
    }

    public function tampilkanInfoFasilitas() {
        return "Fasilitas Kamar: " . $this->bantalSelimutPack . " | Layanan Butler: " . $this->layananButler;
    }
}
?>