<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM data_mutasi WHERE id_mutasi='".$_GET['kode']."'";
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
                    <input type="hidden" name="id_mutasi" value="<?=$data_cek['id_mutasi'];?>">
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
                <label class="col-sm-2 col-form-label">Tempat Mutasi</label>
                <div class="col-sm-5">
                    <input required class="form-control" type="text" id="tempat_mutasi"
                        value="<?=$data_cek['tempat_mutasi'];?>" name="tempat_mutasi">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Mutasi</label>
                <div class="col-sm-5">
                    <select required id="jenis_mutasi" name="jenis_mutasi" class="form-control">
                        <option value="">- Pilih -</option>
                        <option <?= $data_cek['jenis_mutasi'] == 'Masuk' ?'selected':'';?> value="Masuk">Masuk</option>
                        <option <?= $data_cek['jenis_mutasi'] == 'Keluar' ?'selected':'';?> value="Keluar">Keluar
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-mutasi" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
	
	if (isset($_POST['Ubah'])){
        $sql_ubah = "UPDATE data_mutasi SET
		id_pegawai='".$_POST['id_pegawai']."', 
		tempat_mutasi='".$_POST['tempat_mutasi']."', 
		jenis_mutasi='".$_POST['jenis_mutasi']."' WHERE id_mutasi='".$_POST['id_mutasi']."'";
		$query_ubah = mysqli_query($koneksi, $sql_ubah);
		if ($query_ubah) {
			echo "<script>
			Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=data-mutasi';
				}
			})</script>";
		}else{
			echo "<script>
			Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=add-mutasi';
				}
			})</script>";
		}
	}