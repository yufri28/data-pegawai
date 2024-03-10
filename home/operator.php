<?php

        $sql_cek = "SELECT * FROM tb_profil";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
		{

		
?>
<?php
		}
    $ses_unit = $_SESSION['ses_unit'];

    if($ses_unit == 1){
        $sql = $koneksi->query("SELECT count(nip) AS lokal FROM data_pegawai");
    }else{
        $sql = $koneksi->query("SELECT count(nip) AS lokal FROM data_pegawai WHERE f_id_unit='$ses_unit'");
    }
	while ($data= $sql->fetch_assoc()) {
	
		$lokal=$data['lokal'];
	}
?>

<?php

    if($ses_unit == 1){
        $sql = $koneksi->query("SELECT count(nip) AS tetap FROM data_pegawai WHERE status='Tetap'");
    }else{
        $sql = $koneksi->query("SELECT count(nip) AS tetap FROM data_pegawai WHERE status='Tetap' AND f_id_unit='$ses_unit'");
    }
	while ($data= $sql->fetch_assoc()) {
	
		$tetap=$data['tetap'];
	}
?>

<?php

    if($ses_unit == 1){
        $sql = $koneksi->query("SELECT count(nip) AS honor FROM data_pegawai WHERE status='Honor'");
    }else{
        $sql = $koneksi->query("SELECT count(nip) AS honor FROM data_pegawai WHERE status='Honor' AND f_id_unit='$ses_unit'");
    }
	while ($data= $sql->fetch_assoc()) {
	
		$honor=$data['honor'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_pengguna) AS boyong FROM tb_pengguna");
	while ($data= $sql->fetch_assoc()) {
	
		$boyong=$data['boyong'];
	}
?>

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>
                    <?php echo $lokal;  ?>
                </h3>

                <p>Jumlah Pegawai</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="index.php?page=data-pegawai" class="small-box-footer">Selengkapnya
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>
                    <?php echo $tetap;  ?>
                </h3>

                <p>Status Pegawai</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">-
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    <?php echo $honor; ?>
                </h3>

                <p>Status Honorer</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">-
            </a>
        </div>
    </div>
    <!-- ./col -->
    <?php if($ses_unit == 1):?>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>
                    <?php echo $boyong;  ?>
                </h3>

                <p>Pengguna Sistem</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-happy"></i>
            </div>
            <a href="#" class="small-box-footer">-
            </a>
        </div>
    </div>
    <?php endif;?>