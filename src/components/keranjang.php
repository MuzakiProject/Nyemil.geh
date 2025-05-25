<?php
$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_qty'])) {
        foreach ($_POST['quantities'] as $product_id => $qty) {
            $product_id = (int)$product_id;
            $qty = max(1, (int)$qty);
            updateKeranjangQty($user_id, $product_id, $qty);
        }
    }

    if (isset($_POST['hapus']) && isset($_POST['hapus_id'])) {
        $hapus_id = (int)$_POST['hapus_id'];
        hapusDariKeranjang($user_id, $hapus_id);
    }
}

$items = getKeranjangByUser($user_id);

$total_bayar = 0;
?>
<div class="container py-5">
    <div class="cart-cover mb-5">
        <h3 class="fw-medium">Keranjang</h3>
        <div class="d-flex justify-content-between gap-5">
            <div class="left w-75">
                <?php 
                    foreach ($items as $item): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_bayar += $subtotal;
                ?>
                <div class="card my-4">
                    <div class="card-header d-flex justify-content-between">
                        <span class="fw-semibold fs-5">Produk</span>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="hapus_id" value="<?= $item['product_id'] ?>">
                            <button type="submit" name="hapus" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus produk ini dari keranjang?')"><i class="fa-regular fa-trash"></i></button>
                        </form>
                    </div>
        <form action="?page=10" method="post">
                    <div class="card-body d-flex align-items-center justify-content-between px-4">
                        <div class="d-flex align-items-center gap-4 w-50">
                            <div class="cart-items-img">
                                <img class="w-100 h-100 object-fit-contain" src="/src/images/<?= $item["image_product"] ?>" alt="">
                            </div>
                            <div class="cart-items-text">
                                <h5 class="fw-normal"><?= $item["productname"] ?> <?= $item["weight"] ?>gr</h5>
                            </div>
                        </div>
                        <div class="cart-items-text text-center">
                            <h5>Rp. <?= number_format($subtotal,0,',','.') ?></h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-end gap-3">
                            Qty : <input class="form-control text-center qty-input" type="number" id="qty" name="quantities[<?= $item['product_id'] ?>]" value="<?= $item['quantity'] ?>" min="1" style="width: 60px;">
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="right w-25 sticky-top my-4">
                <div class="card">
                    <div class="card-header">
                        <span class="mb-3 fw-semibold fs-5">Ringkasan Belanja</span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3 justify-content-between">
                            <p>Total :</p>
                            <h5>Rp. <?= number_format($total_bayar,0,',','.') ?></h5>
                        </div>
                        <button class="btn btn-danger w-100" name="checkout" type="submit"><span class="px-5 fw-semibold">Checkout</span></button>
                        <button type="submit" name="update_qty" id="btn-update" class="btn btn-outline-danger w-100 my-3" style="display:none;">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <div class="more-prod border-top py-5">
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

<script>
document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('input', () => {
        document.getElementById('btn-update').style.display = 'inline-block';
    });
});
</script>
