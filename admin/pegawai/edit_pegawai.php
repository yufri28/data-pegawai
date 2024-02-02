<?php

if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM data_pegawai dp JOIN periode p ON dp.id_periode=p.id_periode WHERE id_pegawai='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
$get_data_periode = "SELECT * FROM periode";
$data_periode = mysqli_query($koneksi, $get_data_periode);

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
                <label class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-5">
                    <input type="hidden" value="<?= $data_cek['id_pegawai']; ?>" class="form-control" id="id_pegawai" name="id_pegawai" required>
                    <input type="text" value="<?= $data_cek['nip']; ?>" class="form-control" id="nip" name="nip" placeholder="NIP" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-5">
                    <input type="text" value="<?= $data_cek['nama']; ?>" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-5">
                    <select name="jk" id="jk" class="form-control">
                        <option>- Pilih -</option>
                        <option <?= $data_cek['jk'] == "Laki-Laki" ? "selected" : ""; ?>>Laki-Laki</option>
                        <option <?= $data_cek['jk'] == "Perempuan" ? "selected" : ""; ?>>Perempuan</option>
                        <option <?= $data_cek['jk'] == "Tidak diketahui" ? "selected" : ""; ?>>Tidak diketahui</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-5">
                    <input type="text" value="<?= $data_cek['tempat_lahir']; ?>" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-5">
                    <input type="date" value="<?= $data_cek['tanggal_lahir']; ?>" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Masa Kerja</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" value="<?= $data_cek['masa_kerja']; ?>" id="masa_kerja" name="masa_kerja" placeholder="Masa Kerja" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Pegawai</label>
                <div class="col-sm-5">
                    <select name="status" required id="status" class="form-control">
                        <option>- Pilih -</option>
                        <option <?= $data_cek['status'] == "Tetap" ? "selected" : ""; ?>>Tetap</option>
                        <option <?= $data_cek['status'] == "Honor" ? "selected" : ""; ?>>Honor</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-5">
                    <select name="agama" id="agama" class="form-control">
                        <option>- Pilih -</option>
                        <option <?= $data_cek['agama'] == "Kristen" ? "selected" : ""; ?>>Kristen</option>
                        <option <?= $data_cek['agama'] == "Islam" ? "selected" : ""; ?>>Islam</option>
                        <option <?= $data_cek['agama'] == "Katolik" ? "selected" : ""; ?>>Katolik</option>
                        <option <?= $data_cek['agama'] == "Hindu" ? "selected" : ""; ?>>Hindu</option>
                        <option <?= $data_cek['agama'] == "Buddha" ? "selected" : ""; ?>>Buddha</option>
                        <option <?= $data_cek['agama'] == "Khonghucu" ? "selected" : ""; ?>>Khonghucu</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="alamat" id="alamat" rows="3"><?= $data_cek['alamat']; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-5">
                    <select required name="id_periode" id="id_periode" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php foreach ($data_periode as $key => $periode) : ?>
                            <option <?= $data_cek['id_periode'] == $periode['id_periode'] ? 'selected' : ''; ?> value="<?= $periode['id_periode']; ?>"><?= $periode['tahun']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">SKPP</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" value="<?= $data_cek['skpp']; ?>" id="skpp" name="skpp" required>
                    <small><i>Tanggal SK Pengangkatan Pertama (Honor) atau Tanggal SK Pengangkatan CPNS (PNS)</i></small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">SKPT</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" value="<?= $data_cek['skpt']; ?>" id="skpt" name="skpt" required>
                    <small><i>Tanggal SK Pengangkatan Terakhir (Honor) atau Tanggal SK Pensiun (PNS)</i></small>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-pegawai" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

if (isset($_POST['Ubah'])) {
    $sql_ubah = "UPDATE data_pegawai SET
		nip='" . htmlspecialchars($_POST['nip']) . "',
		nama='" . htmlspecialchars($_POST['nama']) . "',
		alamat='" . htmlspecialchars($_POST['alamat']) . "',
		masa_kerja='" . htmlspecialchars($_POST['masa_kerja']) . "',
		tempat_lahir='" . htmlspecialchars($_POST['tempat_lahir']) . "',
		tanggal_lahir='" . htmlspecialchars($_POST['tanggal_lahir']) . "',
		jk='" . htmlspecialchars($_POST['jk']) . "',
		agama='" . htmlspecialchars($_POST['agama']) . "',
		status='" . htmlspecialchars($_POST['status']) . "',
		id_periode='" . htmlspecialchars($_POST['id_periode']) . "',
        skpp='" . htmlspecialchars($_POST['skpp']) . "',
        skpt='" . htmlspecialchars($_POST['skpt']) . "'
		WHERE id_pegawai='" . htmlspecialchars($_POST['id_pegawai']) . "'";

    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-pegawai';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-pegawai';
            }
        })</script>";
    }
}
