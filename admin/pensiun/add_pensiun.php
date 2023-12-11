<?php 

$get_data_pegawai = "SELECT * FROM data_pegawai";
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
                <label class="col-sm-2 col-form-label">Tahun Pensiun</label>
                <div class="col-sm-5">
                    <input required class="form-control" type="number" id="tahun_pensiun" name="tahun_pensiun"
                        min="1900" max="2099" step="1">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="jabatan_terakhir" name="jabatan_terakhir"
                        placeholder="Jabatan Terakhir" required>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-pensiun" title="Kembali" class="btn btn-secondary ml-1">Batal</a>
        </div>
    </form>
</div>

<?php
	
    if (isset($_POST['Simpan'])) {
		$id_pegawai = $_POST['id_pegawai'];
		$tahun_pensiun = $_POST['tahun_pensiun'];
		$jabatan_terakhir = $_POST['jabatan_terakhir'];
	
		// Buat kueri SELECT untuk memeriksa apakah id_pegawai sudah ada
		$sql_cek = "SELECT COUNT(*) FROM data_pensiun WHERE id_pegawai = '$id_pegawai'";
		$result_cek = mysqli_query($koneksi, $sql_cek);
	
		if ($result_cek) {
			$row = mysqli_fetch_array($result_cek);
			$count = $row[0];
	
			if ($count > 0) {
				// id_pegawai sudah ada dalam tabel, tampilkan pesan kesalahan
				echo "<script>
					Swal.fire({title: 'Peringatan!', text: 'Data pensiun tersebut sudah tersimpan sebelumnya!.', icon: 'warning', confirmButtonText: 'OK'});
				</script>";
			} else {
				// id_pegawai belum ada, lakukan penyimpanan data
				$sql_simpan = "INSERT INTO data_pensiun (id_pegawai, tahun_pensiun, jabatan_terakhir) VALUES (
					'$id_pegawai',
					'$tahun_pensiun',
					'$jabatan_terakhir')";
				$query_simpan = mysqli_query($koneksi, $sql_simpan);
	
				if ($query_simpan) {
					echo "<script>
						Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'}).then((result) => {
							if (result.value) {
								window.location = 'index.php?page=data-pensiun';
							}
						});
					</script>";
				} else {
					echo "<script>
						Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'}).then((result) => {
							if (result.value) {
								window.location = 'index.php?page=add-pensiun';
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