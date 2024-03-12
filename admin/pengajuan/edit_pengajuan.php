<?php
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=pengajuan';
        }
    })</script>";
}
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM data_pegawai dp 
                JOIN periode p ON dp.id_periode=p.id_periode
                JOIN tb_pengajuan tp ON tp.f_id_pegawai=dp.id_pegawai 
                WHERE tp.id_pengajuan='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
$get_data_periode = "SELECT * FROM periode";
$data_periode = mysqli_query($koneksi, $get_data_periode);

$get_data_pangkat = "SELECT * FROM tb_pangkat";
$data_pangkat = mysqli_query($koneksi, $get_data_pangkat);

$get_data_unit = "SELECT * FROM tb_unit WHERE id_unit != 1";
$data_unit = mysqli_query($koneksi, $get_data_unit);

$ses_unit = $_SESSION['ses_unit'];

if($ses_unit == 1){
    $get_data_pegawai = "SELECT * FROM data_pegawai";
}else{
    $get_data_pegawai = "SELECT * FROM data_pegawai WHERE f_id_unit='$ses_unit'";
}

$data_pegawai = mysqli_query($koneksi, $get_data_pegawai);


?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Pegawai <small class="text-danger">*</small></label>
                <div class="col-sm-5">
                    <select required name="id_pegawai" id="id_pegawai" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php foreach ($data_pegawai as $key => $pegawai) : ?>
                        <option <?= $pegawai['id_pegawai'] == $data_cek['id_pegawai']?'selected':'';?>
                            value="<?= $pegawai['id_pegawai']; ?>"><?= $pegawai['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- Form Group untuk Select Box -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pangkat yang diajukan <small
                        class="text-danger">*</small></label>
                <div class="col-sm-5">
                    <select name="pangkat_diajukan" required id="pangkat_diajukan" class="form-control"
                        onchange="checkIfOther(this.value)">
                        <option>- Pilih -</option>
                        <?php foreach ($data_pangkat as $key => $pangkat):?>
                        <option <?=$pangkat['nama_pangkat'] == $data_cek['pangkat_diajukan']?'selected':'';?>
                            value="<?=$pangkat['nama_pangkat'];?>"><?=$pangkat['nama_pangkat'];?></option>
                        <?php endforeach;?>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <!-- Input untuk pangkat lainnya -->
                    <input type="text" name="pangkat_lainnya" id="pangkat_lainnya" class="form-control"
                        style="display:none;" placeholder="Masukkan pangkat lainnya">
                </div>
            </div>

            <!-- Script untuk inisialisasi Select2 dan fungsi-fungsi lainnya -->
            <script>
            // Fungsi untuk menampilkan input pangkat lainnya jika opsi "Lainnya" dipilih
            function checkIfOther(selectedValue) {
                var pangkatLainnyaInput = document.getElementById('pangkat_lainnya');
                if (selectedValue === 'Lainnya') {
                    pangkatLainnyaInput.style.display = 'block';
                    pangkatLainnyaInput.required = true;
                } else {
                    pangkatLainnyaInput.style.display = 'none';
                    pangkatLainnyaInput.required = false;
                }
            }
            </script>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Pengajuan <small class="text-danger">*</small></label>
                <div class="col-sm-5">
                    <input type="date" value="<?=$data_cek['tanggal_pengajuan'];?>" class="form-control"
                        id="tanggal_pengajuan" name="tanggal_pengajuan" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30"
                        rows="5"><?=$data_cek['keterangan']??'';?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dokumen (pdf)</label>
                <div class="col-sm-5">
                    <input type="file" accept=".pdf" class="form-control" id="dokumen" name="dokumen">
                    <input type="hidden" accept=".pdf" class="form-control" name="dokumen_lama"
                        value="<?=$data_cek['dokumen'];?>">
                    <small><i>Semua dokumen dibuat 1 file pdf</i></small>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=pengajuan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    $pangkat_diajukan = htmlspecialchars($_POST['pangkat_diajukan']);
    $keterangan = isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : NULL;
    $tanggal_pengajuan = htmlspecialchars($_POST['tanggal_pengajuan']);
    $status = 'tunggu';
    $pesan_penolakan = NULL;
    $id_pengajuan = htmlspecialchars($_GET['kode']);
    $dokumen_lama = $_POST['dokumen_lama'];

    // Cek apakah ada file dokumen yang diunggah
    if ($_FILES['dokumen']['name'] != '') {
        // File baru diunggah, proses unggah baru dan hapus file lama
        $target_dir = "./dokumen/";
        $target_file = $target_dir . basename($_FILES["dokumen"]["name"]);
        $nama_file = basename($_FILES["dokumen"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi tipe file
        if ($fileType != "pdf") {
            echo "<script>alert('Hanya file PDF yang diizinkan.');</script>";
            $uploadOk = 0;
        }

        // Cek ukuran file (contoh: maksimal 10 MB)
        if ($_FILES["dokumen"]["size"] > 10000000) {
            echo "<script>alert('Ukuran file terlalu besar. Maksimal 10 MB.'); </script>";
            $uploadOk = 0;
        }

        // Cek jika $uploadOk bernilai 0
        if ($uploadOk == 0) {
            echo "<script>alert('File tidak diunggah.');</script>";
        } else {
            // Hapus file dokumen lama jika ada
            if (file_exists($target_dir . $dokumen_lama)) {
                unlink($target_dir . $dokumen_lama);
            }

            // Mengecek apakah file dengan nama yang sama sudah ada
            $counter = 1;
            while (file_exists($target_file)) {
                $nama_file = pathinfo($nama_file, PATHINFO_FILENAME) . "_$counter.$fileType";
                $target_file = $target_dir . $nama_file;
                $counter++;
            }

            // Pindahkan file baru ke folder berkas
            if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $target_file)) {
                // File baru berhasil diunggah, update data dengan dokumen baru
                $sql_ubah = "UPDATE tb_pengajuan SET
                    pangkat_diajukan='$pangkat_diajukan',
                    dokumen='$nama_file',
                    keterangan='$keterangan',
                    tanggal_pengajuan='$tanggal_pengajuan',
                    status='$status',
                    pesan_penolakan='$pesan_penolakan'
                    WHERE id_pengajuan='$id_pengajuan'";
            } else {
                echo "<script>alert('Terjadi kesalahan saat mengunggah file.');</script>";
                exit(); // Berhenti eksekusi script karena terjadi kesalahan unggah file
            }
        }

    } else {
        // Tidak ada file baru diunggah, gunakan dokumen lama
        $sql_ubah = "UPDATE tb_pengajuan SET
            pangkat_diajukan='$pangkat_diajukan',
            dokumen='$dokumen_lama',
            keterangan='$keterangan',
            tanggal_pengajuan='$tanggal_pengajuan',
            status='$status',
            pesan_penolakan='$pesan_penolakan'
            WHERE id_pengajuan='$id_pengajuan'";
    }

    // Eksekusi query update
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>
            Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=pengajuan';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=pengajuan';
                }
            });
        </script>";
    }
}
?>