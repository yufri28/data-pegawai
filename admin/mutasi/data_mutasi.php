<?php
$sql = $koneksi->query("SELECT * FROM data_mutasi dm JOIN data_pegawai dpg ON dm.id_pegawai=dpg.id_pegawai");
?>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i> Data Mutasi
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-mutasi" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Data</a>
                <?php if (mysqli_num_rows($sql) > 0) : ?>
                    <a href="./report/cetak-data-mutasi.php" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i>
                        Laporan</a>
                <?php endif; ?>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 450px;">Nama</th>
                        <th style="width: 350px;">Tempat Mutasi</th>
                        <th style="width: 330px;">Jenis Mutasi</th>
                        <th style="width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    while ($data = $sql->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['nama']; ?>
                            </td>
                            <td>
                                <?php echo $data['tempat_mutasi']; ?>
                            </td>
                            <td>
                                <?php echo $data['jenis_mutasi']; ?>
                            </td>

                            <td>
                                <a href="?page=view-mutasi&kode=<?php echo $data['id_mutasi']; ?>" title="Detail" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                </a>
                                <a href="?page=edit-mutasi&kode=<?php echo $data['id_mutasi']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=del-mutasi&kode=<?php echo $data['id_mutasi']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.card-body -->