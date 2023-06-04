<?php
session_start();
if (isset($_GET['id'])) {
    $id_product = $_GET['id'];

    if (!isset($_SESSION['cart'][$id_product])) {
        $_SESSION['cart'][$id_product] = 1;
    } else {
        $_SESSION['cart'][$id_product] += 1;
    }
}

echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='cart.php';</script>";
?>
