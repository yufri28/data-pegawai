<?php
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=data-pendidikan';
        }
    })</script>";
}
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM data_pendidikan dpd JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai WHERE id_pendidikan='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>
<div class="row">

    <div class="col-md-10">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Detail Pendidikan</h3>

                <div class="card-tools">
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 200px">
                                <b>Nama</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['nama']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px">
                                <b>Tahun Lulus</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tahun_lulus']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px">
                                <b>Jurusan</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['jurusan']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px">
                                <b>Pendidikan Terakhir</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['pendidikan_terakhir']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px">
                                <b>Lembaga Pendidikan</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['lembaga_pendidikan']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px">
                                <b>Kursus/Diklat</b>
                            </td>
                            <td>:
                                <?= !isset($data_cek['kursus_diklat']) ?'-':($data_cek['kursus_diklat'] != NULL ? $data_cek['kursus_diklat'] : '-'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px">
                                <b>Pendidikan Perjenjangan</b>
                            </td>
                            <td>:
                                <?= !isset($data_cek['pend_perjenjangan'])?'-':($data_cek['pend_perjenjangan'] != NULL ? $data_cek['pend_perjenjangan'] : '-'); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                    <a href="?page=data-pendidikan" class="btn btn-warning">Kembali</a>
                    <a href="./report/cetak-data-pendidikan.php?kode=<?php echo $data_cek['id_pegawai']; ?>"
                        target="_blank" title="Cetak Data Mutasi" class="btn btn-primary">Print</a>
                </div>
            </div>
        </div>
    </div>
</div>