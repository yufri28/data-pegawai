<?php
session_start();
include "../inc/koneksi.php";
$st = '';
$ses_unit = $_SESSION['ses_unit'];
if($ses_unit == 1){
    if (isset($_GET['kode'])) {
        $id_pegawai = $_GET['kode'];
        $sql_tampil = "SELECT 
                            dp.*, 
                            COALESCE(dg.golongan, '-') AS nama_golongan, 
                            COALESCE(dj.nama, '-') AS nama_jabatan, 
                            COALESCE(dpd.pendidikan_terakhir, '-') AS pendidikan_terakhir,
                            COALESCE(u.nama_unit, '-') AS nama_unit 
                            FROM data_pegawai dp 
                            LEFT JOIN data_golongan dg ON dg.id_pegawai = dp.id_pegawai 
                            LEFT JOIN data_jabatan dj ON dj.id_pegawai = dp.id_pegawai 
                            LEFT JOIN data_pendidikan dpd ON dpd.id_pegawai = dp.id_pegawai
                            LEFT JOIN tb_unit u ON u.id_unit = dp.f_id_unit
                            WHERE dp.id_pegawai='$id_pegawai'";
    } else {
        if (isset($_GET["st"])) {
            switch ($_GET['st']) {
                case 'ttp':
                    $st = 'Tetap';
                    break;
                case 'hnr':
                    $st = 'Honor';
                    break;
            }
            $sql_tampil = "SELECT 
            dp.*, 
            COALESCE(dg.golongan, '-') AS nama_golongan, 
            COALESCE(dj.nama, '-') AS nama_jabatan, 
            COALESCE(dpd.pendidikan_terakhir, '-') AS pendidikan_terakhir,
            COALESCE(u.nama_unit, '-') AS nama_unit
            FROM data_pegawai dp 
            LEFT JOIN data_golongan dg ON dg.id_pegawai = dp.id_pegawai 
            LEFT JOIN data_jabatan dj ON dj.id_pegawai = dp.id_pegawai 
            LEFT JOIN data_pendidikan dpd ON dpd.id_pegawai = dp.id_pegawai
            LEFT JOIN tb_unit u ON u.id_unit = dp.f_id_unit 
            WHERE dp.status='$st';";
        } else {
            $sql_tampil = "SELECT 
            dp.*, 
            COALESCE(dg.golongan, '-') AS nama_golongan, 
            COALESCE(dj.nama, '-') AS nama_jabatan, 
            COALESCE(dpd.pendidikan_terakhir, '-') AS pendidikan_terakhir,
            COALESCE(u.nama_unit, '-') AS nama_unit
            FROM data_pegawai dp 
            LEFT JOIN data_golongan dg ON dg.id_pegawai = dp.id_pegawai 
            LEFT JOIN data_jabatan dj ON dj.id_pegawai = dp.id_pegawai 
            LEFT JOIN data_pendidikan dpd ON dpd.id_pegawai = dp.id_pegawai
            LEFT JOIN tb_unit u ON u.id_unit = dp.f_id_unit;";
        }
    }
}else{
    if (isset($_GET['kode'])) {
        $id_pegawai = $_GET['kode'];
        $sql_tampil = "SELECT 
                            dp.*, 
                            COALESCE(dg.golongan, '-') AS nama_golongan, 
                            COALESCE(dj.nama, '-') AS nama_jabatan, 
                            COALESCE(dpd.pendidikan_terakhir, '-') AS pendidikan_terakhir,
                            COALESCE(u.nama_unit, '-') AS nama_unit 
                            FROM data_pegawai dp 
                            LEFT JOIN data_golongan dg ON dg.id_pegawai = dp.id_pegawai 
                            LEFT JOIN data_jabatan dj ON dj.id_pegawai = dp.id_pegawai 
                            LEFT JOIN data_pendidikan dpd ON dpd.id_pegawai = dp.id_pegawai
                            LEFT JOIN tb_unit u ON u.id_unit = dp.f_id_unit
                            WHERE dp.id_pegawai='$id_pegawai' AND dp.f_id_unit='$ses_unit'";
    } else {
        if (isset($_GET["st"])) {
            switch ($_GET['st']) {
                case 'ttp':
                    $st = 'Tetap';
                    break;
                case 'hnr':
                    $st = 'Honor';
                    break;
            }
            $sql_tampil = "SELECT 
            dp.*, 
            COALESCE(dg.golongan, '-') AS nama_golongan, 
            COALESCE(dj.nama, '-') AS nama_jabatan, 
            COALESCE(dpd.pendidikan_terakhir, '-') AS pendidikan_terakhir,
            COALESCE(u.nama_unit, '-') AS nama_unit
            FROM data_pegawai dp 
            LEFT JOIN data_golongan dg ON dg.id_pegawai = dp.id_pegawai 
            LEFT JOIN data_jabatan dj ON dj.id_pegawai = dp.id_pegawai 
            LEFT JOIN data_pendidikan dpd ON dpd.id_pegawai = dp.id_pegawai
            LEFT JOIN tb_unit u ON u.id_unit = dp.f_id_unit 
            WHERE dp.status='$st' AND dp.f_id_unit='$ses_unit';";
        } else {
            $sql_tampil = "SELECT 
            dp.*, 
            COALESCE(dg.golongan, '-') AS nama_golongan, 
            COALESCE(dj.nama, '-') AS nama_jabatan, 
            COALESCE(dpd.pendidikan_terakhir, '-') AS pendidikan_terakhir,
            COALESCE(u.nama_unit, '-') AS nama_unit
            FROM data_pegawai dp 
            LEFT JOIN data_golongan dg ON dg.id_pegawai = dp.id_pegawai 
            LEFT JOIN data_jabatan dj ON dj.id_pegawai = dp.id_pegawai 
            LEFT JOIN data_pendidikan dpd ON dpd.id_pegawai = dp.id_pegawai
            LEFT JOIN tb_unit u ON u.id_unit = dp.f_id_unit 
            WHERE dp.f_id_unit='$ses_unit';";
        }
    }
}

$sql_cek = "SELECT * FROM tb_profil";
$query_cek = mysqli_query($koneksi, $sql_cek);
$data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH); {
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>CETAK DATA PEGAWAI</title>
    <style>
    .titik-dua {
        text-align: center;
    }

    th {
        padding: 5px 0;
    }

    td {
        padding-left: 7px;
    }

    table {
        font-size: 7pt;
    }
    </style>
</head>

<body>
    <center style="margin: 0 -95px">
        <div style="display: flex; margin: 0 80px">
            <img src="../foto/logo-ntt.jpeg" style="width: 100px; height: 100px;" alt="">
            <div class="">
                <h2 style="display: flex; margin-left: 5px">
                    <?php echo $data_cek['nama_profil']; ?>
                </h2>
                <h3>
                    <?php echo $data_cek['alamat']; ?>
                </h3>
            </div>
        </div>
        <hr size="2px" color="black">
        <?php
    }


    $query_tampil = mysqli_query($koneksi, $sql_tampil);
    $no = 1;
    if (mysqli_num_rows($query_tampil) < 1) {
        echo "<script>alert('Tidak ada data yang dapat dicetak!');window.location.href='../index.php?page=data-pegawai'</script>";
    }
    echo "<center><h4><u>DATA PEGAWAI</u></h4></center>";
        ?>

    </center>

    <table border="1" cellspacing="0" style="width: 100%; border-collapse: collapse; text-wrap:wrap;" align="center">
        <thead>
            <tr style="text-align: center;">
                <th style="padding: 15px;">NIP</th>
                <th style="padding: 15px;">Nama</th>
                <th style="padding: 5px;">Masa Kerja</th>
                <th style="padding: 20px;">Tempat Lahir</th>
                <th style="padding: 20px;">Tanggal Lahir</th>
                <th style="padding: 5px;">Jenis Kelamin</th>
                <th style="padding: 5px;">Agama</th>
                <th style="padding: 5px;">Status</th>
                <th style="padding: 5px;">Alamat</th>
                <th style="padding: 5px;">Golongan</th>
                <th style="padding: 5px;">Pendidikan</th>
                <th style="padding: 15px;">Jabatan</th>
                <th style="padding: 15px;">SKPP</th>
                <th style="padding: 15px;">SKPT</th>
                <th style="padding: 15px;">Unit</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) : ?>
            <tr>
                <td>
                    <?php echo $data['nip']; ?>
                </td>
                <td>
                    <?php echo $data['nama']; ?>
                </td>
                <td>
                    <?php echo $data['masa_kerja']; ?>
                </td>
                <td>
                    <?php echo $data['tempat_lahir']; ?>
                </td>
                <td>
                    <?php echo date('d-m-Y', strtotime($data['tanggal_lahir'])); ?>
                </td>
                <td>
                    <?php echo $data['jk']; ?>
                </td>
                <td>
                    <?php echo $data['agama']; ?>
                </td>
                <td>
                    <?php echo $data['status']; ?>
                </td>
                <td>
                    <?php echo $data['alamat']; ?>
                </td>
                <td>
                    <?php echo $data['nama_golongan']; ?>
                </td>
                <td>
                    <?php echo $data['pendidikan_terakhir']; ?>
                </td>
                <td>
                    <?php echo $data['nama_jabatan']; ?>
                </td>
                <td style='text-align:center'>
                    <?= $data['skpp'] == NULL ? '-' : date('d-m-Y', strtotime($data['skpp'])); ?>
                </td>
                <td style='text-align:center'>
                    <?= $data['skpt'] == NULL ? '-' : date('d-m-Y', strtotime($data['skpt'])); ?>
                </td>
                <td>
                    <?php echo $data['nama_unit']; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script>
    window.print();
    </script>

</body>

</html>