<nav class="navbar fixed-top bg-light-subtle navbar-visible border-bottom" id="mainNavbar">
  <div class="container">
    <a class="navbar-brand fw-bold pt-2 pb-2 icon-link" href="index.php"><i class="fa-duotone fa-solid fa-utensils text-danger"></i>Nyemil.geh</a>
    <ul class="nav me-auto">
      <div class="nav d-lg-flex d-none">
        <li class="nav-item">
          <a class="nav-link link-danger text-dark-emphasis fw-medium ms-3" href="index.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link-danger text-dark-emphasis fw-medium" href="?page=1">Produk</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link link-danger text-dark-emphasis fw-medium dropdown-toggle" data-bs-toggle="collapse" href="#collapseSupport" role="button" aria-expanded="false" aria-controls="collapseSupport">Bantuan & Panduan</a>
        </li>
      </div>
    </ul>
    <ul class="nav ms-auto d-none d-lg-flex align-items-center gap-3">
        <li><a href="?page=8" class="btn btn-outline-danger border-0 d-flex align-items-center p-2"><i class="fa-duotone fa-solid fa-cart-shopping fs-5"></i></a></li>
        <li class="nav-item">
          <div class="btn-group dropstart prof">
            <img src="/src/images/pictmale.png" type="button" class="border rounded-circle" data-bs-toggle="dropdown" aria-expanded="false" alt="profile">
            <ul class="dropdown-menu mt-5 me-0">
              <div class="head shadow-sm">
                <li><p class="dropdown-item align-items-center d-flex gap-2"><img src="/src/images/pictmale.png" type="button" class="border rounded-circle" data-bs-toggle="dropdown" aria-expanded="false" alt="profile"><span>Your Name</span></p></li>
              </div>
              <div class="body pt-3">
                <li><a class="dropdown-item align-items-center d-flex gap-2" href="?page=7"><i class="fa-solid fa-right-from-bracket bg-body-secondary rounded-circle p-2"></i>Akun Saya</a></li>
                <li><a class="dropdown-item align-items-center d-flex gap-2" href="#"><i class="fa-solid fa-right-from-bracket bg-body-secondary rounded-circle p-2"></i> Another action</a></li>
                <li><a class="dropdown-item align-items-center d-flex gap-2" href="#"><i class="fa-solid fa-right-from-bracket bg-body-secondary rounded-circle p-2"></i> Something else here</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item align-items-center d-flex gap-2" href="#"><i class="fa-solid fa-right-from-bracket bg-body-secondary rounded-circle p-2"></i> Keluar</a></li>
              </div>
            </ul>
          </div>
        </li>
    </ul>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container-xxl" id="accordion">
      <div class="collapse w-100" id="collapseSupport" data-bs-parent="#accordion">
        <div class="col-support p-lg-3 p-xl-5">
          <div class="d-flex justify-content-center gap-5">
            <div class="col-support me-2">
              <p>
                <a class="icon-link icon-link-hover text-decoration-none justify-content-center text-center d-flex flex-column gap-0 link-danger text-dark" href="?page=2">
                  <span class="fs-1 rounded-3 p-4 h-50 align-items-center d-flex hver btn btn-outline-danger ps-5 pe-5 rounded-4 text-dark-emphasis link-light border"><i class="fa-duotone fa-solid fa-question"></i></ion-icon></span>
                  <span class="mt-2 fw-medium">Bantuan</span>
                </a>
              </p>
            </div>
            <div class="col-support ms-5 me-5">
              <p>
                <a class="icon-link icon-link-hover text-decoration-none justify-content-center text-center d-flex flex-column gap-0 link-danger text-dark" href="?page=3">
                  <span class="fs-1 rounded-3 p-4 h-50 align-items-center d-flex hver btn btn-outline-danger ps-5 pe-5 rounded-4 text-dark-emphasis link-light border"><i class="fa-solid fa-shield-keyhole"></i></span>
                  <span class="mt-2 fw-medium">Kebijakan & Privasi</span>
                </a>
              </p>
            </div>
            <div class="col-support ms-2">
              <p>
                <a class="icon-link icon-link-hover text-decoration-none justify-content-center text-center d-flex flex-column gap-0 link-danger text-dark" href="?page=4">
                  <span class="fs-1 rounded-3 p-4 h-50 align-items-center d-flex hver btn btn-outline-danger ps-5 pe-5 rounded-4 text-dark-emphasis link-light border"><i class="fa-solid fa-buildings"></i></span>
                  <span class="mt-2 fw-medium">Tentang kami</span>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <button type="button" class="btn btn-danger rounded-5 fw-medium" data-bs-toggle="modal" data-bs-target="#SignButton">Sign in</button>
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="?page=7">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
