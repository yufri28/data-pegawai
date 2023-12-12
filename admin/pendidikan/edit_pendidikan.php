<?php

if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM data_pendidikan WHERE id_pendidikan='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
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
                    <input type="hidden" name="id_pendidikan" value="<?= $data_cek['id_pendidikan']; ?>">
                    <input type="hidden" name="id_pegawai" value="<?= $data_cek['id_pegawai']; ?>">
                    <select disabled name="id_pegawai" id="id_pegawai" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php foreach ($data_pegawai as $key => $pegawai) : ?>
                            <option <?= $pegawai['id_pegawai'] == $data_cek['id_pegawai'] ? 'selected' : ''; ?> value="<?= $pegawai['id_pegawai']; ?>"><?= $pegawai['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Lulus</label>
                <div class="col-sm-5">
                    <input required class="form-control" value="<?= $data_cek['tahun_lulus']; ?>" type="number" placeholder="Tahun lulus" id="tahun_lulus" name="tahun_lulus" min="1900" max="2099" step="1">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" value="<?= $data_cek['jurusan']; ?>" id="jurusan" name="jurusan" placeholder="Jurusan" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                <div class="col-sm-5">
                    <select required id="pendidikan_terakhir" name="pendidikan_terakhir" class="form-control">
                        <option value="">- Pilih -</option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "SD" ? 'selected' : ''; ?> value="SD">SD</option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "SMP" ? 'selected' : ''; ?> value="SMP">SMP</option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "SMA" ? 'selected' : ''; ?> value="SMA">SMA</option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "DI" ? 'selected' : ''; ?> value="DI">DI</option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "DII" ? 'selected' : ''; ?> value="DII">DII</option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "DIII" ? 'selected' : ''; ?> value="DIII">DIII
                        </option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "DIV" ? 'selected' : ''; ?> value="DIV">DIV</option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "S1" ? 'selected' : ''; ?> value="S1">S1</option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "S2" ? 'selected' : ''; ?> value="S2">S2</option>
                        <option <?= $data_cek['pendidikan_terakhir'] == "S3" ? 'selected' : ''; ?> value="S3">S3</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lembaga Pendidikan</label>
                <div class="col-sm-5">
                    <input type="text" value="<?= $data_cek['lembaga_pendidikan']; ?>" class="form-control" id="lembaga_pendidikan" name="lembaga_pendidikan" placeholder="Nama lembaga pendidikan" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kursus/Diklat</label>
                <div class="col-sm-5">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Kursus atau Diklat" name="kursus_diklat" style="height: 100px"><?= $data_cek['kursus_diklat']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pendidikan Perjenjangan</label>
                <div class="col-sm-5">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Pendidikan Perjenjangan" name="pend_perjenjangan" style="height: 100px"><?= $data_cek['pend_perjenjangan']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-pendidikan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

if (isset($_POST['Ubah'])) {
    $sql_ubah = "UPDATE data_pendidikan SET
		id_pegawai='" . $_POST['id_pegawai'] . "', 
		tahun_lulus='" . $_POST['tahun_lulus'] . "', 
		jurusan='" . $_POST['jurusan'] . "', 
		pendidikan_terakhir='" . $_POST['pendidikan_terakhir'] . "', 
		lembaga_pendidikan='" . $_POST['lembaga_pendidikan'] . "', 
		kursus_diklat='" . $_POST['kursus_diklat'] . "', 
		pend_perjenjangan='" . $_POST['pend_perjenjangan'] . "'
        WHERE id_pendidikan='" . $_POST['id_pendidikan'] . "'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    if ($query_ubah) {
        echo "<script>
			Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=data-pendidikan';
				}
			})</script>";
    } else {
        echo "<script>
			Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=add-pendidikan';
				}
			})</script>";
    }
}
