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
    <ul class="nav ms-auto d-none d-lg-flex">
        <li class="nav-item">
          <button type="button" class="btn btn-danger rounded-5 fw-medium" data-bs-toggle="modal" data-bs-target="#loginModal">Sign in</button>
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
              <li><a class="dropdown-item" href="#">Action</a></li>
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
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (loginUser($email, $password)) {
        echo "<script>
                alert('Login berhasil!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Login gagal! Email atau password salah.');
              </script>";
    }
}
?>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 navbar-brand fw-bold icon-link" id="exampleModalCenterTitle"><i class="fa-duotone fa-solid fa-utensils text-danger"></i>Nyemil.geh</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label for="inputPassword5" class="form-label">Password</label>
            <input type="password" name="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
            <div id="passwordHelpBlock" class="form-text">
              Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </div>
          </div>
          <div class="d-flex justify-content-center flex-column loginbtn w-100">
            <button type="submit" class="btn btn-danger w-100 mb-3">Masuk</button>
          </div>
        </form>
        <div class="d-flex justify-content-center flex-column loginbtn w-100">
          <div class="text-center mb-3">
            Belum memiliki akun? <a class="text-decoration-none link-danger" href="/registpage.php">Daftar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
