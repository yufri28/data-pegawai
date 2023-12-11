<?php
$sql = $koneksi->query("SELECT *, dj.nama AS nama_jabatan FROM data_jabatan dj JOIN data_pegawai dpg ON dj.id_pegawai=dpg.id_pegawai");
?>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i> Data Jabatan
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-jabatan" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Data</a>
                <?php if (mysqli_num_rows($sql) > 0) : ?>
                    <a href="./report/cetak-data-jabatan.php" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i>
                        Laporan</a>
                <?php endif; ?>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 290px;">NIP</th>
                        <th style="width: 290px;">Nama</th>
                        <th style="width: 470px;">Jabatan</th>
                        <th style="width: 100px;">Eselon</th>
                        <th style="width: 210px;">Tanggal Mulai Terhitung</th>
                        <th style="width: 120px;">Aksi</th>
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
                                <?php echo $data['nip']; ?>
                            </td>
                            <td>
                                <?php echo $data['nama']; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_jabatan']; ?>
                            </td>
                            <td>
                                <?php echo $data['eselon']; ?>
                            </td>
                            <td>
                                <?php echo $data['tmt']; ?>
                            </td>
                            <td>
                                <a href="?page=view-jabatan&kode=<?php echo $data['id_jabatan']; ?>" title="Detail" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                </a>
                                <a href="?page=edit-jabatan&kode=<?php echo $data['id_jabatan']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=del-jabatan&kode=<?php echo $data['id_jabatan']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
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