<i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i> Data Pegawai
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex">
                <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                <a href="?page=add-pegawai" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Data Pegawai</a>
                <!-- <a href="./report/cetak-pegawai.php" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Laporan</a> -->
                <div class="dropdown ml-1">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-print"></i> Laporan
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" target="_blank" href="./report/cetak-pegawai.php">Semua</a></li>
                        <li><a class="dropdown-item" target="_blank" href="./report/cetak-pegawai.php?st=ttp">Tetap</a>
                        </li>
                        <li><a class="dropdown-item" target="_blank"
                                href="./report/cetak-pegawai.php?st=hnr">Honorer</a></li>
                    </ul>
                </div>
                <?php endif;?>
                <div class="dropdown ml-1">
                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-filter"></i> Filter Periode
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=data-pegawai">Semua</a></li>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("SELECT * FROM periode"); 
                        while ($data = $sql->fetch_assoc()) {
                        ?>
                        <li><a class="dropdown-item"
                                href="?page=data-pegawai&ip=<?= base64_encode($data['id_periode']); ?>"><?= $data['tahun']; ?></a>
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
                        <li><a class="dropdown-item" href="?page=data-pegawai">Semua</a></li>
                        <?php
                        $data_gol = $koneksi->query("SELECT DISTINCT golongan FROM data_golongan");
                        while ($golongan = $data_gol->fetch_assoc()) {
                        ?>
                        <li><a class="dropdown-item"
                                href="?page=data-pegawai&gol=<?= base64_encode($golongan['golongan']); ?>"><?= strtoupper($golongan['golongan']); ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <br>
            <table id="example1" class="table nowrap table-bordered table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>Alamat</th>
                        <th>Masa Kerja</th>
                        <th>Periode</th>
                        <th>SKPP</th>
                        <th>SKPT</th>
                        <th>Unit</th>
                        <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                        <th>Aksi</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $unit = $_SESSION['ses_unit'];
                    if($unit == 1){
                        if (isset($_GET['ip'])) {
                            $id_periode =  base64_decode($_GET['ip']);
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pegawai dp 
                                JOIN periode p ON dp.id_periode=p.id_periode 
                                JOIN tb_unit u ON u.id_unit = dp.f_id_unit 
                                WHERE p.id_periode='$id_periode'");
                                
                        }elseif(isset($_GET['gol'])) {
                            $gol =  base64_decode($_GET['gol']);
                            $sql = $koneksi->query(
                                "SELECT *
                                FROM data_pegawai dp
                                JOIN data_golongan dg ON dp.id_pegawai = dg.id_pegawai
                                JOIN periode p ON dp.id_periode=p.id_periode
                                WHERE LOWER(dg.golongan) = LOWER('$gol')"
                                );
                        }
                        else {
                            $sql = $koneksi->query("SELECT * FROM data_pegawai dp JOIN periode p ON dp.id_periode=p.id_periode JOIN tb_unit u ON u.id_unit = dp.f_id_unit");
                        }
                    }else{

                        if (isset($_GET['ip'])) {
                            $id_periode =  base64_decode($_GET['ip']);
                            $sql = $koneksi->query("SELECT * FROM data_pegawai dp JOIN periode p ON dp.id_periode=p.id_periode JOIN tb_unit u ON u.id_unit = dp.f_id_unit WHERE p.id_periode='$id_periode' AND dp.f_id_unit='$unit'");
                        }elseif(isset($_GET['gol'])) {
                            $gol =  base64_decode($_GET['gol']);
                            $sql = $koneksi->query(
                                "SELECT *
                                FROM data_pegawai dp
                                JOIN data_golongan dg ON dp.id_pegawai = dg.id_pegawai
                                JOIN periode p ON dp.id_periode=p.id_periode
                                WHERE LOWER(dg.golongan) = LOWER('$gol') AND dp.f_id_unit='$unit'"
                                );
                        }
                        else {
                            $sql = $koneksi->query(
                                    "SELECT * FROM data_pegawai dp 
                                    JOIN periode p ON dp.id_periode=p.id_periode 
                                    JOIN tb_unit u ON u.id_unit = dp.f_id_unit 
                                    WHERE dp.f_id_unit='$unit'");
                        }
                    }
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
                            <?php echo $data['jk']; ?>
                        </td>
                        <td>
                            <?php echo $data['status']; ?>
                        </td>
                        <td>
                            <?php echo $data['tempat_lahir']; ?>
                        </td>
                        <td>
                            <?php echo date('d F Y', strtotime($data['tanggal_lahir'])); ?>
                        </td>
                        <td>
                            <?php echo $data['agama']; ?>
                        </td>
                        <td class="text-wrap">
                            <?php echo $data['alamat']; ?>
                        </td>
                        <td>
                            <?php echo $data['masa_kerja']; ?>
                        </td>
                        <td>
                            <?php echo $data['tahun']; ?>
                        </td>
                        <td>
                            <?= $data['skpp'] == NULL ? '-' : date('d F Y', strtotime($data['skpp'])); ?>
                        </td>
                        <td>
                            <?= $data['skpt'] == NULL ? '-' : date('d F Y', strtotime($data['skpt'])); ?>
                        </td>
                        <td>
                            <?php echo $data['nama_unit']; ?>
                        </td>
                        <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                        <td>
                            <a href="?page=view-pegawai&kode=<?php echo $data['id_pegawai']; ?>" title="Detail"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                            </a>
                            <a href="?page=edit-pegawai&kode=<?php echo $data['id_pegawai']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=del-pegawai&kode=<?php echo $data['id_pegawai']; ?>"
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
</div>