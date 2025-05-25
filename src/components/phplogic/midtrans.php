<?php
session_start();
$dat4bas3 = mysqli_connect("localhost", "root", "", "nyemilgeh");
include "function.php";
require_once __DIR__ . '/../../../vendor/autoload.php';
header('Content-Type: application/json');

\Midtrans\Config::$serverKey = 'SB-Mid-server-J8HsOi4G92jfmUrpznhC8e6I';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil data
$user = $_SESSION['user'] ?? null;
if (!$user) {
    http_response_code(401);
    echo json_encode(['error' => 'User belum login']);
    exit;
}

$user_id = $user['id'];
$nama = $_POST['nama'] ?? '';
$no_telp = $_POST['no_telp'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$provinsi = $_POST['provinsi'] ?? '';
$kota = $_POST['kota'] ?? '';
$kurir = $_POST['kurir'] ?? '';
$ongkir = (int)$_POST['ongkir'] ?? 0;
$total = (int)$_POST['total'] ?? 0;

$items = getKeranjang($user_id);
if (empty($items)) {
    http_response_code(400);
    echo json_encode(['error' => 'Keranjang kosong']);
    exit;
}

// Buat order_id untuk Midtrans dan database
$order_code = 'ORDER-' . time();

// Simpan ke tabel `orders`
$alamat_lengkap = $alamat . ', ' . $kota . ', ' . $provinsi;
$stmt = $dat4bas3->prepare("INSERT INTO orders (user_id, total_payment, service, status, shipping_address, courier, shipping_cost, no_telp) VALUES (?, ?, 'Pesan Antar', 'pending', ?, ?, ?, ?)");
$stmt->bind_param("idssds", $user_id, $total, $alamat_lengkap, $kurir, $ongkir, $no_telp);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

// Simpan item ke tabel `order_items`
$stmt2 = $dat4bas3->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
foreach ($items as $item) {
    $stmt2->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
    $stmt2->execute();
}
$stmt2->close();

// Kosongkan keranjang
$dat4bas3->query("DELETE FROM cart_items WHERE user_id = $user_id");

// Siapkan Midtrans
$item_details = [];
foreach ($items as $item) {
    $item_details[] = [
        'id' => $item['product_id'],
        'price' => $item['price'],
        'quantity' => $item['quantity'],
        'name' => $item['productname']
    ];
}

// Tambahkan biaya ongkir
$item_details[] = [
    'id' => 'ongkir',
    'price' => $ongkir,
    'quantity' => 1,
    'name' => "Ongkos Kirim ($kurir)"
];

$transaction_details = [
    'order_id' => $order_code,
    'gross_amount' => $total
];

$customer_details = [
    'first_name' => $nama,
    'phone' => $no_telp,
    'shipping_address' => [
        'address' => $alamat_lengkap
    ]
];

$transaction = [
    'transaction_details' => $transaction_details,
    'item_details' => $item_details,
    'customer_details' => $customer_details
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($transaction);
    echo json_encode(['token' => $snapToken]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
