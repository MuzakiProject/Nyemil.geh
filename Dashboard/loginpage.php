<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard Nyemil.geh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css?v= <?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&family=Playwrite+AU+SA:wght@100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="overflow-hidden">
<div class="logdash-cover ">
    <div class="d-flex justify-content-center w-100 vh-100">
        <div class="right w-75 d-flex flex-column justify-content-center align-items-center">
            <h1 class="navbar-brand fw-bold icon-link mb-4"><i class="fa-duotone fa-solid fa-utensils text-danger"></i>Nyemil.geh</h1>
            <h3>Masuk dan Awasi Segalanya.</h3>
            <form action="a.php" class="w-50 py-5" id="regisdaft" method="post">
                <div class="form-floating mb-4">
                    <input type="text" class="form-control form-control-sm rounded-3" id="floatingInput" name="username"  placeholder="Masukan Nama" required>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" class="form-control form-control-sm rounded-3" name="password" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-text mb-4 text-center">
                    Pastikan <span  class="link-danger text-decoration-none">Username</span> dan <span class="link-danger text-decoration-none">Password</span> sudah sesuai.
                </div>
                <button type="submit" class="btn btn-danger fw-semibold rounded-0 w-100" id="subkir">Masuk</button>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/scrollreveal"></script>
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