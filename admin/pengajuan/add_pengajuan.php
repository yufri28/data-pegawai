<?php
if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=pengajuan';
        }
    })</script>";
}
$get_data_periode = "SELECT * FROM periode";
$data_periode = mysqli_query($koneksi, $get_data_periode);

$get_data_pangkat = "SELECT * FROM tb_pangkat";
$data_pangkat = mysqli_query($koneksi, $get_data_pangkat);

$ses_unit = $_SESSION['ses_unit'];

if($ses_unit == 1){
    $get_data_unit = "SELECT * FROM tb_unit WHERE id_unit != 1";
    $get_data_pegawai = "SELECT * FROM data_pegawai WHERE status='Tetap'";
}else{
    $get_data_unit = "SELECT * FROM tb_unit WHERE id_unit = '$ses_unit'";
    $get_data_pegawai = "SELECT * FROM data_pegawai WHERE f_id_unit='$ses_unit' AND status='Tetap'";
}

$data_unit = mysqli_query($koneksi, $get_data_unit);
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
                <label class="col-sm-2 col-form-label">Nama Pegawai <small class="text-danger">*</small></label>
                <div class="col-sm-5">
                    <select required name="id_pegawai" id="id_pegawai" class="form-control">
                        <option value="">- Pilih -</option>
                        <?php foreach ($data_pegawai as $key => $pegawai) : ?>
                        <option value="<?= $pegawai['id_pegawai']; ?>"><?= $pegawai['nama']; ?></option>
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
                        <option value="<?=$pangkat['nama_pangkat'];?>"><?=$pangkat['nama_pangkat'];?></option>
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
                    <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dokumen (pdf) <small class="text-danger">*</small></label>
                <div class="col-sm-5">
                    <input type="file" accept=".pdf" class="form-control" id="dokumen" name="dokumen" required>
                    <small><i>Semua dokumen dibuat 1 file pdf</i></small>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=pengajuan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Simpan'])) {
    $pangkat_diajukan = htmlspecialchars($_POST['pangkat_diajukan']);
    $pangkat_lainnya = htmlspecialchars($_POST['pangkat_lainnya']);

    if($pangkat_diajukan == 'Lainnya' && $pangkat_lainnya != NULL){
        $pangkat_diajukan = $pangkat_lainnya;
        $insert_data_pangkat = "INSERT INTO `tb_pangkat` (`id_pangkat`, `nama_pangkat`) 
                            VALUES (NULL, '$pangkat_diajukan');";
        $result_insert_pangkat = mysqli_query($koneksi, $insert_data_pangkat);
    }

    $keterangan = isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']):NULL;
    $tanggal_pengajuan = htmlspecialchars($_POST['tanggal_pengajuan']);
    $status = 'tunggu';
    $pesan_penolakan = NULL;
    $id_pegawai = htmlspecialchars($_POST['id_pegawai']);
   // File upload
    $target_dir = "./dokumen/";
    $uploaded_filename = basename($_FILES["dokumen"]["name"]);
    $target_file = $target_dir . $uploaded_filename;
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
        // Mengecek apakah file dengan nama yang sama sudah ada
        $counter = 1;
        while (file_exists($target_file)) {
            $uploaded_filename = pathinfo($uploaded_filename, PATHINFO_FILENAME) . "_$counter.$fileType";
            $target_file = $target_dir . $uploaded_filename;
            $counter++;
        }

        // Jika semuanya valid, coba unggah file
        if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $target_file)) {
            // Query SQL untuk menyimpan data
            // Cek apakah id_pegawai dan pangkat_diajukan sudah ada
            $sql_cek_pengajuan = "SELECT COUNT(*) as jumlah_pengajuan FROM tb_pengajuan WHERE f_id_pegawai = '$id_pegawai' AND pangkat_diajukan = '$pangkat_diajukan'";
            $result_cek_pengajuan = mysqli_query($koneksi, $sql_cek_pengajuan);
            $row_cek_pengajuan = mysqli_fetch_assoc($result_cek_pengajuan);

            if ($row_cek_pengajuan['jumlah_pengajuan'] > 0) {
                echo "<script>alert('Pegawai ini sudah mengajukan pangkat tersebut.');</script>";
            } else {
                // File baru berhasil diunggah, update data dengan dokumen baru
                $sql_simpan = "INSERT INTO tb_pengajuan (pangkat_diajukan, dokumen, keterangan, tanggal_pengajuan, status, pesan_penolakan, f_id_pegawai, verifikasi, created_at, updated_at) VALUES (
                    '$pangkat_diajukan',
                    '$uploaded_filename',
                    '$keterangan',
                    '$tanggal_pengajuan',
                    '$status',
                    '$pesan_penolakan',
                    '$id_pegawai',
                    '0',
                    NOW(),
                    NOW())";

                // Eksekusi query
                $query_simpan = mysqli_query($koneksi, $sql_simpan);
                mysqli_close($koneksi);

                if ($query_simpan) {
                    echo "<script>
                        Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'}).then((result) => {
                            if (result.value) {
                                window.location = 'index.php?page=pengajuan';
                            }
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'}).then((result) => {
                            if (result.value) {
                                window.location = 'index.php?page=add-pengajuan';
                            }
                        });
                    </script>";
                }
            }

        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah file.');</script>";
        }
    }

}

     //selesai proses simpan data