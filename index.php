<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawPals Pet Shop</title>
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
        echo "<script>location='index.php';</script>";
    } else {
        // Anda gagal login
        echo "<script>alert('Login gagal')</script>";
        echo "<script>location='index.php';</script>";
    }
}
?>

<!-- header section starts -->

<header class="header">
    <a href="product.php" class="logo"> <i class="fas fa-paw"></i> shop </a>

    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="about.php">about</a>
        <a href="#shop">product</a>
        <a href="product.php">shop</a>
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <?php if (isset($_SESSION["pelanggan"])): ?>
            <a href="logout.php" class="fas fa-logout" id="logout-btn">logout</a>
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

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <h3> <span>hi</span> welcome to PawPals pet shop </h3>
        <a href="product.php" class="btn">shop now</a>
    </div>

    <img src="image/bottom_wave.png" class="wave" alt="">

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="image">
        <img src="image/about_img.png" alt="">
    </div>

    <div class="content">
        <h3>premium <span>pet food</span></h3>
        <p>Premium pet food memiliki manfaat yang signifikan bagi kesehatan dan kualitas hidup hewan peliharaan kita. Dengan memberikan makanan yang berkualitas tinggi, kita dapat memberikan nutrisi optimal yang dibutuhkan oleh hewan peliharaan kita, menjaga kesehatan mereka, dan juga dapat memperpanjang umur mereka. Pilihlah makanan hewan premium yang sesuai dengan jenis dan kebutuhan hewan peliharaan Anda, dan lihatlah perubahan positif yang terjadi dalam hidup mereka.</p>
        <a href="about.php" class="btn">read more</a>
    </div>

</section>

<!-- about section ends -->

<!-- dog and cat food banner section starts -->

<div class="dog-food">

    <div class="image">
        <img src="image/dog_food.png" alt="">
    </div>

    <div class="content">
        <h3> <span>air dried</span> dog food </h3>
        <p>The Perfect Balance of Nutrition and Taste! Give your beloved canine companion the ultimate dining experience with premium air dried dog food. Specially crafted using the finest ingredients and a gentle drying process, our dog food offers a multitude of benefits that will keep your furry friend happy, healthy, and begging for more!</p>
        <div class="amount">Rp80.000 - Rp500.000</div>
        <a href="product.php"> <img src="image/shop_now_dog.png" alt=""> </a>
    </div>

</div>

<div class="cat-food">

    <div class="content">
        <h3> <span>air dried</span> cat food </h3>
        <p>Unleash the Health and Happiness in Your Feline Friend! Give your beloved feline companion the purrfect dining experience with premium air dried cat food. Crafted with love and care, our cat food offers a plethora of benefits that will keep your furry friend thriving and content.</p>
        <div class="amount">Rp80.000 - Rp500.000</div>
        <a href="product.php"> <img src="image/shop_now_cat.png" alt=""> </a>
    </div>

    <div class="image">
        <img src="image/cat_food.png" alt="">
    </div>

</div>

<!-- dog and cat food banner section ends -->

<section class="shop" id="shop">

    <h1 class="heading"> our <span> products </span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <img src="image/cat_food_01.png" alt="">
            </div>
            <div class="content">
                <h3>Cat Food Meow Mix</h3>
                <div class="amount"> 180,000 </div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="image/dog_food_01.png" alt="">
            </div>
            <div class="content">
                <h3>Hills Science Diet Senior Breed Dry Dog Food</h3>
                <div class="amount"> 350,000 </div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="image/cat_food_02.png" alt="">
            </div>
            <div class="content">
                <h3>IAMS Dry Cat Food Adult</h3>
                <div class="amount"> 500,000 </div>
            </div>
        </div>

</section>

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
