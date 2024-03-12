<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-users"></i> Data Pendidikan
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex">
                <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                <a href="?page=add-pendidikan" class="btn btn-primary">
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
                        <li><a class="dropdown-item" target="_blank" href="./report/cetak-data-pendidikan.php">Semua</a>
                        </li>
                        <li><a class="dropdown-item" target="_blank"
                                href="./report/cetak-data-pendidikan.php?st=ttp">Tetap</a></li>
                        <li><a class="dropdown-item" target="_blank"
                                href="./report/cetak-data-pendidikan.php?st=hnr">Honorer</a></li>
                    </ul>
                </div>
                <?php endif;?>
                <div class="dropdown ml-1">
                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-filter"></i> Filter Periode
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=data-pendidikan">Semua</a></li>
                        <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM periode");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                        <li><a class="dropdown-item"
                                href="?page=data-pendidikan&ip=<?= base64_encode($data['id_periode']); ?>"><?= $data['tahun']; ?></a>
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
                        <li><a class="dropdown-item" href="?page=data-pendidikan">Semua</a></li>
                        <?php
                        $data_gol = $koneksi->query("SELECT DISTINCT golongan FROM data_golongan");
                        while ($golongan = $data_gol->fetch_assoc()) {
                        ?>
                        <li><a class="dropdown-item"
                                href="?page=data-pendidikan&gol=<?= base64_encode($golongan['golongan']); ?>"><?= strtoupper($golongan['golongan']); ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
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
                        <th style="width: 110px;">Kursus/Diklat</th>
                        <th style="width: 400px;">Pendidikan Perjenjangan</th>
                        <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                        <th style="width: 90px;">Aksi</th>
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
                                "SELECT * FROM data_pendidikan dpd 
                                JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai 
                                WHERE dpg.id_periode='$id_periode'");
                        } elseif(isset($_GET['gol'])) {
                            $gol =  base64_decode($_GET['gol']);
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pendidikan dpd 
                                JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai 
                                JOIN data_golongan dg ON dg.id_pegawai=dpg.id_pegawai 
                                WHERE LOWER(dg.golongan) = LOWER('$gol')");
                        }else {
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pendidikan dpd 
                                JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai");
                        }
                    }else{
                        if (isset($_GET['ip'])) {
                            $id_periode =  base64_decode($_GET['ip']);
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pendidikan dpd 
                                JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai 
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                                WHERE dpg.id_periode='$id_periode' AND dpg.f_id_unit='$ses_unit'");
                        } elseif(isset($_GET['gol'])) {
                            $gol =  base64_decode($_GET['gol']);
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pendidikan dpd 
                                JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai 
                                JOIN data_golongan dg ON dg.id_pegawai=dpg.id_pegawai 
                                JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                                WHERE LOWER(dg.golongan) = LOWER('$gol') AND dpg.f_id_unit='$ses_unit'");
                        }else {
                            $sql = $koneksi->query(
                                "SELECT * FROM data_pendidikan dpd 
                                JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai
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
                            <?= $data['kursus_diklat'] != NULL ? $data['kursus_diklat'] : '-'; ?>
                        </td>
                        <td>
                            <?= $data['pend_perjenjangan'] != NULL ? $data['pend_perjenjangan'] : '-'; ?>
                        </td>
                        <?php if($_SESSION['ses_level'] == "Administrator" || $_SESSION['ses_level'] == "Operator"):?>
                        <td>
                            <a href="?page=view-pendidikan&kode=<?php echo $data['id_pendidikan']; ?>" title="Detail"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                            </a>
                            <a href="?page=edit-pendidikan&kode=<?php echo $data['id_pendidikan']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=del-pendidikan&kode=<?php echo $data['id_pendidikan']; ?>"
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