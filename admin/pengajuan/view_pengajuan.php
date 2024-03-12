<?php
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=pengajuan';
        }
    })</script>";
}
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT *, tp.status AS status_pengajuan, dp.status AS status FROM data_pegawai dp 
                JOIN periode p ON dp.id_periode=p.id_periode 
                JOIN tb_unit u ON u.id_unit=dp.f_id_unit 
                JOIN tb_pengajuan tp ON tp.f_id_pegawai=dp.id_pegawai
                WHERE id_pegawai='" . $_GET['kode'] . "'";
                
    $query_cek = mysqli_query($koneksi, $sql_cek);
    if(mysqli_num_rows($query_cek) < 1){
        echo "<script>
        Swal.fire({title: 'Data tidak ditemukan', text: '', icon: 'error', confirmButtonText: 'OK'}).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=pengajuan';
            }
            });
        </script>";
    }
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}

$ses_unit = $_SESSION['ses_unit'];
?>
<div class="row">
    <div class="col-md-8">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Profil Pegawai</h3>

                <div class="card-tools">
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 150px">
                                <b>NIP</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['nip'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Nama</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['nama'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Alamat</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['alamat'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Masa Kerja</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['masa_kerja'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Tempat Lahir</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tempat_lahir'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Tanggal Lahir</b>
                            </td>
                            <td>:
                                <?php echo date('d F Y', strtotime($data_cek['tanggal_lahir']??'0000-00-00')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Jenis Kelamin</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['jk'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Agama</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['agama'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Status Pegawai</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['status'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Periode</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tahun'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b><?= !isset($data_cek['status'])?'-':($data_cek['status'] == 'Honor' ? 'SK Pengangkatan Pertama' : 'SK Pengangkatan CPNS'); ?></b>
                            </td>
                            <td>:
                                <?= !isset($data_cek['status'])?'-':($data_cek['skpp'] == NULL ? '-' : date('d F Y', strtotime($data_cek['skpp']))); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b><?= !isset($data_cek['status'])?'-':($data_cek['status'] == 'Honor' ? 'SK Pengangkatan Terakhir' : 'SK Pensiun'); ?></b>
                            </td>
                            <td>:
                                <?=!isset($data_cek['status'])?'-':($data_cek['skpt'] == NULL ? '-' : date('d F Y', strtotime($data_cek['skpt']??'0000-00-00'))); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Unit</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['nama_unit'] ??'-'; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Mengajukan Kenaikan Pangkat</h3>

                <div class="card-tools">
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 150px">
                                <b>Pangkat yang diajukan</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['pangkat_diajukan'] ??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Dokumen</b>
                            </td>
                            <td>:
                                <a target="_blank"
                                    href="./dokumen/<?php echo $data_cek['dokumen']; ?>"><?php echo $data_cek['dokumen'] ??'-'; ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Keterangan</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['keterangan'] ?? '-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Tanggal Pengajuan</b>
                            </td>
                            <td>:
                                <?php echo date('d F Y', strtotime($data_cek['tanggal_pengajuan']??'0000-00-00')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Status</b>
                            </td>
                            <td>:
                                <span
                                    class="bg<?= !isset($data_cek['status_pengajuan'])?'-':($data_cek['status_pengajuan'] == 'tunggu'?'-secondary':($data_cek['status_pengajuan'] == 'terima'?'-success':'-danger'));?> rounded-lg p-1"><?php echo ucwords($data_cek['status_pengajuan']??'-'); ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                    <form action="" method="post" id="pengajuan">
                        <?php if($ses_unit == 1):?>
                        <textarea class="form-control mb-2"
                            placeholder="Berikan pesan terkait penolakan (Jika ditolak)." name="pesan-ditolak"
                            rows="5"></textarea>

                        <button type="submit"
                            <?= !isset($data_cek['status_pengajuan'])?'-':($data_cek['status_pengajuan'] == 'terima'?'disabled':''); ?>
                            name="terima" title="Aksi Terima" class="btn btn-success">
                            <i class="nav-icon fas fa-check"></i> Terima</button>
                        <button type="submit"
                            <?= !isset($data_cek['status_pengajuan'])?'-':($data_cek['status_pengajuan'] == 'tolak'?'disabled':''); ?>
                            name="tolak" title="Aksi Tolak" class="btn btn-danger"> <i
                                class="nav-icon fas fa-times"></i>
                            Tolak</button>
                        <?php endif;?>
                        <a href="?page=pengajuan" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 

    if(isset($_POST['terima'])){
        $pesan_tolak = NULL;
        $sql_cek = "UPDATE tb_pengajuan SET status='terima', pesan_penolakan='$pesan_tolak', verifikasi='1'
        WHERE id_pengajuan='" . $data_cek['id_pengajuan'] . "'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        echo "<script>
         window.location = '';
        </script>";
    }elseif(isset($_POST['tolak'])){
        $pesan_tolak = htmlspecialchars($_POST['pesan-ditolak']);
        $sql_cek = "UPDATE tb_pengajuan SET status='tolak', pesan_penolakan='$pesan_tolak', verifikasi='1'
        WHERE id_pengajuan='" . $data_cek['id_pengajuan'] . "'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        echo "<script>
        window.location = '';
       </script>";
    }

?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('pengajuan');
    var tolakButton = document.querySelector('[name="tolak"]');
    tolakButton.addEventListener('click', function(event) {
        var pesanDitolak = document.querySelector('[name="pesan-ditolak"]');
        if (pesanDitolak.value.trim() === '') {
            alert('Pesan ditolak wajib diisi!');
            event.preventDefault();
        }
    });
});
</script>