<?php
$user_id = $_SESSION['user']['id'];
$orders = getOrdersByUser($user_id);
$jsonOrders = json_encode($orders);
?>
<div class="container pt-5">
    <div class="profile-cover d-flex align-items-center gap-5 pb-5">
        <div class="left">
            <div class="profile-image">
                <img class="border img-fluid border rounded-circle object-fit-cover w-100 h-100" src="/src/images/man-user-color-icon.png" alt="">
            </div>
        </div>
        <div class="right">
            <h2>
                <?php
                    if (isset($_SESSION['user'])) {
                        echo ($_SESSION['user']['name']);
                    }else{
                        echo "Guest";
                    }
                ?>
            </h2>
            <p>
                <?php
                    if (isset($_SESSION['user'])) {
                        echo ($_SESSION['user']['email']);
                    }else{
                        echo "guest@example.com";
                    }
                ?>
            </p>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Info Lengkap</button>
        </div>
    </div>
    <div class="menu-profile mb-5">
        <div class="border-bottom mb-5">
            <ul class="d-flex justify-content-around list-unstyled">
                <li><button class="btn link-danger" type="button" data-bs-target="#carouselprofile" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1">Semua Pesanan</button></li>
                <li><button class="btn link-danger" type="button" data-bs-target="#carouselprofile" data-bs-slide-to="1" aria-label="Slide 2">Dikemas</button></li>
                <li><button class="btn link-danger" type="button" data-bs-target="#carouselprofile" data-bs-slide-to="2" aria-label="Slide 3">Dikirim</button></li>
                <li><button class="btn link-danger" type="button" data-bs-target="#carouselprofile" data-bs-slide-to="3" aria-label="Slide 4">Selesai</button></li>
            </ul>
        </div>
        <div id="carouselprofile" class="carousel slide ">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <?php foreach ($orders as $order): ?>
                    <div class="card-all mb-4">
                        <div class="card">
                            <div class="card-header p-3 bg-light">
                                <div class="top d-flex align-items-center gap-3">
                                    <i class="fa-regular fa-bags-shopping text-danger"></i>
                                    <span class="fw-semibold">Belanja</span>
                                    <span><?= $order["created_at"] ?></span>
                                    <span class="fw-light"><?= $order["order_id"] ?></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="middle d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-5 align-items-center">
                                        <div class="order-img">
                                            <img class="w-100 h-100 object-fit-contain" src="/src/images/<?= $order["image_product"] ?>" alt="" srcset="">
                                        </div>
                                        <div class="order-text">
                                            <h3><?= $order["productname"] ?></h3>
                                            <p>Qty : <?= $order["quantity"] ?></p>
                                        </div>
                                    </div>
                                    <div class="order- border-start pe-3 ps-3">
                                        <p>Total Harga</p>
                                        <h3>Rp. <?= $order["price"] * $order["quantity"] ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body ms-auto">
                                <form action="?page=9" method="post">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <button class="text-capitalize link-danger border-0 bg-transparent fw-semibold" type="submit">Lihat Detail Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!-- <div class="not-items-found d-flex flex-column align-items-center pb-5">
                        <div class="notfound-img">
                            <img class="w-100 h-100 object-fit-contain" src="/src/images/be49cda7.svg" alt="">
                        </div>
                        <div class="text-center">
                            <h4>Oops, belum ada apa-apa nih.</h4>
                            <h4>Order sekarang yuk!</h4>
                        </div>
                    </div> -->
                </div>
                <div class="carousel-item">
                    <!-- <div class="card-all">
                        <div class="card">
                            <div class="card-header p-3 bg-light">
                                <div class="top d-flex align-items-center gap-3">
                                    <i class="fa-regular fa-bags-shopping text-danger"></i>
                                    <span class="fw-semibold">Belanja</span>
                                    <span>12 Jan 2025</span>
                                    <span class="fw-light">OID1023112</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="middle d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-5 align-items-center">
                                        <div class="order-img">
                                            <img class="w-100 h-100 object-fit-contain" src="/src/images/basrengori.png" alt="" srcset="">
                                        </div>
                                        <div class="order-text">
                                            <h3>Nama produk</h3>
                                            <p>Qty : 3x</p>
                                        </div>
                                    </div>
                                    <div class="order- border-start pe-3 ps-3">
                                        <p>Total Harga</p>
                                        <h3>Rp 40.000,00</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body ms-auto">
                                <a class="text-capitalize link-danger text-decoration-none fw-semibold" href="">lihat detail pesanan</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="not-items-found d-flex flex-column align-items-center pb-5">
                        <div class="notfound-img">
                            <img class="w-100 h-100 object-fit-contain" src="/src/images/be49cda7.svg" alt="">
                        </div>
                        <div class="text-center">
                            <h4>Oops, belum ada apa-apa nih.</h4>
                            <h4>Order sekarang yuk!</h4>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <!-- <div class="card-all">
                        <div class="card">
                            <div class="card-header p-3 bg-light">
                                <div class="top d-flex align-items-center gap-3">
                                    <i class="fa-regular fa-bags-shopping text-danger"></i>
                                    <span class="fw-semibold">Belanja</span>
                                    <span>12 Jan 2025</span>
                                    <span class="fw-light">OID1023112</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="middle d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-5 align-items-center">
                                        <div class="order-img">
                                            <img class="w-100 h-100 object-fit-contain" src="/src/images/basrengori.png" alt="" srcset="">
                                        </div>
                                        <div class="order-text">
                                            <h3>Nama produk</h3>
                                            <p>Qty : 3x</p>
                                        </div>
                                    </div>
                                    <div class="order- border-start pe-3 ps-3">
                                        <p>Total Harga</p>
                                        <h3>Rp 40.000,00</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body ms-auto">
                                <a class="text-capitalize link-danger text-decoration-none fw-semibold" href="">lihat detail pesanan</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="not-items-found d-flex flex-column align-items-center pb-5">
                        <div class="notfound-img">
                            <img class="w-100 h-100 object-fit-contain" src="/src/images/be49cda7.svg" alt="">
                        </div>
                        <div class="text-center">
                            <h4>Oops, belum ada apa-apa nih.</h4>
                            <h4>Order sekarang yuk!</h4>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-all">
                        <div class="card">
                            <div class="card-header p-3 bg-light">
                                <div class="top d-flex align-items-center gap-3">
                                    <i class="fa-regular fa-bags-shopping text-danger"></i>
                                    <span class="fw-semibold">Belanja</span>
                                    <span>12 Jan 2025</span>
                                    <span class="fw-light">OID1023112</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="middle d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-5 align-items-center">
                                        <div class="order-img">
                                            <img class="w-100 h-100 object-fit-contain" src="/src/images/basrengori.png" alt="" srcset="">
                                        </div>
                                        <div class="order-text">
                                            <h3>Nama produk</h3>
                                            <p>Qty : 3x</p>
                                        </div>
                                    </div>
                                    <div class="order- border-start pe-3 ps-3">
                                        <p>Total Harga</p>
                                        <h3>Rp 40.000,00</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body ms-auto">
                                <a class="text-capitalize link-danger text-decoration-none fw-semibold" href="">lihat detail pesanan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="more-prod border-top pt-5 pb-5">
        <h3 class="fw-medium mb-4">Produk lainnya</h3>
        <div class="items-cover">
            <div class="items-row">
                <div class="row row-cols-md-4 row-cols-2">
                    <div class="col">
                        <a class="text-decoration-none " href="?page=5">
                            <div class="card rounded-0 border-0">
                                <div class="items-img d-flex justify-content-center">
                                    <img class="card-img-top rounded-0" src="/src/images/singkong-prodblado.png" alt="Gambar" />
                                </div>
                                <div class="card-body text-center">
                                    <h5 class=" card-title">Keripik Singkong - Balado</h5>
                                    <p class="card-text fw-light">Rp. 999,99,9</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="text-decoration-none " href="http://">
                            <div class="card rounded-0 border-0">
                                <div class="items-img d-flex justify-content-center">
                                    <img class="card-img-top rounded-0" src="/src/images/basrengjeruk.png" alt="Gambar" />
                                </div>
                                <div class="card-body text-center">
                                    <h5 class=" card-title">Basreng Pedas - Daun jeruk</h5>
                                    <p class="card-text fw-light">Rp. 999,99,9</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="text-decoration-none " href="http://">
                            <div class="card rounded-0 border-0">
                                <div class="items-img d-flex justify-content-center">
                                    <img class="card-img-top rounded-0" src="/src/images/basrengori.png" alt="Gambar" />
                                </div>
                                <div class="card-body text-center">
                                    <h5 class=" card-title">Basreng Asin - Original</h5>
                                    <p class="card-text fw-light">Rp. 999,99,9</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a class="text-decoration-none " href="http://">
                            <div class="card rounded-0 border-0">
                                <div class="items-img d-flex justify-content-center">
                                    <img class="card-img-top rounded-0" src="/src/images/basrengbbq.png" alt="Gambar" />
                                </div>
                                <div class="card-body text-center">
                                    <h5 class=" card-title">Basreng Pedas - BBQ</h5>
                                    <p class="card-text fw-light">Rp. 999,99,9</p>
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
<div class="modal modal-lg fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<<<<<<< HEAD
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Info Lengkap</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3">
            <div class="d-flex gap-3">
                <div class="left">
                    <p>Nama</p>
                    <p>Email</p>
                    <p>Nomor Telepon</p>
                    <p>Alamat</p>
                </div>
                <div class="middle">
                    <p>: </p>
                    <p>: </p>
                    <p>: </p>
                    <p>: </p>
                </div>
                <div class="right">
                    <p>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo ($_SESSION['user']['name']);
                        }else{
                            echo "guest";
                        }
                    ?>
                    </p>
                    <p>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo ($_SESSION['user']['email']);
                        }else{
                            echo "guest@example.com";
                        }
                    ?>
                    </p>
                    <p>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo ($_SESSION['user']['address']);
                        }else{
                            echo "-";
                        }
                    ?>
                    </p>
                    <p>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo ($_SESSION['user']['no_telp']);
                        }else{
                            echo "-";
                        }
                    ?>
                    </p>
                </div>
=======
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Info Lengkap</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-3">
        <div class="d-flex gap-3">
            <div class="left">
                <p>Nama</p>
                <p>Email</p>
                <p>Nomor Telepon</p>
                <p>Alamat</p>
            </div>
            <div class="middle">
                <p>: </p>
                <p>: </p>
                <p>: </p>
                <p>: </p>
            </div>
            <div class="right">
                <p>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo ($_SESSION['user']['name']);
                    }else{
                        echo "guest";
                    }
                ?>
                </p>
                <p>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo ($_SESSION['user']['email']);
                    }else{
                        echo "guest@example.com";
                    }
                ?>
                </p>
                <p>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo ($_SESSION['user']['address']);
                    }else{
                        echo "-";
                    }
                ?>
                </p>
                <p>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo ($_SESSION['user']['no_telp']);
                    }else{
                        echo "-";
                    }
                ?>
                </p>
>>>>>>> 0dac60e069ab6bba053d4e0dfa3992bb63bb0a04
            </div>
        </div>
        </div>
    </div>
</div>