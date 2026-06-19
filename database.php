<?php
// [Tahap 3] Poin 2: Membuat abstract class bernama Pendaftaran
abstract class Pendaftaran {
    
    // [Tahap 3] Poin 3: Properti/Atribut Terenkapsulasi (protected)
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biayaPendaftaranDasar;

    // [Tahap 3] Poin 4: Metode Abstrak (Tanpa Isi/Body)
    abstract public function hitungTotalBiaya();
    
    abstract public function tampilkanInfoJalur();
}
?>