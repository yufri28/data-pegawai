<?php
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=data-jabatan';
        }
    })</script>";
}
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT *, dj.nama AS nama_jabatan FROM data_jabatan dj JOIN data_pegawai dpg ON dj.id_pegawai=dpg.id_pegawai WHERE id_jabatan='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class="row">

    <div class="col-md-10">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Detail Jabatan</h3>

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
                                <?php echo $data_cek['nama']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Nama Jabatan</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['nama_jabatan']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Eselon</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['eselon']??'-'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">
                                <b>Tanggal Mulai Terhitung</b>
                            </td>
                            <td>:
                                <?php echo $data_cek['tmt']??'-'; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                    <a href="?page=data-jabatan" class="btn btn-warning">Kembali</a>
                    <a href="./report/cetak-data-jabatan.php?kode=<?php echo $data_cek['id_pegawai']; ?>"
                        target="_blank" title="Cetak Data Jabatan" class="btn btn-primary">Print</a>
                </div>
            </div>
        </div>
    </div>
</div>