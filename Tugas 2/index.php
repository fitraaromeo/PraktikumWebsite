<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Menentukan Suku ke-n</title>
</head>
<body>
    <h2>Masukkan Nilai n</h2>
    <form method="POST" action="">
        <label for="nilai_n">Nilai n:</label>
        <input type="number" id="nilai_n" name="nilai_n" min="1" required>
        <input type="submit" value="Proses">
    </form>

    <?php
    // Mengecek apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Mendapatkan nilai n dari input user
        $n = intval($_POST['nilai_n']);

        // Fungsi untuk mencetak suku ke-n
        function cetakBilangan($n) {
            for ($i = 1; $i <= $n; $i++) {
                if ($i % 4 == 0 && $i % 6 == 0) {
                    echo "Pemrograman Website 2024<br>";
                } elseif ($i % 5 == 0) {
                    echo "2024<br>";
                } elseif ($i % 4 == 0) {
                    echo "Pemrograman<br>";
                } elseif ($i % 6 == 0) {
                    echo "Website<br>";
                } else {
                    echo $i . "<br>";
                }
            }
        }

        // Menampilkan hasil
        echo "<h3>Hasil:</h3>";
        cetakBilangan($n);
    }
    ?>
</body>
</html>
