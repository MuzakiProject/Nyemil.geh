<!doctype html>
<html lang="en">
    <head>
        <title>Nyemil.geh</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css?v= <?php echo time(); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
        <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&family=Playwrite+AU+SA:wght@100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
        session_start();

        include __DIR__ . "/src/components/phplogic/function.php";
        
        $footer = true;
        $nav = true;
        ?>
        
        <main class=" w-100">
            <div class="contindex">
                <?php
                $page = $_GET['page'] ?? 0;
                switch ($page) {
                    case 1:
                        include __DIR__ . "/src/components/store.php";
                        break;
                    case 2:
                        include __DIR__ . "/src/components/helpsupp.php";
                        break;
                    case 3:
                        include __DIR__ . "/src/components/accsupp.php";
                        break;
                    case 4:
                        include __DIR__ . "/src/components/aboutkami.php";
                        break;
                    case 5:
                        include __DIR__ . "/src/components/detitems.php";
                        break;
                    case 6:
                        $footer = false;
                        include __DIR__ . "/src/components/paybayar.php";
                        break;
                    default:
                        include __DIR__ . "/src/components/main.php";
                        break;
                }
                ?>
            </div>
        </main>
        <?php
            $is_logged_in = isset($_SESSION['user']);
            if ($is_logged_in) {
                include __DIR__ . "/src/components/headerlog.php";
            } else {
                nav($nav);
            }
            footer($footer);
        ?>
        
        <script src="src/components/js/navanim.js"></script>
        <script src="src/components/js/counterplusmin.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/scrollreveal"></script>
        <script>
            ScrollReveal().reveal('.textmain, .prod-cover, .about-cover, .prom-cover, .store-cover, .brand-about, .Visi-misi', {
                duration: 1000,
                origin: 'bottom',
                distance: '50px',
                reset: false, // no repeat
            });
        </script>
    </body>
</html>
