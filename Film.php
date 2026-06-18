<?php
// Menyertakan file koneksi sebelumnya
require_once 'koneksi.php';

// Class Film mewarisi semua properti dan method dari DatabaseConnection
class Film extends DatabaseConnection {

    // Method untuk mengambil seluruh data dari tabel film
    public function tampilkanSemua() {
        // Query SQL untuk mengambil seluruh data film
        $sql = "SELECT * FROM film";
        
        // Menjalankan query menggunakan properti $conn yang diwarisi dari parent class
        $result = $this->conn->query($sql);
        
        // Memeriksa apakah ada data yang ditemukan
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}

// Membuat objek dari class Film
$filmObj = new Film();
$dataFilm = $filmObj->tampilkanSemua();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film Bioskop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <h2>Daftar Koleksi Film Bioskop</h2>

    <table>
        <thead>
            <tr>
                <th>ID Film</th>
                <th>Judul Film</th>
                <th>Sutradara</th>
                <th>Durasi (Menit)</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Jika data film ada, lakukan perulangan untuk menampilkannya ke tabel
            if ($dataFilm) {
                while($row = $dataFilm->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_film'] . "</td>";
                    echo "<td>" . $row['judul'] . "</td>";
                    echo "<td>" . $row['sutradara'] . "</td>";
                    echo "<td>" . $row['durasi'] . " mnt</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>Belum ada data film.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>