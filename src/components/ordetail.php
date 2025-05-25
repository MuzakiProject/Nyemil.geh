<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Jika user menekan tombol "Pesanan Selesai"
    if (isset($_POST['mark_completed'])) {
        $orderId = intval($_POST['mark_completed']);
        if (markOrderAsCompleted($orderId)) {
            if (isset($_SESSION['user_id'])) {
                logUserOrderCompleted($_SESSION['user_id'], $orderId);
            }
            echo "<script>alert('Pesanan telah ditandai sebagai selesai.'); document.location.href = 'index.php?page=7';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal menandai pesanan sebagai selesai.');</script>";
        }
    }

    // Jika permintaan untuk menampilkan detail order
    if (isset($_POST['order_id'])) {
        $order_id = intval($_POST['order_id']);
        $result = getOrderDetail($order_id);

        if ($result->num_rows === 0) {
            echo "Order tidak ditemukan.";
            exit;
        }

        $order = $result->fetch_assoc();
    } else {
        echo "Akses tidak valid.";
        exit;
    }
}

$order_id = intval($_POST['order_id']);
$result = getOrderDetail($order_id);

if ($result->num_rows === 0) {
    echo "Order tidak ditemukan.";
    exit;
}

$order = $result->fetch_assoc();
?>
<div class="container py-5">
    <div class="cover-order-det d-flex justify-content-between gap-4">
        <div class="left w-100">
            <div class="card mb-3">
                <div class="card-header icon-link fw-semibold py-3">
                    <i class="fa-solid fa-truck-fast text-danger"></i> Status pengiriman
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between ">
                        <div class="d-flex gap-4">
                            <div class="image-detpes">
                                <img class="w-100 h-100 object-fit-contain" src="/src/images/<?= $order["image_product"] ?>" alt="">
                            </div>
                            <div class="status py-3">
                                <h6>Pesanan Anda Sedang</h6>
                                <p><?= $order["order_status"] ?></p>
                                <div class="send">
                                    <h6>Order ID : <span class="fw-normal"><?= $order["order_id"] ?></span></h6>
                                    <h6>Kurir : <span class="fw-normal"><?= $order["courier"] ?></span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="time py-3">
                            <h6>Estimasi Tiba</h6>
                            <p>2 - 3 Hari</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header py-3 fw-semibold icon-link">
                    <i class="fa-solid fa-clock-rotate-left text-danger"></i> Aktivitas Pengiriman
                </div>
                <div class="card-body d-flex flex-column-reverse">
                    <div class="timeline py-3">
                        <p class="fw-light">14 Mei 2025, 09:10 WIB</p>
                        <h6>Pesanan di-Buat</h6>
                        <p>Pesanan Anda telah dikonfirmasi dan sedang dipersiapkan untuk pengiriman.</p>
                    </div>
                    <div class="timeline py-3">
                        <p class="fw-light">14 Mei 2025, 09:10 WIB</p>
                        <h6>Pesanan di-Konfirmasi</h6>
                        <p>Pesanan Anda telah dikonfirmasi dan sedang dipersiapkan untuk pengiriman.</p>
                    </div>
                    <div class="timeline py-3">
                        <p class="fw-light">14 Mei 2025, 12:10 WIB</p>
                        <h6>Pesanan sudah diterima : Agen</h6>
                        <p>Kurir telah mengambil paket Anda dari penjual.</p>
                    </div>
                    <div class="timeline py-3">
                        <p class="fw-light">14 Mei 2025, 15:10 WIB</p>
                        <h6>Pesanan sedang diproses dilokasi sortir</h6>
                        <p>Paket Anda telah diterima oleh pusat sortir dan sedang diproses untuk pengiriman.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="right w-50">
            <div class="card mb-3">
                <div class="card-header py-3">
                    <span class="fw-semibold">Informasi Pengiriman</span>
                </div>
                <div class="card-body">
                    <div class="alamat">
                        <h6>Alamat Pengiriman :</h6>
                        <p><?= $order["shipping_address"] ?></p>
                    </div>
                    <div class="no-telp">
                        <h6>No Telepon :</h6>
                        <p><?= $order["no_telp"] ?></p>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header py-3">
                    <span class="fw-semibold">Detail Pesanan</span>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <div class="image-detpes">
                            <img class="w-100 h-100 object-fit-contain" src="/src/images/<?= $order["image_product"] ?>" alt="">
                        </div>
                        <div class="text-detpes">
                            <span class="fw-semibold"><?= $order["productname"] ?></span>
                            <p class=""><?= $order["quantity"] ?>x</p>
                            <h6 class="fw-semibold"><?= $order["total_payment"] ?></h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3 border-top py-3">
                        <div class="text">
                            <p>Subtotal :</p>
                            <p>Biaya Pengiriman :</p>
                        </div>
                        <div class="harga text-end">
                            <p>Rp. <?= $order["price"] ?></p>
                            <p>Rp. <?= $order["shipping_cost"] ?></p>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-danger w-100 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-light fa-receipt"></i> Nota Pesanan</button>
                    <form method="post" onsubmit="return confirm('Apakah Anda yakin ingin menandai pesanan ini sebagai selesai?')">
                        <input type="hidden" name="mark_completed" value="<?= $order["order_id"] ?>">
                        <button type="submit" class="btn btn-danger w-100 fw-semibold mt-2">Pesanan Selesai</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nota Pesanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between mb-4">
                    <h6>No Pesanan : 25521asdaW2</h6>
                    <h6>12/05/2025</h6>
                </div>
                <div class="mod-rinci">
                    <h6>Alamat Pengirimian :</h6>
                    <p>Indonesia, lampung, Bandar lampung, Kedaton, Kampung Baru</p>
                </div>
            </div>
        </div>
    </div>
</div>