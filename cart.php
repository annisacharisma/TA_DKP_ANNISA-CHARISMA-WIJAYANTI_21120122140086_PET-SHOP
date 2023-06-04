<?php
session_start();

$con = new mysqli("localhost", "root", "", "pawpals");

if(empty(($_SESSION["cart"]) OR !isset($_SESSION["cart"]))){
    echo "<script>alert('keranjang kosong');</script>";
    echo "<script>location='product.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<section class="konten">
    <div class="container">
        <h1>Keranjang Belanja
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php foreach ($_SESSION["cart"] as $id_product => $jumlah): ?>
                <?php
                $ambil = $con->query("SELECT * FROM products
                    WHERE id_product='$id_product'");
                $pecah = $ambil->fetch_assoc();
                $subharga = $pecah["price_product"]*$jumlah;
                ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah["name_product"]; ?></td>
                    <td>Rp. <?php echo number_format ($pecah["price_product"]); ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td>Rp. <?php echo number_format($subharga); ?></td>
                    <td>
                        <a href="hapus_cart.php?id=<?php echo $id_product ?>" class="btn btn-danger btn-xs">delete</a>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php endforeach  ?>
            </tbody>
        </table>
        
        <a href="product.php" class="btn btn-default">Lanjutkan Belanja</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
        </h1>
    </div>
</section>

<script src="script.js"></script>

</body>
</html>