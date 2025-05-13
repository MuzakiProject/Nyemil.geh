<nav class="navbar fixed-top shadow-sm" style="background-color : white;">
  <div class="container-fluid">
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand me-auto ps-2 pt-2 pb-2 fw-bold" href="index.php"><i class="fa-duotone fa-solid fa-utensils text-danger"></i>Nyemil.geh</a>
    <!-- Button trigger modal -->
    <button type="button" class="btn me-auto border ps-3 pe-3 justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <i class="fa-regular fa-magnifying-glass"></i>
      <span class="opacity-75 ms-2">Search or type command...</span>
    </button>
    <ul class="nav">
    <li class="nav-item dropstart">
      <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-light fa-bell text-dark fs-5"></i>
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">No Message Yet.</a></li>
      </ul>
    </li>
    </ul> 
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Activity</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Product</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
          <form class="d-flex w-100" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          </form>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <span class="d-flex justify-content-center pt-3 pb-3">No recent searches</span>
          </div>
        </div>
      </div>
    </div>
