<?php
if (isset($_POST['simpan-per'])) {
    $sql_check = "SELECT * FROM periode WHERE tahun='" . $_POST['periode'] . "'";
    $query_check = mysqli_query($koneksi, $sql_check);

    if (mysqli_num_rows($query_check) > 0) {
        echo "<script>
        Swal.fire({title: 'Data periode tersebut sudah ada!',text: '',icon: 'warning',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = '';
            }
        })</script>";
    } else {
        $sql_simpan = "INSERT INTO periode (tahun) VALUES ('" . $_POST['periode'] . "')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        // mysqli_close($koneksi);
        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = '';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = '';
                }
            })</script>";
        }
    }
}
if (isset($_POST['edit-per'])) {
    $sql_update = "UPDATE periode SET tahun='" . $_POST['periode'] . "' WHERE id_periode='" . $_POST['id_periode'] . "'";
    $query_update = mysqli_query($koneksi, $sql_update);
    // mysqli_close($koneksi);
    if ($query_update) {
        echo "<script>
        Swal.fire({title: 'Update Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = '';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Update Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = '';
            }
        })</script>";
    }
}
if (isset($_POST['hapus-per'])) {
    $sql_update = "DELETE FROM periode WHERE id_periode='" . $_POST['id_periode'] . "'";
    $query_update = mysqli_query($koneksi, $sql_update);
    // mysqli_close($koneksi);
    if ($query_update) {
        echo "<script>
        Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = '';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = '';
            }
        })</script>";
    }
}
?>
<div class="card card-info col-lg-8">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i> Data Pegawai
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah-periode">
                    <i class="fa fa-plus"></i> Periode
                </button>
            </div>
            <br>
            <table id="example3" class="table text-center nowrap table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 370px;">Periode</th>
                        <th style="width: 429px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $periode = $koneksi->query("SELECT * FROM periode");
                    while ($data = $periode->fetch_assoc()) {
                    ?>

                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['tahun']; ?>
                            </td>
                            <td>
                                </a>
                                <button type="button" data-toggle="modal" data-target="#edit-periode<?= $data['id_periode']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data-toggle="modal" data-target="#hapus-periode<?= $data['id_periode']; ?>" title="Hapus" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<form action="" method="post">
    <div class="modal fade" id="tambah-periode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah periode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Periode</label>
                            <input type="text" class="form-control" id="periode" name="periode" placeholder="Periode" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="simpan-per" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
?>
<?php
$sql = $koneksi->query("SELECT * FROM periode");
while ($data = $sql->fetch_assoc()) { ?>
    <form action="" method="post">
        <div class="modal fade" id="edit-periode<?= $data['id_periode']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah periode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Periode</label>
                                <input type="hidden" value="<?= $data['id_periode']; ?>" class="form-control" id="id_periode" name="id_periode" required>
                                <input type="text" value="<?= $data['tahun']; ?>" class="form-control" id="periode" name="periode" placeholder="Periode" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="edit-per" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
<?php
$sql = $koneksi->query("SELECT * FROM periode");
while ($data = $sql->fetch_assoc()) { ?>
    <form action="" method="post">
        <div class="modal fade" id="hapus-periode<?= $data['id_periode']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah periode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="hidden" value="<?= $data['id_periode']; ?>" class="form-control" id="id_periode" name="id_periode" required>
                                <p>Apakah anda ingin menghapus data periode <strong><?= $data['tahun']; ?></strong> ?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="hapus-per" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>