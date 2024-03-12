<?php
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=data-mutasi';
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
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-5">
                    <select required name="id_pegawai" id="id_pegawai" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php foreach ($data_pegawai as $key => $pegawai) : ?>
                        <option value="<?= $pegawai['id_pegawai']; ?>"><?= $pegawai['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Mutasi</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="tempat_mutasi" name="tempat_mutasi"
                        placeholder="Tempat Mutasi" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Mutasi</label>
                <div class="col-sm-5">
                    <select required id="jenis_mutasi" name="jenis_mutasi" class="form-control">
                        <option value="">- Pilih -</option>
                        <option value="Dinas Lama">Dinas Lama</option>
                        <option value="Dinas Baru">Dinas Baru</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-mutasi" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Simpan'])) {
	$id_pegawai = $_POST['id_pegawai'];
	$tempat_mutasi = $_POST['tempat_mutasi'];
	$jenis_mutasi = $_POST['jenis_mutasi'];

	// Buat kueri SELECT untuk memeriksa apakah id_pegawai sudah ada
	$sql_cek = "SELECT COUNT(*) FROM data_mutasi WHERE id_pegawai = '$id_pegawai'";
	$result_cek = mysqli_query($koneksi, $sql_cek);

	if ($result_cek) {
		$row = mysqli_fetch_array($result_cek);
		$count = $row[0];

		if ($count > 0) {
			// id_pegawai sudah ada dalam tabel, tampilkan pesan kesalahan
			echo "<script>
				Swal.fire({title: 'Peringatan!', text: 'Data mutasi tersebut sudah tersimpan sebelumnya!.', icon: 'warning', confirmButtonText: 'OK'});
			</script>";
		} else {
			// id_pegawai belum ada, lakukan penyimpanan data
			$sql_simpan = "INSERT INTO data_mutasi (id_pegawai, tempat_mutasi, jenis_mutasi) VALUES (
				'$id_pegawai',
				'$tempat_mutasi',
				'$jenis_mutasi')";
			$query_simpan = mysqli_query($koneksi, $sql_simpan);
			if ($query_simpan) {
				echo "<script>
					Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'}).then((result) => {
						if (result.value) {
							window.location = 'index.php?page=data-mutasi';
						}
					});
				</script>";
			} else {
				echo "<script>
					Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'}).then((result) => {
						if (result.value) {
							window.location = 'index.php?page=add-mutasi';
						}
					});
				</script>";
			}
		}
	} else {
		// Kueri SELECT gagal
		echo "<script>
			Swal.fire({title: 'Kesalahan dalam memeriksa data', text: '', icon: 'error', confirmButtonText: 'OK'});
		</script>";
	}

	mysqli_close($koneksi);
}

 //selesai proses simpan data