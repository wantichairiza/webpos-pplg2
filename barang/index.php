<?php
session_start();
if (!isset($_SESSION['ssLoginPOS'])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-barang.php";

$title = "Data barang - Market PPLG";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";


if (isset($_GET['msg'])){
    $msg = $_GET['msg'];
}else{
    $msg = '';
}

$alert='';

if ($msg == 'deleted'){
 $id = $_GET['id'];
 $gbr = $_GET['gbr'];
 delete($id, $gbr);
 $alert =
 "<script>
 $(document).ready(function() {
 $(document).Toasts('create', {
 title : 'Sukses',
 body : 'data barang berhasil dihapus dari database',
 class : 'bg-success',
 icon : 'fas fa-check-circle',
})
});
 </script>";
}
?>


<?php require "../template/footer.php";?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> data barang</h3>
                    <div class="card-tools">
                        <a href="<?= $main_url ?>user/add-user.php" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus fa-sm"></i> Add barang</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>gambar</th>
                                <th> id barang</th>
                                <th>nama barang</th>
                                <th>harga beli</th>
                                <th>harga jual</th>
                                
                                <th style="width: 10%;">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $barang = getData("SELECT * FROM tbl_barang");
                            foreach ($barang as $b): ?>
                                <tr>
                                    
                                    <td><img src="../assets/image/<?= $b['gambar'] ?>" class="rounded-circle" width="60px" alt=""></td>
                                    <td><?= $b['id_barang'] ?></td>
                                    <td><?= $b['nama_barang'] ?></td>
                                    <td><?= $b['harga_beli'] ?></td>
                                    <td><?= $b['harga_jual'] ?></td>
                                    <td>
                                    
                                        
                                    <td>
                                        
                                        <a href="?id=<?= $b['id_barang'] ?>&gbr=<?= $b['gambar'] ?>&msg=deleted"
                                            class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin akan menghapus barang ini?')"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>
