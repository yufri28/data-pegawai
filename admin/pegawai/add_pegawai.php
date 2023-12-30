<?php 

$get_data_periode = "SELECT * FROM periode";
$data_periode = mysqli_query($koneksi, $get_data_periode);

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
                <label class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-5">
                    <select name="jk" id="jk" class="form-control">
                        <option>- Pilih -</option>
                        <option>Laki-Laki</option>
                        <option>Perempuan</option>
                        <option>Tidak diketahui</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                        placeholder="Tempat Lahir" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                        placeholder="Tanggal Lahir" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No HP</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Pegawai</label>
                <div class="col-sm-5">
                    <select name="status" id="status" required class="form-control">
                        <option>- Pilih -</option>
                        <option>Tetap</option>
                        <option>Honor</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-5">
                    <select required name="agama" id="agama" class="form-control">
                        <option>- Pilih -</option>
                        <option>Kristen</option>
                        <option>Islam</option>
                        <option>Katolik</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                        <option>Khonghucu</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-5">
                    <select required name="id_periode" id="id_periode" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php foreach ($data_periode as $key => $periode):?>
                        <option value="<?=$periode['id_periode'];?>"><?=$periode['tahun'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">SKPP</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="skpp" name="skpp" required>
                    <small><i>Tanggal SK Pengangkatan Pertama (Honor) atau Tanggal SK Pengangkatan CPNS (PNS)</i></small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">SKPT</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="skpt" name="skpt" required>
                    <small><i>Tanggal SK Pengangkatan Terakhir (Honor) atau Tanggal SK Pensiun (PNS)</i></small>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-pegawai" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
    if (isset($_POST['Simpan'])){
		$sql_simpan = "INSERT INTO data_pegawai (nip, nama, alamat, no_hp, tempat_lahir, tanggal_lahir, jk, agama, status,id_periode,skpp,skpt) VALUES (
			'".htmlspecialchars($_POST['nip'])."',
			'".htmlspecialchars($_POST['nama'])."',
			'".htmlspecialchars($_POST['alamat'])."',
			'".htmlspecialchars($_POST['no_hp'])."',
			'".htmlspecialchars($_POST['tempat_lahir'])."',
			'".htmlspecialchars($_POST['tanggal_lahir'])."',
			'".htmlspecialchars($_POST['jk'])."',
			'".htmlspecialchars($_POST['agama'])."',
			'".htmlspecialchars($_POST['status'])."',
            '".htmlspecialchars($_POST['id_periode'])."',
            '".htmlspecialchars($_POST['skpp'])."',
            '".htmlspecialchars($_POST['skpt'])."')";
		$query_simpan = mysqli_query($koneksi, $sql_simpan);
		mysqli_close($koneksi);

		if ($query_simpan) {
			echo "<script>
			Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=data-pegawai';
				}
			})</script>";
			}else{
			echo "<script>
			Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=add-pegawai';
				}
			})</script>";
		}
	}
     //selesai proses simpan data