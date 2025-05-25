<div class="container-fluid">
    <div class="p-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a class="text-decoration-none link-danger" href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
            </ol>
        </nav>
        <h3 class="fw-bolder">Pengguna</h3>
        <div class="d-flex align-items-center gap-5 mt-3">
            <div class="input-group w-25">
                <span class="input-group-text border-end-0" style="background-color : white;"><i class="fa-solid fa-magnifying-glass text-dark-emphasis"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Cari Pengguna" aria-label="search">
            </div>
            <div class="d-flex gap-3">
                <a class="text-decoration-none link-danger" href="#">All<span class="text-dark-emphasis ps-2">(120)</span></a>
            </div>
        </div>
    </div>
</div>
<?php 
$datausr = tampiluser("SELECT * FROM users");

$infouser = null;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["info-user"])) {
    $id = (int) $_POST["info-user"];
    $infouser = infouser($id);
}

if (isset($_POST["hapus-user"])){
    if (hapususer($_POST["hapus-user"]) > 0){
        echo "
            <script> 
                alert('Akun Pengguna berhasil dihapus!');
                document.location.href = 'index.php?page=1';
            </script>
        ";
    }else{
        echo "
            <script> 
                alert('Akun Pengguna gagal dihapus');
                document.location.href = 'index.php?page=1';
            </script>
        ";
    }
}
?>
<table class="table mt-4 table-hover oapu">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Pengguna</th>
        <th scope="col">Email</th>
        <th scope="col">No Telp</th>
        <th scope="col">Info Lengkap</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($datausr as $user) : 
        ?>
        <tr>
<<<<<<< HEAD
            <td scope="row"><?= $no ?></td>
            <td><?= $user["username"] ?></td>
            <td><?= $user["email"] ?></td>
            <td><?= $user["no_telp"] ?></td>
            <td>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="info-user" value="<?= $user["id"] ?>">
                    <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-eye"></i></button>
                </form>
            </td>
        </tr>
        <?php
        $no++;
        endforeach
        ?>
=======
            <td scope="row">1</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>080808</td>
        </tr>
        <tr>
            <td scope="row">2</td>
            <td>Jacob</td>
            <td>Tdornton</td>
            <td>@fat</td>
            <td>080808</td>
        </tr>
>>>>>>> 0dac60e069ab6bba053d4e0dfa3992bb63bb0a04
    </tbody>
</table>
<?php  if($infouser) : ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('infouser'));
    myModal.show();
});
</script>
<div class="modal fade detprod" id="infouser" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitle">Informasi Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center">
                    <div class="my-3 d-flex gap-3">
                        <div class="left">
                            <h6 class="">Nama</h6>
                            <h6 class="">Email</h6>
                            <h6 class="">No Telepon</h6>
                            <h6 class="">Alamat</h6>
                        </div>
                        <div class="right d-flex flex-column">
                            <h6 class="fw-normal ">: <?= $infouser["username"] ?></h6>
                            <h6 class="fw-normal ">: <?= $infouser["no_telp"] ?></h6>
                            <h6 class="fw-normal ">: <?= $infouser["email"] ?></h6>
                            <h6 class="fw-normal ">: <?= !empty($infouser["address"]) ? htmlspecialchars($infouser["address"]) : "-" ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Pengguna ini?')">
                    <input type="hidden" name="hapus-user" value="<?= $infouser["id"] ?>">
                    <button type="submit" class="btn btn-danger" href="">Hapus </button>
                </form>
            </div>
        </div>
        </div>
    </div>
<?php endif; ?>