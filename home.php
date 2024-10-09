<div class="hero">
    <h1>Selamat Datang di Medicare</h1>
    <p>Medicare, Rumah Sakit Sehat Sentosa, pusat data pasien.</p>
    <?php if (!isset($_SESSION['user'])): ?>
        <a href="#" onclick="showLoginForm()" class="cta-button">Login</a>
    <?php endif; ?>
</div>
<div class="features">
    <div class="feature-box">
        <h3>Pendaftaran Pasien</h3>
        <p>Pusat pendaftaran pasien.</p>
    </div>
    <div class="feature-box">
        <h3>Rekap Medis</h3>
        <p>Hasil pemeriksaan pasien.</p>
    </div>
    <div class="feature-box">
        <h3>Layanan Darurat</h3>
        <p>Pelayanan 24/7 untuk kebutuhan medis mendesak Anda.</p>
    </div>
    <div class="feature-box">
        <h3>Konsultasi Online</h3>
        <p>Konsultasi dengan dokter ahli secara online.</p>
    </div>
</div>