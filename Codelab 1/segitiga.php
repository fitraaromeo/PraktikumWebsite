<?php
function segitigaSamaSisi($n) {
    for ($i = 1; $i <= $n; $i++) {
        // Menampilkan spasi
        for ($j = $i; $j < $n; $j++) {
            echo "&nbsp;&nbsp;";
        }
        // Menampilkan bintang
        for ($k = 1; $k <= (2 * $i - 1); $k++) {
            echo "*";
        }
        echo "<br>";
    }
}

// Memanggil fungsi
segitigaSamaSisi(5);
?>
