<?php 
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=data-golongan';
        }
    })</script>";
}
$ses_unit = $_SESSION['ses_unit'];
if($ses_unit == 1){
	$get_data_pegawai = "SELECT * FROM data_pegawai";
}else{
	$get_data_pegawai = "SELECT * FROM data_pegawai WHERE f_id_unit='$ses_unit'";
}
$data_pegawai = mysqli_query($koneksi, $get_data_pegawai);

?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data
        </h3>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-5">
                    <select required name="id_pegawai" id="id_pegawai" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php foreach ($data_pegawai as $key => $pegawai):?>
                        <option value="<?=$pegawai['id_pegawai'];?>"><?= $pegawai['nama'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Golongan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="golongan" name="golongan" placeholder="Golongan"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Mulai Terhitung</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="tmt" name="tmt" placeholder="Tanggal Mulai Terhitung"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Gaji</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" min="1" id="jumlah_gaji" name="jumlah_gaji"
                        placeholder="Jumlah Gaji" required>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-golongan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
  if (isset($_POST['Simpan'])) {
	$id_pegawai = $_POST['id_pegawai'];
	$golongan = $_POST['golongan'];
	$tmt = $_POST['tmt'];
	$jumlah_gaji = $_POST['jumlah_gaji'];
	// id_pegawai belum ada, lakukan penyimpanan data
	$sql_simpan = "INSERT INTO data_golongan(golongan,tmt,jumlah_gaji,id_pegawai) VALUES (
		'$golongan',
		'$tmt',
		'$jumlah_gaji',
		'$id_pegawai'
		)";
	$query_simpan = mysqli_query($koneksi, $sql_simpan);
	if ($query_simpan) {
		echo "<script>
			Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'}).then((result) => {
				if (result.value) {
					window.location = 'index.php?page=data-golongan';
				}
			});
		</script>";
	} else {
		echo "<script>
			Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'}).then((result) => {
				if (result.value) {
					window.location = 'index.php?page=add-golongan';
				}
			});
		</script>";
	}		
	mysqli_close($koneksi);
}

 //selesai proses simpan data