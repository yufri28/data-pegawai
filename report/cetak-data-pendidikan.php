<?php
session_start();
include "../inc/koneksi.php";

$st = "";
$ses_unit = $_SESSION['ses_unit'];

if($ses_unit == 1){
    if (isset($_GET['nip'])) {
        $nip = $_GET['nip'];
        $sql_tampil = "SELECT * FROM data_pendidikan dpd 
                        JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai 
                        WHERE dpg.nip='$nip'";
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
            $sql_tampil = "SELECT * FROM data_pendidikan dpd 
                            JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai 
                            WHERE dpg.status='$st'";
        } else {
            $sql_tampil = "SELECT * FROM data_pendidikan dpd 
                            JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai";
        }
    }
}else{
    if (isset($_GET['nip'])) {
        $nip = $_GET['nip'];
        $sql_tampil = "SELECT * FROM data_pendidikan dpd 
                        JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai 
                        JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                        WHERE dpg.nip='$nip' AND dpg.f_id_unit='$ses_unit'";
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
            $sql_tampil = "SELECT * FROM data_pendidikan dpd 
                            JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai 
                            JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                            WHERE dpg.status='$st' AND dpg.f_id_unit='$ses_unit'";
        } else {
            $sql_tampil = "SELECT * FROM data_pendidikan dpd 
                            JOIN data_pegawai dpg ON dpd.id_pegawai=dpg.id_pegawai
                            JOIN tb_unit u ON u.id_unit=dpg.f_id_unit
                            WHERE dpg.f_id_unit='$ses_unit'";
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
    <title>CETAK DATA PENDIDIKAN</title>
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
        echo "<script>alert('Tidak ada data yang dapat dicetak!');window.location.href='../index.php?page=data-mutasi'</script>";
    }
    echo "<center><h4><u>DATA PENDIDIKAN</u></h4></center>";
        ?>

    </center>


    <table border="1" cellspacing="0" style="width: 100%; border-collapse: collapse; text-wrap:wrap;">
        <thead>
            <tr style="text-align: center;">
                <th style="padding: 15px;">NIP</th>
                <th style="padding: 15px;">Nama</th>
                <th style="padding: 15px;">Tahun Lulus</th>
                <th style="padding: 15px;">Jurusan</th>
                <th style="padding: 15px;">Pendidikan Terakhir</th>
                <th style="padding: 15px;">Nama Lembaga Pendidikan</th>
                <th style="padding: 15px;">Kursus/Diklat</th>
                <th style="padding: 15px;">Pendidikan Perjenjangan</th>

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
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>


    <script>
    window.print();
    </script>

</body>

</html>