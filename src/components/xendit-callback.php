<?php
$data = json_decode(file_get_contents('php://input'), true);

// Verifikasi data (optionally: signature)
// Simpan status ke database jika status == SUCCESS
file_put_contents('xendit-callback-log.txt', json_encode($data).PHP_EOL, FILE_APPEND);
