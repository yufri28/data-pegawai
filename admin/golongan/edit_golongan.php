<?php
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=data-golongan';
        }
    })</script>";
}
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM data_golongan WHERE id_golongan='".$_GET['kode']."'";
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
                    <input type="hidden" name="id_golongan" value="<?=$data_cek['id_golongan'];?>">
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
                <label class="col-sm-2 col-form-label">Golongan</label>
                <div class="col-sm-5">
                    <input type="text" value="<?= $data_cek['golongan']??'-';?>" class="form-control" id="golongan"
                        name="golongan" placeholder="Golongan" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Mulai Terhitung</label>
                <div class="col-sm-5">
                    <input type="date" value="<?=$data_cek['tmt']??'-';?>" class="form-control" id="tmt" name="tmt"
                        placeholder="Tanggal Mulai Terhitung" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Gaji</label>
                <div class="col-sm-5">
                    <input type="number" value="<?=$data_cek['jumlah_gaji']??'-';?>" class="form-control" min="1"
                        id="jumlah_gaji" name="jumlah_gaji" placeholder="Jumlah Gaji" required>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-golongan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
	
	if (isset($_POST['Ubah'])){
        $sql_ubah = "UPDATE data_golongan SET
		id_pegawai='".$_POST['id_pegawai']."', 
		golongan='".$_POST['golongan']."', 
		tmt='".$_POST['tmt']."', 
        jumlah_gaji='".$_POST['jumlah_gaji']."' WHERE id_golongan='".$_POST['id_golongan']."'";
		$query_ubah = mysqli_query($koneksi, $sql_ubah);
		if ($query_ubah) {
			echo "<script>
			Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=data-golongan';
				}
			})</script>";
		}else{
			echo "<script>
			Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=add-golongan';
				}
			})</script>";
		}
	}