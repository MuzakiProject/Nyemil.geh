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
            <div class="dropdown ms-auto">
                    <a href="#" class="btn btn-outline-danger  icon-link ps-3 pe-3 dropdown-toggle fw-light" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-sliders me-1"></i> Filter</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item fw-light">Paling Sesuai</a></li>
                        <li><a class="dropdown-item fw-light" href="#">Harga Tertinggi</a></li>
                        <li><a class="dropdown-item fw-light" href="#">Harga Terendah</a></li>
                    </ul>
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
        <tr>
            
            <td scope="row">12OB3</td>
            <td>
                <div class="imgp-dash rounded">
                    <img src="/src/images/singkong.png" alt="">
                </div>
            </td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Rp. 999.000</td>
            <td>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#detpesan"><i class="fa-solid fa-eye"></i></button>
            </td>
        <tr>
    </tbody>
</table>
<div class="modal fade" id="detpesan" tabindex="-1" aria-labelledby="detpesan" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="detpesan">Detail Pesanan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger">Save changes</button>
      </div>
    </div>
  </div>
</div>