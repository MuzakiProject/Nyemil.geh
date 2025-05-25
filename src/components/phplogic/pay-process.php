<?php
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';
include "function.php";

header('Content-Type: application/json');

$dat4bas3 = new mysqli("localhost", "root", "", "nyemilgeh");
if ($dat4bas3->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

\Midtrans\Config::$serverKey = 'SB-Mid-server-J8HsOi4G92jfmUrpznhC8e6I';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil data dari POST dan GET
$nama = $_POST['nama'] ?? '';
$no_telp = $_POST['no_telp'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$provinsi = $_POST['provinsi'] ?? '';
$kota = $_POST['kota'] ?? '';
$kurir = $_POST['kurir'] ?? '';
$ongkir = (int) ($_POST['ongkir'] ?? 0);
$total = (int) ($_POST['total'] ?? 0);
$produk_id = (int) ($_GET['produk_id'] ?? 0);
$qty = (int) ($_GET['quantity'] ?? 1);

if (!$produk_id) {
    http_response_code(400);
    echo json_encode(["error" => "Produk tidak ditemukan"]);
    exit;
}

$produk = getProdukById($produk_id);
if (!$produk) {
    http_response_code(404);
    echo json_encode(["error" => "Produk tidak tersedia"]);
    exit;
}

// Buat order_id Midtrans
$order_id_midtrans = 'ORDER-' . time() . '-' . rand(1000, 9999);

// Simpan ke tabel orders
$shipping_address = "$alamat, $kota, $provinsi";
$user_id = $_SESSION['user'] ?? null;

$stmt = $dat4bas3->prepare("INSERT INTO orders (user_id, total_payment, service, status, shipping_address, courier, shipping_cost, no_telp) VALUES (?, ?, 'Pesan Antar', 'pending', ?, ?, ?, ?)");
$stmt->bind_param("idssds", $user_id, $total, $shipping_address, $kurir, $ongkir ,$no_telp);
$stmt->execute();
$order_db_id = $stmt->insert_id;
$stmt->close();

// Simpan ke order_items
$stmt2 = $dat4bas3->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
$stmt2->bind_param("iiid", $order_db_id, $produk_id, $qty, $produk['price']);
$stmt2->execute();
$stmt2->close();

// Buat parameter untuk Midtrans
$transaction = [
    'transaction_details' => [
        'order_id' => $order_id_midtrans,
        'gross_amount' => $total
    ],
    'item_details' => [
        [
            'id' => $produk['id'],
            'price' => $produk['price'],
            'quantity' => $qty,
            'name' => $produk['productname']
        ],
        [
            'id' => 'ONGKIR',
            'price' => $ongkir,
            'quantity' => 1,
            'name' => 'Ongkos Kirim'
        ]
    ],
    'customer_details' => [
        'first_name' => $nama,
        'phone' => $no_telp,
        'shipping_address' => [
            'address' => $alamat,
            'city' => $kota,
            'postal_code' => '',
            'country_code' => 'IDN'
        ]
    ]
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($transaction);
    echo json_encode(['token' => $snapToken]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
