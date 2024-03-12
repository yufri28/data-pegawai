<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i> Data Pensiun
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex">
                <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                <a href="?page=add-pensiun" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Data</a>
                <?php endif;?>
                <?php if (mysqli_num_rows($sql) > 0) : ?>
                <!-- <a href="./report/cetak-data-pensiun.php" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i>
                        Laporan</a> -->
                <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                <div class="dropdown ml-1">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-print"></i> Laporan
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" target="_blank" href="./report/cetak-data-pensiun.php">Semua</a>
                        </li>
                        <li><a class="dropdown-item" target="_blank"
                                href="./report/cetak-data-pensiun.php?st=ttp">Tetap</a></li>
                        <li><a class="dropdown-item" target="_blank"
                                href="./report/cetak-data-pensiun.php?st=hnr">Honorer</a></li>
                    </ul>
                </div>
                <?php endif;?>
                <div class="dropdown ml-1">
                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-filter"></i> Filter Periode
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=data-pensiun">Semua</a></li>
                        <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM periode");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                        <li><a class="dropdown-item"
                                href="?page=data-pensiun&ip=<?= base64_encode($data['id_periode']); ?>"><?= $data['tahun']; ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="dropdown ml-1">
                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-filter"></i> Filter Golongan
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=data-pensiun">Semua</a></li>
                        <?php
                        $data_gol = $koneksi->query("SELECT DISTINCT golongan FROM data_golongan");
                        while ($golongan = $data_gol->fetch_assoc()) {
                        ?>
                        <li><a class="dropdown-item"
                                href="?page=data-pensiun&gol=<?= base64_encode($golongan['golongan']); ?>"><?= strtoupper($golongan['golongan']); ?></a>
                        </li>
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
                        <th style="width: 350px;">Nama</th>
                        <th style="width: 350px;">Tahun Pensiun</th>
                        <th style="width: 430px;">Jabatan Terakhir</th>
                        <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                        <th style="width: 230px;">Aksi</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $ses_unit = $_SESSION['ses_unit'];
                    $no = 1;

                    if($ses_unit == 1){
                        if (isset($_GET['ip'])) {
                            $id_periode =  base64_decode($_GET['ip']);
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pensiun dp 
                                JOIN data_pegawai dpg ON dp.id_pegawai=dpg.id_pegawai
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                                WHERE dpg.id_periode='$id_periode'");
                        } elseif(isset($_GET['gol'])) {
                            $gol =  base64_decode($_GET['gol']);
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pensiun dp 
                                JOIN data_pegawai dpg ON dp.id_pegawai=dpg.id_pegawai 
                                JOIN data_golongan dg ON dg.id_pegawai=dpg.id_pegawai 
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                                WHERE LOWER(dg.golongan) = LOWER('$gol')");
                        }else {
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pensiun dp 
                                JOIN data_pegawai dpg ON dp.id_pegawai=dpg.id_pegawai
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit");
                        }
                    }else{
                        if (isset($_GET['ip'])) {
                            $id_periode =  base64_decode($_GET['ip']);
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pensiun dp 
                                JOIN data_pegawai dpg ON dp.id_pegawai=dpg.id_pegawai
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                                WHERE dpg.id_periode='$id_periode' AND dpg.f_id_unit='$ses_unit'");
                        } elseif(isset($_GET['gol'])) {
                            $gol =  base64_decode($_GET['gol']);
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pensiun dp 
                                JOIN data_pegawai dpg ON dp.id_pegawai=dpg.id_pegawai 
                                JOIN data_golongan dg ON dg.id_pegawai=dpg.id_pegawai 
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                                WHERE LOWER(dg.golongan) = LOWER('$gol') AND dpg.f_id_unit='$ses_unit'");
                        }else {
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pensiun dp 
                                JOIN data_pegawai dpg ON dp.id_pegawai=dpg.id_pegawai
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                                WHERE dpg.f_id_unit='$ses_unit'");
                        }
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
                            <?php echo $data['tahun_pensiun']; ?>
                        </td>
                        <td>
                            <?php echo $data['jabatan_terakhir']; ?>
                        </td>
                        <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                        <td>
                            <a href="?page=view-pensiun&kode=<?php echo $data['id_pensiun']; ?>" title="Detail"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                            </a>
                            <a href="?page=edit-pensiun&kode=<?php echo $data['id_pensiun']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=del-pensiun&kode=<?php echo $data['id_pensiun']; ?>"
                                onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                        </td>
                        <?php endif;?>
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