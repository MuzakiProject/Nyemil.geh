<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - Nyemil.geh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css?v= <?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&family=Playwrite+AU+SA:wght@100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="overflow-hidden">
<?php
    require __DIR__ . "/Dashboard/src/components/phplogic/database.php";
    include __DIR__ . "/src/components/phplogic/function.php";

    if (isset ($_POST["daftar"])){
        $daftar = daftaruser($_POST);
        if ($daftar === true) {
            echo "<script>alert('Pendaftaran berhasil!');</script>";
        } else {
            echo "<script>alert('$daftar');</script>";
        }
    }
?>
<div class="register-cover ">
    <div class="d-flex w-100 vh-100">
        <div class="right w-100 w-lg-75 d-flex flex-column justify-content-center align-items-center">
            <a class="text-dark" href="index.php"><h1 class="navbar-brand fw-bold icon-link mb-4"><i class="fa-duotone fa-solid fa-utensils text-danger"></i>Nyemil.geh</h1></a>
            <h3>Daftar dan Nikmati Cemilan Favoritmu!</h3>
            <form action="" method="post" class="w-50 mt-4" id="regisdaft">
                <div class="form-floating mb-4">
                    <input type="email" name="email" class="form-control form-control-sm rounded-3" id="floatingInput" id="email" placeholder="name@example.com" required>
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" name="username" class="form-control form-control-sm rounded-3" id="floatingInput" id="username" placeholder="Masukan Username">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control form-control-sm rounded-3" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" name="notelp" class="form-control form-control-sm rounded-3" id="floatingPassword" placeholder="08123456678">
                    <label for="floatingPassword">No Telepon</label>
                </div>
                <div class="form-text mb-4 text-center">
                    Dengan menekan registrasi sekarang, kamu menyetujui <a href="http://" class="link-danger text-decoration-none">Ketentuan Penggunaan</a> dan <a href="http://" class="link-danger text-decoration-none">Kebijakan Privasi</a>
                </div>
                <button type="submit" name="daftar" class="btn btn-danger fw-semibold rounded-0 w-100" id="subkir" disabled>Register Sekarang</button>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/scrollreveal"></script>
<script src="/src/components/js/disbtn.js"></script>
<script>
    ScrollReveal().reveal('.right', {
        duration: 1000,
        origin: 'right',
        distance: '50px',
        reset: false, // no repeat
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
</body>
</html>