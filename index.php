<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "Partials/header.php";
 include "Partials/navigation.php";
?>

<div class="hero">
    <div class="hero-content">
        <h1>Welcome to php login app</h1>
        <h2>Securely login and manage your account with us</h2>
        <div class="hero-buttons">
           
            <a class='btn' href="login.php">Login</a>
            <a class='btn' href="register.php">Register</a>
           
        </div>
    </div>
</div>
    
    
    
<?php include "Partials/footer.php";?>