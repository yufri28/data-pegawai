<?php
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=data-pensiun';
        }
    })</script>";
}
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM data_pensiun WHERE id_pensiun='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
	$get_data_pegawai = "SELECT * FROM data_pegawai";
	$data_pegawai = mysqli_query($koneksi, $get_data_pegawai);

?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data
        </h3>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-5">
                    <input type="hidden" name="id_pensiun" value="<?=$data_cek['id_pensiun'];?>">
                    <input type="hidden" name="id_pegawai" value="<?=$data_cek['id_pegawai'];?>">
                    <select disabled name="id_pegawai" id="id_pegawai" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php foreach ($data_pegawai as $key => $pegawai):?>
                        <option <?= $pegawai['id_pegawai'] == $data_cek['id_pegawai'] ?'selected':'';?>
                            value="<?=$pegawai['id_pegawai'];?>"><?= $pegawai['nama'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Pensiun</label>
                <div class="col-sm-5">
                    <input required class="form-control" type="number" id="tahun_pensiun"
                        value="<?=$data_cek['tahun_pensiun'];?>" name="tahun_pensiun" min="1900" max="2099" step="1">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-5">
                    <input type="text" value="<?=$data_cek['jabatan_terakhir']??'-';?>" class="form-control"
                        id="jabatan_terakhir" name="jabatan_terakhir" placeholder="Jabatan Terakhir" required>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-pensiun" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
	
	if (isset($_POST['Ubah'])){
        $sql_ubah = "UPDATE data_pensiun SET
		id_pegawai='".$_POST['id_pegawai']."', 
		tahun_pensiun='".$_POST['tahun_pensiun']."', 
		jabatan_terakhir='".$_POST['jabatan_terakhir']."' WHERE id_pensiun='".$_POST['id_pensiun']."'";
		$query_ubah = mysqli_query($koneksi, $sql_ubah);
		if ($query_ubah) {
			echo "<script>
			Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=data-pensiun';
				}
			})</script>";
		}else{
			echo "<script>
			Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=add-pensiun';
				}
			})</script>";
		}
	}