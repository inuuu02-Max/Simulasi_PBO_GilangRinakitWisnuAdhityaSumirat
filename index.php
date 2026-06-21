<?php
// ==========================================
// 1. KONEKSI DATABASE (LANGSUNG DIBUAT DI SINI)
// ==========================================
$db = new mysqli("localhost", "root", "", "db_simulasi_pbo_kelas_gilangrinakitwisnuadhityasumirat");

if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

// ==========================================
// 2. KELAS ABSTRAK PENDAFTARAN
// ==========================================
abstract class Pendaftaran {
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biayaPendaftaranDasar;

    public function __construct($id, $nama, $asal, $nilai, $biayaDasar) {
        $this->id_pendaftaran = $id;
        $this->nama_calon = $nama;
        $this->asal_sekolah = $asal;
        $this->nilai_ujian = $nilai;
        $this->biayaPendaftaranDasar = $biayaDasar;
    }

    public function getNama() { return $this->nama_calon; }
    public function getAsalSekolah() { return $this->asal_sekolah; }
    public function getNilai() { return $this->nilai_ujian; }

    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur();
}

// ==========================================
// 3. KELAS REGULER
// ==========================================
class PendaftaranReguler extends Pendaftaran {
    private $pilihanProdi;
    private $lokasiKampus;

    public function __construct($id, $nama, $asal, $nilai, $biayaDasar, $prodi, $lokasi) {
        parent::__construct($id, $nama, $asal, $nilai, $biayaDasar);
        $this->pilihanProdi = $prodi;
        $this->lokasiKampus = $lokasi;
    }

    public function hitungTotalBiaya() { return $this->biayaPendaftaranDasar; }
    public function tampilkanInfoJalur() { return "Prodi: " . $this->pilihanProdi . " | Kampus: " . $this->lokasiKampus; }

    public static function getDaftarReguler($koneksi) {
        $data = [];
        $result = $koneksi->query("SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = new PendaftaranReguler(
                    $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
                    $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
                    $row['pilihan_prodi'] ?? '', $row['lokasi_kampus'] ?? ''
                );
            }
        }
        return $data;
    }
}

// ==========================================
// 4. KELAS PRESTASI
// ==========================================
class PendaftaranPrestasi extends Pendaftaran {
    private $jenisPrestasi;
    private $tingkatPrestasi;

    public function __construct($id, $nama, $asal, $nilai, $biayaDasar, $jenis, $tingkat) {
        parent::__construct($id, $nama, $asal, $nilai, $biayaDasar);
        $this->jenisPrestasi = $jenis;
        $this->tingkatPrestasi = $tingkat;
    }

    public function hitungTotalBiaya() { return $this->biayaPendaftaranDasar - 50000; }
    public function tampilkanInfoJalur() { return "Prestasi: " . $this->jenisPrestasi . " | Tingkat: " . $this->tingkatPrestasi; }

    public static function getDaftarPrestasi($koneksi) {
        $data = [];
        $result = $koneksi->query("SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Prestasi'");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = new PendaftaranPrestasi(
                    $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
                    $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
                    $row['jenis_prestasi'] ?? '', $row['tingkat_prestasi'] ?? ''
                );
            }
        }
        return $data;
    }
}

// ==========================================
// 5. KELAS KEDINASAN
// ==========================================
class PendaftaranKedinasan extends Pendaftaran {
    private $skIkatanDinas;
    private $instansiSponsor;

    public function __construct($id, $nama, $asal, $nilai, $biayaDasar, $sk, $instansi) {
        parent::__construct($id, $nama, $asal, $nilai, $biayaDasar);
        $this->skIkatanDinas = $sk;
        $this->instansiSponsor = $instansi;
    }

    public function hitungTotalBiaya() { return $this->biayaPendaftaranDasar * 1.25; }
    public function tampilkanInfoJalur() { return "SK: " . $this->skIkatanDinas . " | Instansi: " . $this->instansiSponsor; }

    public static function getDaftarKedinasan($koneksi) {
        $data = [];
        $result = $koneksi->query("SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = new PendaftaranKedinasan(
                    $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
                    $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
                    $row['sk_ikatan_dinas'] ?? '', $row['instansi_sponsor'] ?? ''
                );
            }
        }
        return $data;
    }
}

// ==========================================
// 6. AMBIL DATA DARI DATABASE
// ==========================================
$dataReguler = PendaftaranReguler::getDaftarReguler($db);
$dataPrestasi = PendaftaranPrestasi::getDaftarPrestasi($db);
$dataKedinasan = PendaftaranKedinasan::getDaftarKedinasan($db);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendaftaran</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #F4F7F6; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 1100px; margin: 0 auto; background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #2C3E50; margin-bottom: 40px; }
        .section-title { background-color: #3498DB; color: white; padding: 12px 20px; border-radius: 8px 8px 0 0; margin-bottom: 0; font-size: 1.3em; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; background-color: #fff; border-radius: 0 0 8px 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #E0E0E0; }
        th { background-color: #ECF0F1; color: #2C3E50; font-weight: 600; }
        tr:hover { background-color: #F8F9F9; }
        .badge { background-color: #E8F8F5; color: #1ABC9C; padding: 6px 12px; border-radius: 6px; font-weight: bold; display: inline-block; }
    </style>
</head>
<body>

<div class="container">
    <h1>Sistem Penerimaan Mahasiswa Baru</h1>

    <h2 class="section-title">🎓 Jalur Reguler</h2>
    <table>
        <tr><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Informasi Jalur</th><th>Total Biaya</th></tr>
        <?php foreach ($dataReguler as $mhs): ?>
        <tr>
            <td><?= $mhs->getNama(); ?></td>
            <td><?= $mhs->getAsalSekolah(); ?></td>
            <td><?= number_format($mhs->getNilai(), 2); ?></td>
            <td><?= $mhs->tampilkanInfoJalur(); ?></td>
            <td><span class="badge">Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.'); ?></span></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2 class="section-title" style="background-color: #9B59B6;">🏆 Jalur Prestasi</h2>
    <table>
        <tr><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Informasi Jalur</th><th>Total Biaya</th></tr>
        <?php foreach ($dataPrestasi as $mhs): ?>
        <tr>
            <td><?= $mhs->getNama(); ?></td>
            <td><?= $mhs->getAsalSekolah(); ?></td>
            <td><?= number_format($mhs->getNilai(), 2); ?></td>
            <td><?= $mhs->tampilkanInfoJalur(); ?></td>
            <td><span class="badge" style="color: #8E44AD; background-color: #F5EEF8;">Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.'); ?></span></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2 class="section-title" style="background-color: #E67E22;">🏢 Jalur Kedinasan</h2>
    <table>
        <tr><th>Nama Calon</th><th>Asal Sekolah</th><th>Nilai Ujian</th><th>Informasi Jalur</th><th>Total Biaya</th></tr>
        <?php foreach ($dataKedinasan as $mhs): ?>
        <tr>
            <td><?= $mhs->getNama(); ?></td>
            <td><?= $mhs->getAsalSekolah(); ?></td>
            <td><?= number_format($mhs->getNilai(), 2); ?></td>
            <td><?= $mhs->tampilkanInfoJalur(); ?></td>
            <td><span class="badge" style="color: #D35400; background-color: #FDEDEC;">Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.'); ?></span></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>