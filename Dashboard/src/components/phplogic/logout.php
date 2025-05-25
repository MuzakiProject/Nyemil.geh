<?php
session_start();
session_unset(); // Menghapus semua variabel session
session_destroy(); // Menghancurkan session
echo "
<script> window.location.href='/Dashboard/loginpage.php' </script>
";
exit();
