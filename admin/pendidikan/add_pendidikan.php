<?php

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
                <label class="col-sm-2 col-form-label">Tahun Lulus</label>
                <div class="col-sm-5">
                    <input required class="form-control" type="number" placeholder="Tahun lulus" id="tahun_lulus"
                        name="tahun_lulus" min="1900" max="2099" step="1">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                <div class="col-sm-5">
                    <select required id="pendidikan_terakhir" name="pendidikan_terakhir" class="form-control">
                        <option value="">- Pilih -</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="DI">DI</option>
                        <option value="DII">DII</option>
                        <option value="DIII">DIII</option>
                        <option value="DIV">DIV</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lembaga Pendidikan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="lembaga_pendidikan" name="lembaga_pendidikan"
                        placeholder="Nama lembaga pendidikan" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kursus/Diklat</label>
                <div class="col-sm-5">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Kursus atau Diklat" name="kursus_diklat"
                            style="height: 100px"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pendidikan Perjenjangan</label>
                <div class="col-sm-5">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Pendidikan Perjenjangan" name="pend_perjenjangan"
                            style="height: 100px"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-pendidikan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Simpan'])) {
    $id_pegawai = $_POST['id_pegawai'];
    $tahun_lulus = $_POST['tahun_lulus'];
    $jurusan = $_POST['jurusan'];
    $pendidikan_terakhir = $_POST['pendidikan_terakhir'];
    $lembaga_pendidikan = $_POST['lembaga_pendidikan'];
    $kursus_diklat = $_POST['kursus_diklat'];
    $pend_perjenjangan = $_POST['pend_perjenjangan'];

    // Buat kueri SELECT untuk memeriksa apakah id_pegawai sudah ada
    $sql_cek = "SELECT COUNT(*) FROM data_pendidikan WHERE id_pegawai = '$id_pegawai'";
    $result_cek = mysqli_query($koneksi, $sql_cek);

    if ($result_cek) {
        $row = mysqli_fetch_array($result_cek);
        $count = $row[0];

        if ($count > 0) {
            // id_pegawai sudah ada dalam tabel, tampilkan pesan kesalahan
            echo "<script>
				Swal.fire({title: 'Peringatan!', text: 'Data pendidikan tersebut sudah tersimpan sebelumnya!.', icon: 'warning', confirmButtonText: 'OK'});
			</script>";
        } else {
            // id_pegawai belum ada, lakukan penyimpanan data
            $sql_simpan = "INSERT INTO data_pendidikan (id_pegawai,tahun_lulus,jurusan,pendidikan_terakhir,lembaga_pendidikan,kursus_diklat,pend_perjenjangan) VALUES (
				'$id_pegawai',
				'$tahun_lulus',
				'$jurusan',
				'$pendidikan_terakhir',
				'$lembaga_pendidikan',
                '$kursus_diklat',
                '$pend_perjenjangan')";
            $query_simpan = mysqli_query($koneksi, $sql_simpan);
            if ($query_simpan) {
                echo "<script>
					Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'}).then((result) => {
						if (result.value) {
							window.location = 'index.php?page=data-pendidikan';
						}
					});
				</script>";
            } else {
                echo "<script>
					Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'}).then((result) => {
						if (result.value) {
							window.location = 'index.php?page=add-pendidikan';
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