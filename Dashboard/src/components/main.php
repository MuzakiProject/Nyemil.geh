<?php 
$totalprod = getTotalProductCount($dat4bas3); 
$totaluser = getTotalUser($dat4bas3); 
$totalorder = getTotalOrder($dat4bas3); 
$totalpendapatan = getTotalPendapatan($dat4bas3); 
$allorder = getAllOrderDetails();
?>
<div class="container-fluid">
<div class="p-3">
  <h3 class="fw-bolder">E-Commerce Dashboard</h3>
  <p class="fw-normal">Inilah yang sedang terjadi di bisnis Anda sekarang</p>
  <div class="dash pt-3 d-flex flex-column gap-3">
    <div class="dash-main d-flex flex-column flex-lg-row justify-content-between gap-3">
      <div class="dash-left w-100">
        <div class="d-flex flex-column gap-3">
          <div class="card-info d-flex gap-3">
            <div class="card w-100 rounded-3 border-0 shadow-sm">
              <div class="card-body p-4">
                <div class="icon">
                  <i class="fa-duotone fa-solid fa-user-group-simple bg-body-tertiary p-3 rounded text-primary"></i>
                </div>
                <div class="customers d-flex justify-content-between mt-4">
                  <div class="left d-flex flex-column w-100">
                    <span class="fw-light">Pengguna</span>
                    <div class="right d-flex justify-content-between align-items-center">
                      <b class="fs-3"><?= $totaluser; ?></b>
                      <b class="badge bg-success">90%</b>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card w-100 rounded-3 border-0 shadow-sm">
              <div class="card-body p-4">
                <div class="icon">
                  <i class="fa-duotone fa-boxes-packing bg-body-tertiary p-3 rounded text-success"></i>
                </div>
                <div class="customers d-flex justify-content-between mt-4">
                  <div class="left d-flex flex-column w-100">
                    <span class="fw-light">Pesanan</span>
                    <div class="right d-flex justify-content-between align-items-center">
                      <b class="fs-3"><?= $totalorder; ?></b>
                      <b class="badge bg-success">90%</b>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="dash-right w-100 d-flex gap-3">
        <div class="card w-100 rounded-3 border-0 shadow-sm">
          <div class="card-body p-4">
            <div class="icon">
              <i class="fa-duotone fa-solid fa-money-check-dollar-pen bg-body-tertiary p-3 rounded text-warning"></i>
            </div>
            <div class="customers d-flex justify-content-between mt-4">
              <div class="left d-flex flex-column w-100">
                <span class="fw-light">Total Pendapatan</span>
                <div class="right d-flex justify-content-between align-items-center">
                  <b class="fs-3">Rp <?= $totalpendapatan; ?></b>
                  <b class="badge bg-success">90%</b>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card w-100 rounded-3 border-0 shadow-sm">
          <div class="card-body p-4">
            <div class="icon">
              <i class="fa-duotone fa-solid fa-box-circle-check bg-body-tertiary p-3 rounded text-danger"></i>
            </div>
            <div class="customers d-flex justify-content-between mt-4">
              <div class="left d-flex flex-column w-100">
                <span class="fw-light">Produk</span>
                <div class="right d-flex justify-content-between align-items-center">
                  <b class="fs-3"><?= $totalprod; ?></b>
                  <b class="badge bg-success">90%</b>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-rorder card h-100 border-0 shadow-sm">
      <div class="card-header py-3" style="background-color : white ;">
          <span class="fw-semibold fs-5">Pesanan Terbaru</span>
      </div>
      <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Customer</th>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($allorder as $recent) : ?>
              <tr>
                <td><?= $recent["user_name"] ?></td>
                <td><?= $recent["productname"] ?></td>
                <td><?= $recent["quantity"] ?></td>
                <td><?= $recent["order_status"] ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
</div>