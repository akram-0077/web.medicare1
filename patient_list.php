<?php
if (!isset($_SESSION['user'])) {
    echo "<p>Anda tidak memiliki akses ke halaman ini.</p>";
    return;
}

$patients = getPatients();
?>

<h1>Data Pasien Terdaftar</h1>
<table>
    <tr>
        <th>Nama</th>
        <th>Usia</th>
        <th>Jenis Kelamin</th>
        <th>Riwayat Penyakit</th>
        <?php if ($_SESSION['user']['role'] == 'petugas'): ?>
            <th>Aksi</th>
        <?php endif; ?>
    </tr>
    <?php foreach ($patients as $patient): ?>
        <tr>
            <td><?php echo $patient['name']; ?></td>
            <td><?php echo $patient['age']; ?></td>
            <td><?php echo $patient['gender']; ?></td>
            <td><?php echo $patient['history']; ?></td>
            <?php if ($_SESSION['user']['role'] == 'petugas'): ?>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="patient_id" value="<?php echo $patient['id']; ?>">
                        <button type="submit" name="delete_patient">Hapus</button>
                    </form>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>
