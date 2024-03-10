<?php

$get_data_periode = "SELECT * FROM periode";
$data_periode = mysqli_query($koneksi, $get_data_periode);

$ses_unit = $_SESSION['ses_unit'];

if($ses_unit == 1){
    $get_data_unit = "SELECT * FROM tb_unit WHERE id_unit != 1";
    $get_data_pegawai = "SELECT * FROM data_pegawai";
}else{
    $get_data_unit = "SELECT * FROM tb_unit WHERE id_unit = '$ses_unit'";
    $get_data_pegawai = "SELECT * FROM data_pegawai WHERE f_id_unit='$ses_unit'";
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
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pangkat yang diajukan <small
                        class="text-danger">*</small></label>
                <div class="col-sm-5">
                    <select name="pangkat_diajukan" required id="pangkat_diajukan" class="form-control">
                        <option>- Pilih -</option>
                        <option>Reguler (Fungsional Umum)</option>
                        <option>Reguler (Fungsional Khusus)</option>
                        <option>Non-Reguler</option>
                    </select>
                </div>
            </div>
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
    $keterangan = isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']):NULL;
    $tanggal_pengajuan = htmlspecialchars($_POST['tanggal_pengajuan']);
    $status = 'tunggu';
    $pesan_penolakan = NULL;
    $id_pegawai = htmlspecialchars($_POST['id_pegawai']);

    // File upload
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
        echo "<script>alert('Ukuran file terlalu besar. Maksimal 5 MB.'); </script>";
        $uploadOk = 0;
    }

    // Cek jika $uploadOk bernilai 0
    if ($uploadOk == 0) {
        echo "<script>alert('File tidak diunggah.');</script>";
    } else {
        // Jika semuanya valid, coba unggah file
        if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $target_file)) {
            // Query SQL untuk menyimpan data
            $sql_simpan = "INSERT INTO tb_pengajuan (pangkat_diajukan, dokumen, keterangan, tanggal_pengajuan, status, pesan_penolakan, f_id_pegawai,verifikasi,created_at,updated_at) VALUES (
                '$pangkat_diajukan',
                '$nama_file',
                '$keterangan',
                '$tanggal_pengajuan',
                '$status',
                '$pesan_penolakan',
                '$id_pegawai','0',NOW(),NOW())";
            
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
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah file.');</script>";
        }
    }
}

     //selesai proses simpan data