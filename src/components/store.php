<div class="container store-cover mb-5 d-flex flex-column gap-4">
    <div class="pt-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a class="text-decoration-none link-danger text" href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center justify-content-between pt-1">
            <h3 class="fw-semibold align-baseline text-danger">Mau nyemil apa hari ini?</h3>
            <div class=" d-flex gap-2">
                <div class="input-group w-auto">
                    <span class="input-group-text border-end-0" style="background-color : white;"><i class="fa-solid fa-magnifying-glass text-dark-emphasis"></i></span>
                    <input type="text" class="form-control border-start-0" placeholder="Search products" aria-label="search">
                </div>
                <div class="dropdown">
                    <a href="#" class="btn border icon-link ps-3 pe-3 dropdown-toggle fw-light" data-bs-toggle="dropdown" aria-expanded="false">Paling Sesuai</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item fw-light active">Paling Sesuai</a></li>
                        <li><a class="dropdown-item fw-light" href="#">Harga Tertinggi</a></li>
                        <li><a class="dropdown-item fw-light" href="#">Harga Terendah</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    $dataprdk = tampilproduk("SELECT * FROM products");
    ?>
    <div class="items-cover">
        <div class="items-row">
            <div class="row row-cols-md-4 row-cols-2">
                <?php foreach ($dataprdk as $data): ?>
                <div class="col">
                    <a class="text-decoration-none " href="?page=5&id=<?= $data["id"] ?>">
                        <div class="card rounded-0 border-0">
                            <div class="items-img d-flex justify-content-center">
                                <img class="card-img-top rounded-0" src="/src/images/<?= $data["image_product"] ?>" alt="Gambar" />
                            </div>
                            <div class="card-body text-center">
                                <h5 class=" card-title"><?= $data["productname"] ?></h5>
                                <p class="card-text fw-light">Rp. <?= $data["price"] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>