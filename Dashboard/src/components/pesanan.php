<?php 
$allorder = getAllOrderDetails(); 

$detailModalContent = "";

$detailOrder = null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["lihat_order"])) {
    $id = (int) $_POST["lihat_order"];
    $detailOrder = getOrderDetailById($id);
}

?>
<div class="container-fluid">
    <div class="p-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a class="text-decoration-none link-danger" href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
            </ol>
        </nav>
        <h3 class="fw-bolder">Pesanan</h3>
        <div class="d-flex align-items-center gap-5 mt-3">
            <div class="input-group w-25">
                <span class="input-group-text border-end-0" style="background-color : white;"><i class="fa-solid fa-magnifying-glass text-dark-emphasis"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Cari Pesanan" aria-label="search">
            </div>
            <div class="d-flex gap-3">
                <a class="text-decoration-none link-danger" href="#">Semua Produk<span class="text-dark-emphasis ps-2">(120)</span></a>
                <a class="text-decoration-none link-danger" href="#">Packing<span class="text-dark-emphasis ps-2">(120)</span></a>
                <a class="text-decoration-none link-danger" href="#">Delivered<span class="text-dark-emphasis ps-2">(120)</span></a>
                <a class="text-decoration-none link-danger" href="#">Completed<span class="text-dark-emphasis ps-2">(120)</span></a>
            </div>
        </div>
    </div>
</div>
<table class="table mt-4 table-hover border-top oapu">
    <thead>
        <tr>
            <th scope="col">Id Pesanan</th>
            <th scope="col">Gambar Produk</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Kuantitas</th>
            <th scope="col">Total Harga</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allorder as $order): ?>
        <tr>
            <td scope="row"><?= $order["order_id"] ?></td>
            <td>
                <div class="imgp-dash rounded">
                    <img src="/src/images/<?= $order["image_product"] ?>" alt="">
                </div>
            </td>
            <td><?= $order["productname"] ?></td>
            <td><?= $order["quantity"] ?></td>
            <td>Rp. <?= $order["total_payment"] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="lihat_order" value="<?= $order["order_id"] ?>">
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-eye"></i></button>
                </form>
            </td>
        <tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["konfirmasi_order"])) {
        $orderId = (int) $_POST["order_id_update"];
        updateOrderStatus($orderId, 'Confirmed');
    }

    if (isset($_POST["kirim_order"])) {
        $orderId = (int) $_POST["order_id_update"];
        updateOrderStatus($orderId, 'Dikirim');
    }
}

if ($detailOrder && !isset($detailOrder['error'])): 
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('detorder'));
    myModal.show();
});
</script>

<div class="modal fade" id="detorder" tabindex="-1" aria-labelledby="detorderLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Detail Pesanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID Pesanan:</strong> <?= $detailOrder[0]['order_id'] ?></p>
                <p><strong>Nama Penerima:</strong> <?= $detailOrder[0]['buyer_name'] ?></p>
                <p><strong>Status:</strong> <?= $detailOrder[0]['order_status'] ?></p>
                <p><strong>Alamat Pengiriman:</strong> <?= $detailOrder[0]['shipping_address'] ?></p>
                <p><strong>Tanggal Order:</strong> <?= $detailOrder[0]['created_at'] ?></p>

                <hr>
                <h6>Daftar Produk:</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kuantitas</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detailOrder as $item): ?>
                        <tr>
                            <td><img src="/src/images/<?= htmlspecialchars($item["image_product"]) ?>" width="60"></td>
                            <td><?= htmlspecialchars($item["productname"]) ?></td>
                            <td><?= $item["quantity"] ?></td>
                            <td>Rp <?= number_format($item["price"], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item["price"] * $item["quantity"], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><strong>Total Pembayaran:</strong> Rp <?= number_format($detailOrder[0]['total_payment'], 0, ',', '.') ?></p>
            </div>
            <div class="modal-footer">
                <form method="post" class="d-flex gap-2">
                    <input type="hidden" name="order_id_update" value="<?= $detailOrder[0]['order_id'] ?>">
                    <?php if ($detailOrder[0]['order_status'] !== 'Confirmed'): ?>
                        <button type="submit" name="konfirmasi_order" class="btn btn-success">Konfirmasi</button>
                    <?php endif; ?>

                    <?php if ($detailOrder[0]['order_status'] !== 'Shipped' && $detailOrder[0]['order_status'] !== 'Completed'): ?>
                        <button type="submit" name="kirim_order" class="btn btn-primary">Kirim</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php elseif ($detailOrder && isset($detailOrder['error'])): ?>
    <div class="alert alert-danger mt-3"><?= $detailOrder['error'] ?></div>
<?php endif; ?>
