<div class="container-fluid">
    <div class="p-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none link-danger" href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>
        <h3 class="fw-bolder">Produk</h3>
        <div class="d-flex align-items-center gap-5 mt-3">
            <div class="input-group w-25">
                <span class="input-group-text border-end-0" style="background-color : white;"><i class="fa-solid fa-magnifying-glass text-dark-emphasis"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Cari Produk" aria-label="search">
            </div>
            <div class="d-flex gap-3">
                <a class="text-decoration-none link-danger" href="#">All<span class="text-dark-emphasis ps-2">(120)</span></a>
                <span class=" dropdown-toggle link-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories
                </span>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                <a class="text-decoration-none link-danger" href="#">Stock</a>
            </div>
            <button type="button" class="btn btn-danger border-0 ms-auto icon-link ps-3 pe-3 fw-medium" data-bs-toggle="modal" data-bs-target="#additem"><i class="fa-solid fa-plus"></i>Add Items</button>
        </div>
    </div>
</div>
<table class="table mt-4 table-hover border-top oapu">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Stok</th>
            <th scope="col">Harga</th>
            <th scope="col">Detail Produk</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">1</td>
            <td>
                <div class="imgp-dash rounded">
                    <img src="/src/images/singkong.png" alt="">
                </div>
            </td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Rp. 999.000</td>
            <td>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#detproduk"><i class="fa-solid fa-eye"></i></button>
            </td>
        <tr>
    </tbody>
</table>
<div class="modal fade" id="additem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdrop">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Masukkan Gambar Produk:</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Produk:</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Berat:</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga Produk:</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder=""  step="0.01" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Stok:</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detproduk" tabindex="-1" aria-labelledby="detproduk" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detproduk">Detail Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <div class="left">
                        <img src="" alt="">
                    </div>
                    <div class="right">
                        <h1></h1>
                        <p class="stok"></p>
                        <div class="berat">
                            <select class="form-select" aria-label="Berat">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <p class="harga"></p>
                        <div class="deskripsi"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Save changes</button>
            </div>
        </div>
        </div>
    </div>