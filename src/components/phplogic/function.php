<?php

function daftaruser($data) {
    global $dat4bas3;

    $username = htmlspecialchars(trim($data["username"]));
    $email = htmlspecialchars(trim($data["email"]));
    $password = $data["password"];
    $no_telp = htmlspecialchars(trim($data["notelp"]));

    if (empty($username) || empty($email) || empty($password)) {
        return "Harap lengkapi semua data!";
    }

    $check = $dat4bas3->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        return "Email sudah terdaftar!";
    }

    $hashpassword = password_hash($password, PASSWORD_DEFAULT);

    $query = $dat4bas3->prepare("INSERT INTO users (username, email, password, no_telp) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $username, $email, $hashpassword, $no_telp);

    if ($query->execute()) {
        return true;
    } else {
        return "Terjadi kesalahan saat mendaftar!";
    }
}

function loginuser($email, $password) {
    global $dat4bas3;

    $query = $dat4bas3->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['username'],
                'email' => $user['email'],
                'no_telp' => $user['no_telp'],
                'address' => $user['address'] ?? null
            ];
            return true;
        }
    }

    return false;
}

function footer(bool $footer = true): void{
    if (! $footer){
        return;
    }
    include "src/components/footer.php";
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

function cariDanSortProduk($conn, $keyword = '', $sort = '') {
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $sql = "SELECT * FROM products";

    if (!empty($keyword)) {
        $sql .= " WHERE productname LIKE '%$keyword%'";
    }

    if ($sort === 'tertinggi') {
        $sql .= " ORDER BY price DESC";
    } elseif ($sort === 'terendah') {
        $sql .= " ORDER BY price ASC";
    }

    $result = mysqli_query($conn, $sql);
    $data = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    return $data;
}


function detailproduk($id) {
    global $dat4bas3;

    $query = $dat4bas3->prepare("SELECT * FROM products WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_assoc();
}

function tambahKeKeranjang($user_id, $product_id, $quantity) {
    global $dat4bas3;

    $query = $dat4bas3->prepare("SELECT quantity FROM cart_items WHERE user_id = ? AND product_id = ?");
    $query->bind_param("ii", $user_id, $product_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {

        $array = $result->fetch_assoc();
        $new_qty = $array['quantity'] + $quantity;

        $update = $dat4bas3->prepare("UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $update->bind_param("iii", $new_qty, $user_id, $product_id);
        $update->execute();

        return $update->affected_rows > 0;
    } else {

        $insert = $dat4bas3->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insert->bind_param("iii", $user_id, $product_id, $quantity);
        $insert->execute();

        return $insert->affected_rows > 0;
    }
}

function getKeranjangByUser($user_id) {
    global $dat4bas3;
    $query = $dat4bas3->prepare("
        SELECT c.product_id, c.quantity, p.productname, p.price, p.image_product, p.weight
        FROM cart_items c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?
    ");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();

    $items = [];
    while ($array = $result->fetch_assoc()) {
        $items[] = $array;
    }
    return $items;
}

function updateKeranjangQty($user_id, $product_id, $quantity) {
    global $dat4bas3;
    if ($quantity < 1) $quantity = 1;

    $query = $dat4bas3->prepare("UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?");
    $query->bind_param("iii", $quantity, $user_id, $product_id);
    $query->execute();
    return $query->affected_rows > 0;
}

function hapusDariKeranjang($user_id, $product_id) {
    global $dat4bas3;
    $query = $dat4bas3->prepare("DELETE FROM cart_items WHERE user_id = ? AND product_id = ?");
    $query->bind_param("ii", $user_id, $product_id);
    $query->execute();
    return $query->affected_rows > 0;
}

function getProdukById($id) {
    global $dat4bas3;

    $query = $dat4bas3->prepare("SELECT * FROM products WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();

    $result = $query->get_result();
    return $result->fetch_assoc();
}

function getKeranjang($user_id) {
    global $dat4bas3;
    $query = $dat4bas3->prepare("
        SELECT c.*, p.productname, p.price, p.description, p.image_product, p.weight
        FROM cart_items c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?
    ");
    $query->bind_param("i", $user_id);
    $query->execute();
    return $query->get_result()->fetch_all(MYSQLI_ASSOC);
}

function hitungTotal($items) {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

function getOrdersByUser($user_id) {
    global $dat4bas3;

    $sql = "SELECT 
                o.id AS order_id,
                o.user_id,
                o.total_payment,
                o.status AS order_status,
                o.shipping_address,
                o.courier,
                o.service,
                o.shipping_cost,
                o.no_telp,
                o.created_at,
                
                oi.product_id,
                p.productname,
                p.image_product,
                oi.quantity,
                oi.price,
                
                pay.payment_type,
                pay.transaction_id,
                pay.status AS payment_status,
                pay.paid_at

            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            LEFT JOIN products p ON oi.product_id = p.id
            LEFT JOIN payments pay ON o.id = pay.order_id
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC";

    $query = $dat4bas3->prepare($sql);
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    return $orders;
}
function getOrderDetail($order_id) {
    global $dat4bas3;

    $query = $dat4bas3->prepare("
        SELECT 
            o.id AS order_id,
            o.user_id,
            o.total_payment,
            o.status AS order_status,
            o.shipping_address,
            o.courier,
            o.service,
            o.shipping_cost,
            o.no_telp,
            o.created_at,
            
            oi.product_id,
            p.productname,
            p.image_product,
            oi.quantity,
            oi.price,
            
            pay.payment_type,
            pay.transaction_id,
            pay.status AS payment_status,
            pay.paid_at

        FROM orders o
        LEFT JOIN order_items oi ON o.id = oi.order_id
        LEFT JOIN products p ON oi.product_id = p.id
        LEFT JOIN payments pay ON o.id = pay.order_id
        WHERE o.id = ?
    ");

    if (!$query) {
        die("Prepare failed: " . $dat4bas3->error);
    }

    $query->bind_param("i", $order_id);
    $query->execute();

    return $query->get_result();
}

function markOrderAsCompleted($order_id) {
    global $dat4bas3;

    $query = $dat4bas3->prepare("UPDATE orders SET status = 'Selesai' WHERE id = ? AND status = 'Dikirim'");
    $query->bind_param("i", $order_id);
    $query->execute();

    return $query->affected_rows > 0;
}

?>