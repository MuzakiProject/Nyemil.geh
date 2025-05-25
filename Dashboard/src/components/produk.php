<div class="container-fluid">
    <div class="p-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none link-danger" href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>
        <h3 class="fw-bolder">Produk</h3>
        <div class="d-flex align-items-center gap-5 mt-3">
            <div class="input-group w-25">
                <span class="input-group-text border-end-0" style="background-color : white;"><i class="fa-solid fa-magnifying-glass text-dark-emphasis"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Cari Produk" aria-label="search">
            </div>
            <div class="d-flex gap-3">
                <a class="text-decoration-none link-danger" href="#">All<span class="text-dark-emphasis ps-2">(120)</span></a>
                <span class=" dropdown-toggle link-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories
                </span>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                <a class="text-decoration-none link-danger" href="#">Stock</a>
            </div>
            <button type="button" class="btn btn-danger border-0 ms-auto icon-link ps-3 pe-3 fw-medium" data-bs-toggle="modal" data-bs-target="#additem"><i class="fa-solid fa-plus"></i>Produk</button>
        </div>
    </div>
</div>
<?php
$datapr = tampilproduk("SELECT * FROM products");

$detailProduk = null;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["lihat_produk"])) {
    $id = (int) $_POST["lihat_produk"];
    $detailProduk = detailproduk($id);
}

if (isset($_POST["hapus_produk"])){
    if (hapusproduk($_POST["hapus_produk"]) > 0){
        echo "
            <script> 
                alert('Produk berhasil dihapus!');
                document.location.href = 'index.php?page=1';
            </script>
        ";
    }else{
        echo "
            <script> 
                alert('Produk gagal dihapus');
                document.location.href = 'index.php?page=1';
            </script>
        ";
    }
}
?>
<table class="table mt-4 table-hover border-top oapu">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Stok</th>
            <th scope="col">Harga</th>
            <th scope="col">Detail Produk</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($datapr as $data) : ?>
        <tr>
            <td scope="row"><?= $no ?></td>
            <td>
                <div class="imgp-dash rounded">
                    <img src="/src/images/<?= $data["image_product"] ?>" alt="">
                </div>
            </td>
            <td><?= $data["productname"] ?></td>
            <td><?= $data["stock"] ?></td>
            <td>Rp. <?= $data["price"] ?></td>
            <td>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="lihat_produk" value="<?= $data["id"] ?>">
                    <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-eye"></i></button>
                </form>
            </td>
        <tr>
        <?php $no++ ?>
        <?php endforeach ?>
    </tbody>
</table>
<?php
if(isset($_POST["tambah"])) {
    if (inputproduk($_POST) > 0){
        echo "
        <script> 
            alert('Produk berhasil ditambahkan!');
            document.location.href = 'index.php?page=1';
        </script>
        ";
    }else{
        echo "
        <script> 
            alert('Produk berhasil ditambahkan!');
            document.location.href = 'index.php?page=1';
        </script>
        ";
    }
}
?>
<div class="modal fade" id="additem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdrop">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Masukkan Gambar Produk:</label>
                        <input class="form-control" type="file" name="gambar" id="formFile" require>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Produk:</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="namaproduk" placeholder="" require>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi" rows="3" require></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Berat:</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" name="berat" placeholder="" require>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Harga Produk:</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" name="harga" placeholder=""  step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Stok:</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" name="stok" placeholder="" require>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="tambah">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php if($detailProduk) : ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('detproduk'));
    myModal.show();
});
</script>
<div class="modal fade detprod" id="detproduk" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitle">Detail Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center">
                    <div class="left">
                        <div class="image">
                            <img class="w-100 h-100 object-fit-contain" src="/src/images/<?= $detailProduk["image_product"] ?> " alt="">
                        </div>
                    </div>
                    <div class="right px-3">
                        <h1 class="mb-3"><?= $detailProduk['productname'] ?> <?= $detailProduk["weight"] ?>Gr</h1>
                        <div class="d-flex my-3 justify-content-between">
                            <div>
                                <h6 class="stok">Harga : <span class="fw-normal ">Rp. <?= $detailProduk["price"] ?></span></h6>
                            </div>
                            <div>
                                <h6 class="stok">Stok : <span class="fw-normal "><?= $detailProduk["stock"] ?></span></h6>
                            </div>
                        </div>
                        <h6 class="stok py-3 border-top">Deskripsi :</h6>
                        <span class="fw-light "><?= $detailProduk["description"] ?></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div class="">
                    <h6>ID Produk : <span class="fw-normal"><?= $detailProduk["id"] ?></span></h6>
                </div>
                <div class="">
                    <form action="" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                        <input type="hidden" name="hapus_produk" value="<?= $detailProduk["id"] ?>">
                        <button type="submit" class="btn btn-danger" href="">Hapus </button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
<?php endif; ?>