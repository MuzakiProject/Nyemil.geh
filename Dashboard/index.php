<?php
session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Nyemil.geh - Dashboard</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
        <link rel="stylesheet" href="style.css?v= <?php echo time(); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&family=Playwrite+AU+SA:wght@100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
        include "./src/components/phplogic/function.php";
        include "src/components/header.php";

        if (!isset($_SESSION['username'])) {
            echo "
            <script> window.location.href = 'loginpage.php'; </script>
            ";
            exit();
        }
        ?>

        <div class="d-flex">
            <?php include "src/components/sidebar.php" ?>
            <main class="bg-body-tertiary w-100 border-start">
                <div class="contindex">
                    <?php
                    $page = $_GET['page'] ?? 0;
                    switch ($page) {
                        case 1:
                            include __DIR__ . "/src/components/produk.php";
                            break;
                        case 2:
                            include __DIR__ . "/src/components/pesanan.php";
                            break;
                        case 3:
                            include __DIR__ . "/src/components/penjualan.php";
                            break;
                        case 4:
                            include __DIR__ . "/src/components/user.php";
                            break;
                        default:
                            include __DIR__ . "/src/components/main.php";
                            break;
                        }
                        ?>
                </div>
                <?php include "src/components/footer.php";?>
            </main>
        </div>
        
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>
