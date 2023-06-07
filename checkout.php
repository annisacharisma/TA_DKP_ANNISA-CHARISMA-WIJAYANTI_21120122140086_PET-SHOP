<?php
session_start();

$con = new mysqli("localhost", "root", "", "pawpals");

// jika tidak ada session pelanggan yang belum login
if (!isset($_SESSION["pelanggan"]))
{

    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='product.php';</script>";
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
        <h1>Keranjang Belanja</h1>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
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
                </tr>
                <?php $nomor++; ?>
                <?php endforeach  ?>
            </tbody>
        </table>
        
    </div>
</section>

<?php
class KonfirmasiForm {
    private $name;
    private $telepon;
    private $alamat;
    private $metode;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getTelepon() {
        return $this->telepon;
    }

    public function setTelepon($telepon) {
        $this->telepon = $telepon;
    }

    public function getAlamat() {
        return $this->alamat;
    }

    public function setAlamat($alamat) {
        $this->alamat = $alamat;
    }

    public function getMetode() {
        return $this->metode;
    }

    public function setMetode($metode) {
        $this->metode = $metode;
    }
}

if (isset($_POST["checkout"])) {
    $konfirmasiForm = new KonfirmasiForm();
    $konfirmasiForm->setName($_POST['name']);
    $konfirmasiForm->setTelepon($_POST['telepon']);
    $konfirmasiForm->setAlamat($_POST['alamat']);
    $konfirmasiForm->setMetode($_POST['metode']);

    $name = $konfirmasiForm->getName();
    $telepon = $konfirmasiForm->getTelepon();
    $alamat = $konfirmasiForm->getAlamat();
    $metode = $konfirmasiForm->getMetode();

    header("Location: invoice.php?name=" . urlencode($name) . "&telepon=" . urlencode($telepon) . "&alamat=" . urlencode($alamat) . "&metode=" . urlencode($metode));
    exit;
}
?>

<section class="konten">
    <div class="container">
        <form class="confirm-form" method="post">
            <h1>konfirm</h1>
            <div class="form-group">
                <input type="text" name="name" placeholder="enter your name" id="" class="box">
                <input type="tel" name="telepon" placeholder="enter your telepon" id="" class="box">
                <input type="text" name="alamat" placeholder="enter your alamat" id="" class="box">
                <p>Metode Pembayaran</p>
                <p>    
                <select name="metode">
                    <option value=""></option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="E-Commerce">E-Commerce</option>
                    <option value="COD">Cash On Delivery</option>
                </select>
                </p>
            </div>
            <button type="submit" name="checkout" class="btn btn-default">checkout</button>
        </form>
    </div>
</section>
</body>
</html>
