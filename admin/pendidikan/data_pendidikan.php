<?php
$sql = $koneksi->query("SELECT * FROM data_pendidikan dpd JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai");

?>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i> Data Pendidikan
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-pendidikan" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Data</a>
                <?php if (mysqli_num_rows($sql) > 0) : ?>
                    <a href="./report/cetak-data-pendidikan.php" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i>
                        Laporan</a>
                <?php endif; ?>
            </div>
            <br>
            <table id="example1" class="table nowrap table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 210px;">Nama</th>
                        <th style="width: 140px;">Tahun Lulus</th>
                        <th style="width: 280px;">Jurusan</th>
                        <th style="width: 110px;">Pendidikan Terakhir</th>
                        <th style="width: 400px;">Lembaga Pendidikan</th>
                        <th style="width: 90px;">Aksi</th>
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
                                <?php echo $data['tahun_lulus']; ?>
                            </td>
                            <td>
                                <?php echo $data['jurusan']; ?>
                            </td>
                            <td>
                                <?php echo $data['pendidikan_terakhir']; ?>
                            </td>
                            <td>
                                <?php echo $data['lembaga_pendidikan']; ?>
                            </td>

                            <td>
                                <a href="?page=view-pendidikan&kode=<?php echo $data['id_pendidikan']; ?>" title="Detail" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                </a>
                                <a href="?page=edit-pendidikan&kode=<?php echo $data['id_pendidikan']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=del-pendidikan&kode=<?php echo $data['id_pendidikan']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
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