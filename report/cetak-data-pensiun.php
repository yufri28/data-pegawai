<?php
	include "../inc/koneksi.php";
	
    if(isset($_GET['nip'])){
        $nip = $_GET['nip'];
        $sql_tampil = "SELECT * FROM data_pensiun dps JOIN data_pegawai dpg ON dps.id_pegawai=dpg.id_pegawai WHERE dpg.nip='$nip'";
    }else{
        $sql_tampil = "SELECT * FROM data_pensiun dps JOIN data_pegawai dpg ON dps.id_pegawai=dpg.id_pegawai";
    }

	$sql_cek = "SELECT * FROM tb_profil";
	$query_cek = mysqli_query($koneksi, $sql_cek);
	$data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
	{
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>CETAK DATA PENSIUN</title>
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
			$no=1;
            
            echo "<center><h4><u>DATA PENSIUN</u></h4></center>";
                ?>

    </center>

    <table border="1" cellspacing="0" style="width: 100%; border-collapse: collapse; text-wrap:wrap;">
        <thead>
            <tr style="text-align: center;">
                <th style="padding: 15px;">NIP</th>
                <th style="padding: 15px;">Nama</th>
                <th style="padding: 15px;">Tahun Pensiun</th>
                <th style="padding: 15px;">Jabatan Terakhir</th>

            </tr>
        </thead>
        <tbody>
            <?php while($data = mysqli_fetch_array($query_tampil,MYSQLI_BOTH)):?>
            <tr>
                <td>
                    <?php echo $data['nip']; ?>
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
            </tr>
            <br>
            <?php endwhile; ?>
        </tbody>
    </table>


    <script>
    window.print();
    </script>

</body>

</html>