<div class="container-fluid">
    <div class="p-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a class="text-decoration-none link-danger" href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Aktifitas</li>
            </ol>
        </nav>
        <h3 class="fw-bolder">Aktifitas</h3>
        <div class="d-flex align-items-center gap-5 mt-3">
            <div class="input-group w-25">
                <span class="input-group-text border-end-0" style="background-color : white;"><i class="fa-solid fa-magnifying-glass text-dark-emphasis"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Cari Aktivitas" aria-label="search">
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
<table class="table mt-4 table-hover oapu">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td scope="row">1</td>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <td scope="row">2</td>
        <td>Jacob</td>
        <td>Tdornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <td scope="row">3</td>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
        </tr>
    </tbody>
</table>