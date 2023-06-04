<?php
session_start();

$con = new mysqli("localhost", "root", "", "pawpals");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styleinvoice.css">

</head>
<body>

<header class="header">
    <a href="product.php" class="logo"> <i class="fas fa-paw"></i> shop </a>

    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="about.php">about</a>
        <a href="product.php">product</a>
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <?php if (isset($_SESSION["pelanggan"])): ?>
            <a href="logout.php" class="fas fa-logout" id="login-btn">logout</a>
        <?php else: ?>
            <a class="fas fa-user" id="login-btn"></a>
        <?php endif; ?>
        <a href="index.php"></a>
    </div>

    <form action="" class="login-form" method="post">
        <h3>sign in</h3>
        <input type="email" name="email" placeholder="enter your email" id="" class="box">
        <input type="password" name="password" placeholder="enter your password" id="" class="box">
        <input type="submit" name="login" value="login" class="btn">
    </form>


</header>

<section class="home" id="home">
    
        
<?php

$produk = array();
$subtotal = 0;
if (isset($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $id_product => $jumlah) {
        $ambil = $con->query("SELECT * FROM products WHERE id_product='$id_product'");
        $pecah = $ambil->fetch_assoc();
        $subharga = $pecah["price_product"] * $jumlah;

        $produk[] = array(
            'subharga' => $subharga
        );

        $subtotal += $subharga;
    }
}
?>

<section class="invoice">
    <h1>Invoice</h1>
    <div class="invoice-details">
        <p>Nama: <?php echo ($_GET['name']); ?></p>
        <p>Telepon: <?php echo ($_GET['telepon']); ?></p>
        <p>Alamat: <?php echo ($_GET['alamat']); ?></p>
        <p>Metode Pembayaran: <?php echo ($_GET['metode']); ?></p>
    </div>
    <div class="subtotal">
        <h3>Subtotal</h3>
        <p>Rp. <?php echo number_format($subtotal); ?></p>
    </div>
</section>


</body>
</html>
