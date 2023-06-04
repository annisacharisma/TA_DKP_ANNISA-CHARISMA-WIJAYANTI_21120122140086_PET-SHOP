<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
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
        echo "<script>location='about.php';</script>";
    } else {
        // Anda gagal login
        echo "<script>alert('Login gagal')</script>";
        echo "<script>location='about.php';</script>";
    }
}
?>

<!-- header section starts -->

<header class="header">
    <a href="product.php" class="logo"> <i class="fas fa-paw"></i> shop </a>

    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="about.php">about</a>
        <a href="product.php">shop</a>
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <?php if (isset($_SESSION["pelanggan"])): ?>
            <a href="logout.php" class="fas fa-logout" id="login-btn">logout</a>
        <?php else: ?>
            <a class="fas fa-user" id="login-btn"></a>
        <?php endif; ?>
        <a href="about.php"></a>
    </div>

    <form action="" class="login-form" method="post">
        <h3>sign in</h3>
        <input type="email" name="email" placeholder="enter your email" id="" class="box">
        <input type="password" name="password" placeholder="enter your password" id="" class="box">
        <input type="submit" name="login" value="login" class="btn">
    </form>

</header>

<div class="image">
    <img src="image/catdog.png" alt="">
</div>

<section class="about" id="about">

    <div class="image">
        <img src="image/about_img.png" alt="">
    </div>

    <div class="content">
        <h3>premium <span>pet food</span></h3>
        <p>Premium pet food memiliki manfaat yang signifikan bagi kesehatan dan kualitas hidup hewan peliharaan kita. Dengan memberikan makanan yang berkualitas tinggi, kita dapat memberikan nutrisi optimal yang dibutuhkan oleh hewan peliharaan kita, menjaga kesehatan mereka, dan juga dapat memperpanjang umur mereka. Pilihlah makanan hewan premium yang sesuai dengan jenis dan kebutuhan hewan peliharaan Anda, dan lihatlah perubahan positif yang terjadi dalam hidup mereka.</p>
    </div>

</section>

<div class="dog-food">

    <div class="content">
        <h3> <span>DOG</span> FOOD </h3>
        <p>Makanan hewan premium untuk anjing kita adalah pilihan yang tepat untuk memberikan nutrisi optimal bagi hewan peliharaan tercinta Anda. Beberapa poin penting yang perlu dipertimbangkan ketika mencari makanan premium untuk anjing peliharaan yaitu, Kandungan Bahan Berkualitas Tinggi seperti daging, ikan, biji-bijian, sayuran dan buah-buahan. Bebas dari Bahan Pengisi Rendah Kualitas seperti jagung dan gandum. Mengandung Sumber Lemak Sehat seperti minyak ikan atau minyak bunga matahari, karena asam lemak omega-3 dan omega-6 yang ditemukan dalam lemak sehat dapat mendukung kesehatan kulit dan bulu anjing, serta memperkuat sistem kekebalan tubuh mereka. Pastikan juga makanan yang dipilih memiliki Kandungan Serat yang Tepat serta tanpa bahan pengawet.</p>
    </div>

    <div class="image">
        <img src="image/about_dog.jpg" alt="">
    </div>

</div>

<div class="cat-food">

    <div class="image">
        <img src="image/about_cat.jpg" alt="">
    </div>

    <div class="content">
        <h3> <span>CAT</span> FOOD </h3>
        <p>Untuk memenuhi nutrisi kucing, makanan kucing atau cat food dari berbagai merek banyak bermunculan. Ada dua jenis makanan untuk kucing: kering dan basah. Makanan kering cocok sebagai makanan utama karena tahan lama dan membantu melatih gigi kucing serta mencegah akumulasi plak. Makanan basah lebih banyak mengandung air dan memiliki variasi rasa yang lebih banyak. Pemberian snack sangat dianjurkan saat kucing sedang kurang nafsu makan. Selain disajikan terpisah, Anda juga bisa menjadikan snack sebagai topping di makanan utamanya. Kucing yang sedang diet pun bisa dilengkapi nutrisinya lewat snack. Kucing yang sakit atau dalam kondisi khusus memerlukan makanan yang diformulasikan khusus. Kucing dewasa dan anak kucing memiliki kebutuhan gizi yang berbeda. Kucing dewasa memerlukan makanan bergizi lengkap, sementara kucing senior perlu makanan rendah kalori.</p>
    </div>

</div>

<section class="footer">

    <img src="image/top_wave.png" alt="">

    <div class="share">
        <a href="#" class="btn"> <i class="fab fa-whatsapp"></i> whatsapp </a>
        <a href="#" class="btn"> <i class="fab fa-twitter"></i> twitter </a>
        <a href="#" class="btn"> <i class="fab fa-instagram"></i> instagram </a>
    </div>

    <div class="credit"> created by <span> PawPals </span> | all rights reserved! </div>

</section>

<script src="script.js"></script>

</body>
</html>