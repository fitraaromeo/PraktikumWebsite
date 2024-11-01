<?php
$n = 5; // Jumlah baris

for ($i = $n; $i >= 1; $i--) {
    // Print spasi
    for ($j = $n; $j > $i; $j--) {
        echo "&nbsp;&nbsp;";
    }
    // Print bintang
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "<br>";
}
?>
