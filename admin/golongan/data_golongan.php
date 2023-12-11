<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i> Data Golongan
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex">
                <a href="?page=add-golongan" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Data</a>
                <?php if (mysqli_num_rows($sql) > 0) : ?>
                    <div class="dropdown ml-1">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-print"></i> Laporan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" target="_blank" href="./report/cetak-data-golongan.php">Semua</a></li>
                            <li><a class="dropdown-item" target="_blank" href="./report/cetak-data-golongan.php?st=ttp">Tetap</a></li>
                            <li><a class="dropdown-item" target="_blank" href="./report/cetak-data-golongan.php?st=hnr">Honorer</a></li>
                        </ul>
                    </div>
                    <div class="dropdown ml-1">
                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter"></i> Filter Periode
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=data-golongan">Semua</a></li>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM periode");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <li><a class="dropdown-item" href="?page=data-golongan&ip=<?= base64_encode($data['id_periode']); ?>"><?= $data['tahun']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 400px;">Nama</th>
                        <th style="width: 300px;">Golongan</th>
                        <th style="width: 210px;">Tanggal Mulai Terhitung</th>
                        <th style="width: 290px;">Jumlah Gaji</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    if (isset($_GET['ip'])) {
                        $id_periode =  base64_decode($_GET['ip']);
                        $sql = $koneksi->query("SELECT * FROM data_golongan dg JOIN data_pegawai dpg ON dg.id_pegawai=dpg.id_pegawai WHERE dpg.id_periode='$id_periode'");
                    } else {
                        $sql = $koneksi->query("SELECT * FROM data_golongan dg JOIN data_pegawai dpg ON dg.id_pegawai=dpg.id_pegawai");
                    }
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
                                <?php echo $data['golongan']; ?>
                            </td>
                            <td>
                                <?php echo $data['tmt']; ?>
                            </td>
                            <td>
                                <?php echo 'Rp. ' . number_format($data['jumlah_gaji'], 0, ',', '.'); ?>

                            </td>
                            <td>
                                <a href="?page=view-golongan&kode=<?php echo $data['id_golongan']; ?>" title="Detail" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                </a>
                                <a href="?page=edit-golongan&kode=<?php echo $data['id_golongan']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=del-golongan&kode=<?php echo $data['id_golongan']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
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