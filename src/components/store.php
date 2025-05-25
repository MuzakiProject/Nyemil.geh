<?php
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$dataprdk = cariDanSortProduk($dat4bas3, $keyword, $sort);
?>
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
                <form action="" method="get">
                    <div class="input-group w-auto">
                        <input type="hidden" name="page" value="1">
                        <input type="text" name="search" class="form-control rounded-start"  placeholder="Search products" aria-label="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button class="btn btn-danger" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <form method="GET" action="">
                    <input type="hidden" name="page" value="1">
                    <select name="sort" id="sort" class="form-select w-auto d-inline" onchange="this.form.submit()">
                        <option selected>Paling Relevan</option>
                        <option value="tertinggi" <?= ($sort == 'tertinggi') ? 'selected' : '' ?>>Tertinggi</option>
                        <option value="terendah" <?= ($sort == 'terendah') ? 'selected' : '' ?>>Terendah</option>
                    </select>
                </form>
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