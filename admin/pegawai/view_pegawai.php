<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * from data_pegawai dp JOIN periode p ON dp.id_periode=p.id_periode WHERE nip='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
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
                                <?php echo $data_cek['nip']; ?>
                            </td>
                        </tr>
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
                                <b>Alamat</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['alamat']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>No HP</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['no_hp']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Tempat Lahir</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tempat_lahir']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Tanggal Lahir</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tanggal_lahir']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Jenis Kelamin</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['jk']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Agama</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['agama']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Status Pegawai</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['status']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Periode</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tahun']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                    <a href="?page=data-pegawai" class="btn btn-warning">Kembali</a>

                    <a href="./report/cetak-pegawai.php?nip=<?php echo $data_cek['nip']; ?>" target=" _blank"
                        title="Cetak Data Pegawai" class="btn btn-primary">Print</a>
                </div>
            </div>
        </div>
    </div>
</div>