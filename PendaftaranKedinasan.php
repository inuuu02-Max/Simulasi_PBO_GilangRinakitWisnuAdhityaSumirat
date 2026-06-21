<?php
require_once 'Pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran {
    private $skIkatanDinas;
    private $instansiSponsor;

    public function __construct($id, $nama, $asal, $nilai, $biayaDasar, $sk, $instansi) {
        parent::__construct($id, $nama, $asal, $nilai, $biayaDasar);
        $this->skIkatanDinas = $sk;
        $this->instansiSponsor = $instansi;
    }

    public function hitungTotalBiaya() {
        return $this->biayaPendaftaranDasar * 1.25;
    }

    public function tampilkanInfoJalur() {
        return "SK: " . $this->skIkatanDinas . " | Instansi: " . $this->instansiSponsor;
    }

    public static function getDaftarKedinasan($db) {
        $sql = "SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'";
        $result = $db->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = new PendaftaranKedinasan(
                $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
                $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
                $row['sk_ikatan_dinas'], $row['instansi_sponsor']
            );
        }
        return $data;
    }
}
?>