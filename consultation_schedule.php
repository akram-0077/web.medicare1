<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'dokter') {
    echo "<p>Anda tidak memiliki akses ke halaman ini.</p>";
    return;
}
?>

<h1>Jadwal Konsultasi</h1>
<p>Fitur ini belum diimplementasikan.</p>