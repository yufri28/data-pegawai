<?php
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=data-pegawai';
        }
    })</script>";
}
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM data_pegawai dp JOIN periode p ON dp.id_periode=p.id_periode JOIN tb_unit u ON u.id_unit=dp.f_id_unit WHERE id_pegawai='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Detail Pegawai</h3>

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
                                <?php echo $data_cek['nip']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Nama</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['nama']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Alamat</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['alamat']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Masa Kerja</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['masa_kerja']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Tempat Lahir</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tempat_lahir']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Tanggal Lahir</b>
                            </td>
                            <td>:
                                <?php echo date('d F Y', strtotime($data_cek['tanggal_lahir'] ??'0000-00-00')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Jenis Kelamin</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['jk']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Agama</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['agama']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Status Pegawai</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['status']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Periode</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tahun']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b><?= !isset($data_cek['skpp']) ? '-' : ($data_cek['status'] == 'Honor' ? 'SK Pengangkatan Pertama' : 'SK Pengangkatan CPNS'); ?></b>
                            </td>
                            <td>:
                                <?= !isset($data_cek['skpp']) ? '-' : date('d F Y', strtotime($data_cek['skpp']??'0000-00-00')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b><?= !isset($data_cek['skpp']) ? '-' : ($data_cek['status'] == 'Honor' ? 'SK Pengangkatan Terakhir' : 'SK Pensiun'); ?></b>
                            </td>
                            <td>:
                                <?= !isset($data_cek['skpt']) ? '-' : date('d F Y', strtotime($data_cek['skpt']??'0000-00-00')); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Unit</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['nama_unit']??'-'; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                    <a href="?page=data-pegawai" class="btn btn-warning">Kembali</a>
                    <a href="./report/cetak-pegawai.php?kode=<?php echo $data_cek['id_pegawai']; ?>" target="_blank"
                        title="Cetak Data Pegawai" class="btn btn-primary">Print</a>
                </div>
            </div>
        </div>
    </div>
</div>