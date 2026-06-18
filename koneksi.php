<?php
class DatabaseConnection {
    // Properti untuk menyimpan kredensial database
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "bioskop";
    public $conn;

    // Constructor untuk otomatis membuat koneksi saat objek dibuat
    public function __construct() {
        // Membuat koneksi menggunakan MySQLi dengan pendekatan OOP
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Memeriksa apakah koneksi gagal
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        } else {
            echo "Pesan: Sukses! Berhasil terkoneksi dengan basis data '" . $this->database . "'.<br>";
        }
    }
}

// Membuat instance / objek dari class DatabaseConnection
// Saat objek ini dibuat, fungsi __construct() akan otomatis dipanggil
$db = new DatabaseConnection();
?>