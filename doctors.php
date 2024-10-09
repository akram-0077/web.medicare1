<?php
// Daftar dokter
$doctors = [
    ['name' => 'Dr. Akram Yalrizon Golanda', 'specialty' => 'Spesialis Bedah Plastik'],
    ['name' => 'Dr. Ratih Aditya', 'specialty' => 'Spesialis Jantung'],
    ['name' => 'Dr. Zikra Rahman', 'specialty' => 'Spesialis Saraf'],
    ['name' => 'Dr. Hana Malik', 'specialty' => 'Spesialis Anak']
];
?>

<h2>Daftar Dokter</h2>
<table>
    <tr>
        <th>Nama Dokter</th>
        <th>Spesialisasi</th>
    </tr>
    <?php foreach ($doctors as $doctor): ?>
    <tr>
        <td><?php echo $doctor['name']; ?></td>
        <td><?php echo $doctor['specialty']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
