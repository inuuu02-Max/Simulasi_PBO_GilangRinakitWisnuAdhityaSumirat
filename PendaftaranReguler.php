<?php
require_once 'Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {
    private $pilihanProdi;
    private $lokasiKampus;

    public function __construct($id, $nama, $asal, $nilai, $biayaDasar, $prodi, $lokasi) {
        parent::__construct($id, $nama, $asal, $nilai, $biayaDasar);
        $this->pilihanProdi = $prodi;
        $this->lokasiKampus = $lokasi;
    }

    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar; 
    }

    public function tampilkanInfoJalur() {
        return "Prodi: " . $this->pilihanProdi . " | Kampus: " . $this->lokasiKampus;
    }

    public static function getDaftarReguler($db) {
        $sql = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'";
        $result = $db->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = new PendaftaranReguler(
                $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
                $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
                $row['pilihan_prodi'], $row['lokasi_kampus']
            );
        }
        return $data;
    }
}
?>