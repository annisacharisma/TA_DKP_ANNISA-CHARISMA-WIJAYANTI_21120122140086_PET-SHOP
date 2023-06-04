<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>our product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php
session_start();

class userService {
    protected $email;
    protected $password;
    protected $dataUser;
    protected $getRole;

    public function __construct($email, $password)
    {
        $this->dataUser = [
            (object) [
                'email'             => "annisacharisma5@gmail.com",
                'password'          => "12345",
            ],
            (object) [
                'email'             => "nama2@gmail.com",
                'password'          => "67890",
            ],
            (object) [
                'email'             => "nama3@gmail.com",
                'password'          => "13579",
            ],
        ];
        $this->email = $email;
        $this->password = $password;
    }

    public function login()
    {
        $user = $this->checkCredentials();
        if ($user) {
            $this->getRole = $user->role;
            $_SESSION["pelanggan"] = true; // Set session variable for successful login
            return true;
        } else {
            return false;
        }
    }

    protected function checkCredentials()
    {
        foreach ($this->dataUser as $key => $value) {
            if ($value->email == $this->email && $value->password == $this->password) {
                return $value;
            }
        }
        return false;
    }

    public function getRole()
    {
        return $this->getRole;
    }
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $userService = new userService($email, $password);
    $loggedIn = $userService->login();

    if ($loggedIn) {
        // Anda berhasil login
        echo "<script>alert('Login berhasil')</script>";
        echo "<script>location='product.php';</script>";
    } else {
        // Anda gagal login
        echo "<script>alert('Login gagal')</script>";
        echo "<script>location='product.php';</script>";
    }
}
?>

<!-- header section starts -->

<header class="header">
    <a href="product.php" class="logo"> <i class="fas fa-paw"></i> shop </a>

    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="about.php">about</a>
        <a href="product.php">product</a>
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <a href="cart.php" class="fas fa-shopping-cart"></a>
        <?php if (isset($_SESSION["pelanggan"])): ?>
            <a href="logout.php" class="fas fa-logout" id="login-btn">logout</a>
        <?php else: ?>
            <a class="fas fa-user" id="login-btn"></a>
        <?php endif; ?>
        <a href="product.php"></a>
    </div>

    <form action="" class="login-form" method="post">
        <h3>sign in</h3>
        <input type="email" name="email" placeholder="enter your email" id="" class="box">
        <input type="password" name="password" placeholder="enter your password" id="" class="box">
        <input type="submit" name="login" value="login" class="btn">
    </form>
</header>

<?php
    $host_db = "localhost";
    $user_db = "root";
    $pass_db = "";
    $name_db = "pawpals";

    $con = mysqli_connect($host_db,$user_db,$pass_db,$name_db);
    if ($con->connect_error) {
        die("Koneksi gagal: " . $con->connect_error);
    }

    $ambil = $con->query("SELECT * FROM products");
    
?>

<section class="shop" id="shop">

    <h1 class="heading"> our <span> products </span> </h1>

    <div class="box-container">
    <?php while ($perproduct = $ambil->fetch_assoc()) { ?>
        <div class="box">
            <div class="icons">
                <a href="tambah_cart.php?id=<?php echo $perproduct['id_product'] ?>" class="fas fa-shopping-cart"></a>
            </div>
            <div class="image">
                <img src="image/<?php echo $perproduct['image_product']; ?>" alt="">
            </div>
            <div class="content">
                <h3><?php echo $perproduct['name_product']; ?></h3>
                <div class="amount"><?php echo number_format($perproduct['price_product']); ?></div>
            </div>
        </div>
    <?php } ?>
    </div>

</section>

<script src="script.js"></script>

</body>
</html>