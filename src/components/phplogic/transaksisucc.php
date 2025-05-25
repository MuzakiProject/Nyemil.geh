<?php
$dat4bas3 = mysqli_connect("localhost", "root", "", "nyemilgeh");
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['result'])) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
    exit;
}

$result = $data['result'];
$user_id = $_SESSION['user']['id'] ?? null;

if (!$user_id) {
    echo json_encode(['status' => 'error', 'message' => 'User belum login']);
    exit;
}

$transaction_id = $result['transaction_id'];
$order_id = $result['order_id'];
$gross_amount = $result['gross_amount'];
$payment_type = $result['payment_type'];
$transaction_status = $result['transaction_status'];
$payment_code = $result['payment_code'] ?? ($result['va_numbers'][0]['va_number'] ?? null);
$payment_method = $result['payment_type'];
$transaction_time = $result['transaction_time'];

// Informasi tambahan dari sesi/form
$nama = $_SESSION['checkout']['nama'];
$alamat = $_SESSION['checkout']['alamat'];
$no_telp = $_SESSION['checkout']['no_telp'];
$kota = $_SESSION['checkout']['kota'];
$provinsi = $_SESSION['checkout']['provinsi'];
$kurir = $_SESSION['checkout']['kurir'];
$ongkir = $_SESSION['checkout']['ongkir'];
$total_bayar = $_SESSION['checkout']['total'];
$produk_id = $_SESSION['checkout']['produk_id'];
$qty = $_SESSION['checkout']['qty'];
$subtotal = $_SESSION['checkout']['subtotal'];

// Simpan ke tabel orders
$query = $dat4bas3->prepare("INSERT INTO orders (user_id, id, shipping_address, courier, shipping_cost, total_payment, service, status, created_at, no_telp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pesan Antar', 'Pending', NOW(), ?)");
$query->bind_param("iisdds", $user_id, $order_id, $alamat, $kurir, $ongkir, $total_bayar, $no_telp);
$query->execute();
$order_db_id = $dat4bas3->insert_id;

// Simpan ke order_items
$query = $dat4bas3->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)");
$query->bind_param("iiidd", $order_db_id, $produk_id, $qty, $subtotal / $qty, $subtotal);
$query->execute();

// Simpan ke payments
$query = $dat4bas3->prepare("INSERT INTO payments (order_id, transaction_id, payment_type, payment_code, gross_amount, transaction_status, transaction_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
$query->bind_param("isssdss", $order_db_id, $transaction_id, $payment_type, $payment_code, $gross_amount, $transaction_status, $transaction_time);
$query->execute();

// Bersihkan session checkout
unset($_SESSION['checkout']);

echo json_encode(['status' => 'success']);
?>