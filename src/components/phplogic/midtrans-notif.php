<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

// === KONFIGURASI DATABASE ===
$dat4bas3 = new mysqli("localhost", "root", "", "nyemilgeh");
if ($dat4bas3->connect_error) {
    http_response_code(500);
    error_log("Koneksi database gagal: " . $dat4bas3->connect_error);
    exit("Koneksi database gagal.");
}

// === KONFIGURASI MIDTRANS ===
\Midtrans\Config::$serverKey = 'SB-Mid-server-J8HsOi4G92jfmUrpznhC8e6I';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// === BACA JSON BODY ===
$raw_input = file_get_contents("php://input");
$data = json_decode($raw_input, true);

if (!$data || !isset($data['order_id'])) {
    http_response_code(400);
    error_log("Webhook tidak valid atau tidak ada order_id.");
    exit("Request tidak valid.");
}

// === AMBIL DATA ===
$transaction_status = $data['transaction_status'] ?? '';
$payment_type       = $data['payment_type'] ?? '';
$order_id_string    = $data['order_id'];
$transaction_id     = $data['transaction_id'] ?? '';
$transaction_time   = $data['transaction_time'] ?? date('Y-m-d H:i:s');
$status_code        = $data['status_code'] ?? '';
$raw_response       = json_encode($data);

// === EKSTRAK ORDER_ID ===
function extractOrderId(string $midtrans_order_id): ?int {
    if (preg_match('/^ORDER-(\d+)$/', $midtrans_order_id, $matches)) {
        return (int) $matches[1];
    }
    return null;
}
$order_id = extractOrderId($order_id_string);
if (!$order_id) {
    http_response_code(400);
    exit("Format order ID tidak valid.");
}

// === JIKA TRANSAKSI BERHASIL ===
if (in_array($transaction_status, ['settlement', 'capture'])) {
    // Update order status
    $stmt = $dat4bas3->prepare("UPDATE orders SET status = 'paid' WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    if (!$stmt->execute()) {
        error_log("Gagal update status order: " . $stmt->error);
    }

    // Simpan data pembayaran
    $stmt = $dat4bas3->prepare("
        INSERT INTO payments (order_id, payment_type, transaction_id, status, paid_at, raw_response)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("isssss", $order_id, $payment_type, $transaction_id, $transaction_status, $transaction_time, $raw_response);
    if (!$stmt->execute()) {
        error_log("Gagal menyimpan pembayaran: " . $stmt->error);
    }

    // Hapus cart items user
    $stmt = $dat4bas3->prepare("SELECT user_id FROM orders WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $user_id = $row['user_id'];
        $stmt = $dat4bas3->prepare("DELETE FROM cart_items WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    }
}

http_response_code(200);
echo "OK";
