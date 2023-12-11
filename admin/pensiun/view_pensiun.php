<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM data_pensiun dps JOIN data_pegawai dpg ON dps.id_pegawai=dpg.id_pegawai WHERE id_pensiun='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class="row">

    <div class="col-md-10">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Detail Pensiun</h3>

                <div class="card-tools">
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 150px">
                                <b>Nama</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['nama']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Tahun Pensiun</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tahun_pensiun']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Jabatan Terakhir</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['jabatan_terakhir']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                    <a href="?page=data-pensiun" class="btn btn-warning">Kembali</a>

                    <a href="./report/cetak-data-pensiun.php?nip=<?php echo $data_cek['nip']; ?>" target=" _blank"
                        title="Cetak Data Pensiun" class="btn btn-primary">Print</a>
                </div>
            </div>
        </div>
    </div>
</div>