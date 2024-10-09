<h1>Layanan Kami</h1>
<div>
    <h3>Bedah Plastik</h3>
    <button onclick="toggleServiceDesc(1)">Pelajari Lebih Lanjut</button>
    <p id="serviceDesc1" style="display:none;">Layanan bedah plastik komprehensif untuk tujuan estetika dan rekonstruksi.</p>
</div>
<div>
    <h3>Kardiologi</h3>
    <button onclick="toggleServiceDesc(2)">Pelajari Lebih Lanjut</button>
    <p id="serviceDesc2" style="display:none;">Perawatan dan diagnosa penyakit jantung yang lengkap.</p>
</div>
<div>
    <h3>Neurologi</h3>
    <button onclick="toggleServiceDesc(3)">Pelajari Lebih Lanjut</button>
    <p id="serviceDesc3" style="display:none;">Spesialisasi dalam gangguan sistem saraf pusat dan perifer.</p>
</div>

<script>
function toggleServiceDesc(id) {
    var desc = document.getElementById('serviceDesc' + id);
    desc.style.display = desc.style.display === 'none' ? 'block' : 'none';
}
</script>