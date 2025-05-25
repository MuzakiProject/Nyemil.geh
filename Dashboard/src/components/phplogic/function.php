<?php
require "database.php";

function loginUser($username, $password) {
    global $dat4bas3;

    $stmt = $dat4bas3->prepare("SELECT id, username FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result) {
        echo "Rows: " . $result->num_rows; // debug
    } else {
        echo "Error: " . $dat4bas3->error;
    }

    if ($result && $result->num_rows === 1) {
        return $result->fetch_assoc();
    }

    return false;
}


function getTotalProductCount($dat4bas3) {
    $query = "SELECT COUNT(id) AS total FROM products";
    $result = mysqli_query($dat4bas3, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    } else {
        return 0;
    }
}

function getTotalUser($dat4bas3) {
    $query = "SELECT COUNT(id) AS total FROM users";
    $result = mysqli_query($dat4bas3, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    } else {
        return 0;
    }
}

function getTotalOrder($dat4bas3) {
    $query = "SELECT COUNT(id) AS total FROM orders";
    $result = mysqli_query($dat4bas3, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    } else {
        return 0;
    }
}

function getTotalPendapatan($dat4bas3) {
    $query = "SELECT SUM(price * quantity) AS total_pendapatan FROM order_items";
    $result = mysqli_query($dat4bas3, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_pendapatan'];
    } else {
        return 0;
    }
}


function inputproduk($input){
    global $dat4bas3;

    $gambar = $input["gambar"];
    $namaproduk = htmlspecialchars($input["namaproduk"]);
    $deskripsi = nl2br(htmlspecialchars($input["deskripsi"]));
    $harga = htmlspecialchars($input["harga"]);
    $stok = htmlspecialchars($input["stok"]);
    $berat = htmlspecialchars($input["berat"]);

    $query = $dat4bas3->prepare("INSERT INTO products (productname, description, price, stock, weight, image_product) 
    VALUES (?, ?, ?, ?, ?, ?)");

    $query -> bind_param("ssdiis", $namaproduk, $deskripsi, $harga, $stok, $berat, $gambar);
    $query -> execute();

    $mysqli_affected_rows = $query->affected_rows;
    $query -> close();

    return $mysqli_affected_rows;
}


function tampilproduk($query){
    global $dat4bas3;
    
    $rows = [];
    $result = mysqli_query($dat4bas3, $query);
    while ($produk = mysqli_fetch_assoc($result)){
        $rows[] = $produk;
    }

    return $rows;
}

function detailproduk($id) {
    global $dat4bas3;
    
    $query = $dat4bas3->prepare("SELECT * FROM products WHERE id = ?");
    $query ->  bind_param("i", $id);
    $query -> execute();
    $result = $query -> get_result();

    return $result -> fetch_assoc();
}

function hapusproduk($id){
    global $dat4bas3;

    $query = $dat4bas3 -> prepare("DELETE FROM products WHERE id = ?");
    $query -> bind_param("i", $id);
    $query -> execute();

    $mysqli_affected_rows = $query -> affected_rows;
    $query -> close();

    return $mysqli_affected_rows;
}

function tampiluser($query){
    global $dat4bas3;
    
    $rows = [];
    $result = mysqli_query($dat4bas3, $query);
    while ($produk = mysqli_fetch_assoc($result)){
        $rows[] = $produk;
    }

    return $rows;
}

function infouser($id) {
    global $dat4bas3;
    
    $query = $dat4bas3->prepare("SELECT * FROM users WHERE id = ?");
    $query ->  bind_param("i", $id);
    $query -> execute();
    $result = $query -> get_result();

    return $result -> fetch_assoc();
}

function hapususer($id){
    global $dat4bas3;

    $query = $dat4bas3 -> prepare("DELETE FROM users WHERE id = ?");
    $query -> bind_param("i", $id);
    $query -> execute();

    $mysqli_affected_rows = $query -> affected_rows;
    $query -> close();

    return $mysqli_affected_rows;
}

function getAllOrderDetails() {
    global $dat4bas3; 

    $sql = "
        SELECT 
            u.id AS user_id,
            u.username AS user_name,
            o.id AS order_id,
            o.created_at AS order_date,
            o.total_payment,
            o.status AS order_status,
            o.shipping_address,
            o.courier,
            o.service,
            o.shipping_cost,
            
            p.productname,
            p.image_product,
            oi.quantity,
            oi.price AS item_price,
            (oi.quantity * oi.price) AS item_subtotal,

            pay.payment_type,
            pay.transaction_id,
            pay.status AS payment_status,
            pay.paid_at

        FROM orders o
        JOIN users u ON o.user_id = u.id
        JOIN order_items oi ON o.id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        LEFT JOIN payments pay ON o.id = pay.order_id
        ORDER BY o.created_at DESC
    ";

    $result = $dat4bas3->query($sql);

    if (!$result) {
        die("Query error: " . $dat4bas3->error);
    }

    return $result;
}

function getOrderDetailById($order_id) {
    global $dat4bas3;

    $stmt = $dat4bas3->prepare("
        SELECT 
            o.id AS order_id,
            o.total_payment,
            o.status AS order_status,
            o.shipping_address,
            o.created_at,

            oi.quantity,
            oi.price,

            p.productname,
            p.image_product,

            u.username AS buyer_name,
            u.email AS buyer_email,
            u.address AS buyer_address,
            u.no_telp AS buyer_phone

        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        JOIN users u ON o.user_id = u.id
        WHERE o.id = ?
    ");

    if (!$stmt) {
        return ['error' => 'Query gagal: ' . $dat4bas3->error];
    }

    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return ['error' => 'Data pesanan tidak ditemukan.'];
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function updateOrderStatus($order_id, $new_status) {
    global $dat4bas3;

    $stmt = $dat4bas3->prepare("UPDATE orders SET status = ? WHERE id = ?");
    if (!$stmt) {
        die("Query error: " . $dat4bas3->error);
    }

    $stmt->bind_param("si", $new_status, $order_id);
    $stmt->execute();

    // Opsional: redirect agar POST tidak repeat saat reload
    exit();
}

function getAllAdminActivityLogs() {
    global $dat4bas3;
    $query = "SELECT log.*, admin.username FROM admin_activity_log log
              LEFT JOIN admin ON log.admin_id = admin.id
              ORDER BY log.created_at DESC";
    return $dat4bas3->query($query)->fetch_all(MYSQLI_ASSOC);
}

function getAllUserActivityLogs() {
    global $dat4bas3;
    $query = "SELECT log.*, users.username FROM user_activity_log log
              LEFT JOIN users ON log.user_id = users.id
              ORDER BY log.created_at DESC";
    return $dat4bas3->query($query)->fetch_all(MYSQLI_ASSOC);
}

?>