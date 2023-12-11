<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM data_mutasi dps JOIN data_pegawai dpg ON dps.id_pegawai=dpg.id_pegawai WHERE id_mutasi='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class="row">

    <div class="col-md-10">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Detail Mutasi</h3>

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
                                <b>Tempat Mutasi</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tempat_mutasi']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Jenis Mutasi</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['jenis_mutasi']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                    <a href="?page=data-mutasi" class="btn btn-warning">Kembali</a>

                    <a href="./report/cetak-data-mutasi.php?nip=<?php echo $data_cek['nip']; ?>" target="_blank"
                        title="Cetak Data Mutasi" class="btn btn-primary">Print</a>
                </div>
            </div>
        </div>
    </div>
</div>