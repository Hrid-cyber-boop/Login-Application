<?php

$error = "";

include "Partials/header.php";
include "Partials/navigation.php";



if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
    header("Location: admin.php");
    exit;
}
    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username= '$username' LIMIT 1";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            header("Location: admin.php");
            exit;
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "Invalid user";
    }
}
?>




<div class="container">
    
    
<div class="container">
<div class="form-container">

    <form method="POST" action="">
        <h2>Login to your Account</h2>

        <?php if($error): ?>
            <p style="color:red">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>

        <label for="username">Username:</label>
        <input placeholder="Enter your username" value="<?php echo isset($username) ? $username : ''; ?>"  placeholder="Enter your username" type="text" name="username"required >

        
        <label for="password">Password:</label>
        <input placeholder="Enter your password"  type="password" name="password" required>


        <input type="submit" value="Login">
    </form>
</div>
</div>
</div>
<?php
include "Partials/footer.php";

?>

<?php
mysqli_close($connection);
?>