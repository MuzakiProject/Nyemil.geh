<div class="container-fluid detail-cover bg-body-secondary">
    <div class="pt-5 pb-5">
        <?php
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produk_id'], $_POST['quantity'])) {
            $user_id = $_SESSION['user']['id'];
            $product_id = (int)$_POST['produk_id'];
            $quantity = max(1, (int)$_POST['quantity']);

            if (tambahKeKeranjang($user_id, $product_id, $quantity)) {
                echo "
                <script> document.location.href = 'index.php?page=8'; </script>
                ";
                exit;
            } else {
                $error = "Gagal menambah produk ke keranjang.";
            }
        }

        $id = (int) $_GET['id'];
        $produk = detailproduk($id);
        if (!$produk) {
            echo "Produk tidak ditemukan";
            exit;
        }

        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];

            $produk = detailproduk($id);
            if ($produk) {
        ?>
        <div class="container shadow-sm bg-light-subtle d-flex gap-4 p-4 rounded">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-item active">
                        <div class="items-img-cover w-100">
                            <div class="items-img">
                                <img class="rounded" src="/src/images/<?= $produk["image_product"] ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="items-img-cover w-100">
                            <div class="items-img">
                                <img class="rounded" src="/src/images/<?= $produk["image_product"] ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="items-img-cover w-100">
                            <div class="items-img">
                                <img class="rounded" src="/src/images/<?= $produk["image_product"] ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="" aria-hidden="true"><i class="fa-solid fa-circle-chevron-left fs-1 text-dark-emphasis"></i></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="" aria-hidden="true"><i class="fa-solid fa-circle-chevron-right fs-1 text-dark-emphasis"></i></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <form action="" method="post">
            <div class="items-desc w-100">
                <span class="badge bg-success rounded-5">Stok Siap!</span>
                <h1 class="mt-2"><?= $produk["productname"] ?> - <?= $produk["weight"] ?>gr</h1>
                <div class="priceqt d-flex justify-content-between align-items-center border-top border-3 mt-3 pt-3">
                    <h4 class="text-danger">Rp <?= $produk["price"] ?></h4>
                    <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
                    <div class="d-flex align-items-center justify-content-end gap-3">
                        <button type="button" class="border-0 bg-transparent text-danger" onclick="decrement()"><i class="fa-solid fa-minus"></i></button>
                        <input name="quantity" type="number" id="quantity" value="1" min="1" class="form-control w-25 text-center" readonly onchange="document.getElementById('quantity-checkout').value = this.value">
                        <button type="button" class="border-0 bg-transparent text-danger" onclick="increment()"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <div class="button-it mt-3 d-flex gap-2">
                    <?php if ($is_logged_in): ?>
                        <a href="?page=6&produk_id=<?= $produk['id'] ?>&quantity=1" class="btn btn-outline-danger fw-semibold rounded-0 w-100">Beli</a>
                        <div class="w-100">
                            <button type="submit" class="btn btn-danger fw-semibold rounded-0 w-100">Tambah ke Keranjang</button>
                        </div>
                    <?php else: ?>
                        <button type="button" class="btn btn-outline-danger fw-semibold rounded-0 w-100"  data-bs-toggle="modal" data-bs-target="#loginModal">Beli</button>
                        <button type="button" class="btn btn-danger fw-semibold rounded-0 w-100" data-bs-toggle="modal" data-bs-target="#loginModal">Tambah ke Keranjang</button>
                    <?php endif; ?>
                </div>
                <div class="mt-4 pt-3 border-top border-3">
                    <div class="textarea-output fw-light"><?= $produk["description"] ?></div>
                </div>
            </div>
            </form>
        </div>
        <?php
            } else {
                echo "<p>Produk tidak ditemukan.</p>";
            }
        } else {
            echo "<p>ID produk tidak ditemukan di URL.</p>";
        }
        ?>
        <div class="container bg-light-subtle mt-5 p-4">
            <h3 class="fw-medium mb-4">Produk lainnya</h3>
            <div class="items-cover">
                <div class="items-row">
                    <div class="row row-cols-md-4 row-cols-2">
                        <div class="col">
                            <a class="text-decoration-none " href="?page=5&id=5">
                                <div class="card rounded-0 border-0">
                                    <div class="items-img d-flex justify-content-center">
                                        <img class="card-img-top rounded-0" src="/src/images/singkong-prodblado.png" alt="Gambar" />
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class=" card-title">Keripik Singkong - Balado</h5>
                                        <p class="card-text fw-light">Rp. 10000.00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none " href="?page=5&id=2">
                                <div class="card rounded-0 border-0">
                                    <div class="items-img d-flex justify-content-center">
                                        <img class="card-img-top rounded-0" src="/src/images/basrengjeruk.png" alt="Gambar" />
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class=" card-title">Basreng Pedas - Daun jeruk</h5>
                                        <p class="card-text fw-light">Rp. 11000.00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none " href="?page=5&id=3">
                                <div class="card rounded-0 border-0">
                                    <div class="items-img d-flex justify-content-center">
                                        <img class="card-img-top rounded-0" src="/src/images/basrengori.png" alt="Gambar" />
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class=" card-title">Basreng Asin - Original</h5>
                                        <p class="card-text fw-light">Rp. 11000.00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none " href="?page=5&id=1">
                                <div class="card rounded-0 border-0">
                                    <div class="items-img d-flex justify-content-center">
                                        <img class="card-img-top rounded-0" src="/src/images/basrengbbq.png" alt="Gambar" />
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class=" card-title">Basreng Pedas - BBQ</h5>
                                        <p class="card-text fw-light">Rp. 11000.00</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <a href="?page=1" class="btn btn-outline-danger fw-semibold">Lihat Semua Produk</a>
            </div>
        </div>
    </div>
</div>