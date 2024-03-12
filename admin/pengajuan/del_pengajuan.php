<?php

if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM tb_pengajuan WHERE id_pengajuan='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);

    // Path file dokumen
    $file_path = "./dokumen/".$data_cek['dokumen'];
}
?>

<?php

if($_SESSION['ses_level'] == "Kadis"){
    echo "<script>
    Swal.fire({title: 'Anda tidak punya akses ke menu ini!',text: '',icon: 'error',confirmButtonText: 'OK'
    }).then((result) => {if (result.value){
        window.location = 'index.php?page=pengajuan';
        }
    })</script>";
}else{
    $sql_hapus = "DELETE FROM tb_pengajuan WHERE id_pengajuan='" . $_GET['kode'] . "'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);
    
    if ($query_hapus) {
        // Hapus file dokumen terkait
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    
        echo "<script>
            Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {window.location = 'index.php?page=pengajuan'
            ;}})</script>";
    } else {
        echo "<script>
            Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {window.location = 'index.php?page=pengajuan'
            ;}})</script>";
    }
}
?>