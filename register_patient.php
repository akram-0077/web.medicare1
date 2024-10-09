<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'petugas') {
    echo "<p>Anda tidak memiliki akses ke halaman ini.</p>";
    return;
}
?>

<h2>Pendaftaran Pasien Baru</h2>
<form method="post" action="">
    <input type="text" name="patientName" placeholder="Nama Lengkap" required>
    <input type="number" name="patientAge" placeholder="Usia" required>
    <select name="patientGender" required>
        <option value="">Pilih Jenis Kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>
    <textarea name="patientHistory" placeholder="Riwayat Penyakit" required></textarea>
    <button type="submit" name="register_patient">Daftar Pasien</button>
</form>
