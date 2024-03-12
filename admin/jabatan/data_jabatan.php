<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i> Data Jabatan
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex">
                <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                <a href="?page=add-jabatan" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Data</a>
                <?php endif;?>
                <?php if (mysqli_num_rows($sql) > 0) : ?>
                <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                <div class="dropdown ml-1">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-print"></i> Laporan
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" target="_blank" href="./report/cetak-data-jabatan.php">Semua</a>
                        </li>
                        <li><a class="dropdown-item" target="_blank"
                                href="./report/cetak-data-jabatan.php?st=ttp">Tetap</a></li>
                        <li><a class="dropdown-item" target="_blank"
                                href="./report/cetak-data-jabatan.php?st=hnr">Honorer</a></li>
                    </ul>
                </div>
                <?php endif;?>
                <div class="dropdown ml-1">
                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-filter"></i> Filter Periode
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=data-jabatan">Semua</a></li>
                        <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM periode");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                        <li><a class="dropdown-item"
                                href="?page=data-jabatan&ip=<?= base64_encode($data['id_periode']); ?>"><?= $data['tahun']; ?></a>
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
                        <li><a class="dropdown-item" href="?page=data-jabatan">Semua</a></li>
                        <?php
                        $data_gol = $koneksi->query("SELECT DISTINCT golongan FROM data_golongan");
                        while ($golongan = $data_gol->fetch_assoc()) {
                        ?>
                        <li><a class="dropdown-item"
                                href="?page=data-jabatan&gol=<?= base64_encode($golongan['golongan']); ?>"><?= strtoupper($golongan['golongan']); ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
            <br>
            <table id="example1" class="table table-bordered nowrap table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 290px;">NIP</th>
                        <th style="width: 290px;">Nama</th>
                        <th style="width: 470px;">Jabatan</th>
                        <th style="width: 100px;">Eselon</th>
                        <th style="width: 210px;">Tanggal Mulai Terhitung</th>
                        <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                        <th style="width: 120px;">Aksi</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $ses_unit = $_SESSION['ses_unit'];

                    if($ses_unit == 1){
                        if (isset($_GET['ip'])) {
                            $id_periode =  base64_decode($_GET['ip']);
                            $sql = $koneksi->query(
                                    "SELECT *, dj.nama AS nama_jabatan 
                                    FROM data_jabatan dj 
                                    JOIN data_pegawai dpg ON dj.id_pegawai=dpg.id_pegawai 
                                    WHERE dpg.id_periode='$id_periode'");
                        }elseif(isset($_GET['gol'])) {
                            $gol =  base64_decode($_GET['gol']);
                            $sql = $koneksi->query(
                                "SELECT *, dj.nama AS nama_jabatan 
                                FROM data_jabatan dj 
                                JOIN data_pegawai dpg 
                                ON dj.id_pegawai=dpg.id_pegawai 
                                JOIN data_golongan dg ON dg.id_pegawai=dpg.id_pegawai 
                                WHERE LOWER(dg.golongan) = LOWER('$gol')");
                        }else {
                            $sql = $koneksi->query(
                                "SELECT *, dj.nama AS nama_jabatan 
                                FROM data_jabatan dj 
                                JOIN data_pegawai dpg ON dj.id_pegawai=dpg.id_pegawai");
                        }
                    }else{
                        if (isset($_GET['ip'])) {
                            $id_periode =  base64_decode($_GET['ip']);
                            $sql = $koneksi->query(
                                "SELECT *, dj.nama AS nama_jabatan 
                                FROM data_jabatan dj 
                                JOIN data_pegawai dpg ON dj.id_pegawai=dpg.id_pegawai
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit 
                                WHERE dpg.id_periode='$id_periode' AND dpg.f_id_unit='$ses_unit'");
                        }elseif(isset($_GET['gol'])) {
                            $gol =  base64_decode($_GET['gol']);
                            $sql = $koneksi->query(
                                "SELECT *, dj.nama AS nama_jabatan 
                                FROM data_jabatan dj 
                                JOIN data_pegawai dpg 
                                ON dj.id_pegawai=dpg.id_pegawai 
                                JOIN data_golongan dg ON dg.id_pegawai=dpg.id_pegawai
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                                WHERE LOWER(dg.golongan) = LOWER('$gol') AND dpg.f_id_unit='$ses_unit'");
                        }else {
                            $sql = $koneksi->query(
                                "SELECT *, dj.nama AS nama_jabatan 
                                FROM data_jabatan dj 
                                JOIN data_pegawai dpg ON dj.id_pegawai=dpg.id_pegawai
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
                        <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                        <td>
                            <a href="?page=view-jabatan&kode=<?php echo $data['id_jabatan']; ?>" title="Detail"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                            </a>
                            <a href="?page=edit-jabatan&kode=<?php echo $data['id_jabatan']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=del-jabatan&kode=<?php echo $data['id_jabatan']; ?>"
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