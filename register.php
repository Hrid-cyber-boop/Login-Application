<?php
include "Partials/header.php";
include "Partials/navigation.php";
$error="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username= mysqli_real_escape_string($connection,$_POST['username']);
    $email= mysqli_real_escape_string($connection,$_POST['email']);
    $password= mysqli_real_escape_string($connection,$_POST['password']);
    $confirm_password= mysqli_real_escape_string($connection,$_POST['confirm_password']);
    if($password!==$confirm_password){
        $error= "Passwords do not match";
    }else{
       
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    $error = "Username already exists.";
} else {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email) VALUES('$username', '$passwordHash', '$email')";
    
    if (mysqli_query($connection, $sql)) {
        redirect("login.php?registered=1");
        exit;
    } else {
        $error = "Something went wrong: " . mysqli_error($connection);
    }
}

        // $sql = "INSERT INTO users (username, password, email) VALUES('$username', '$passwordHash', '$email')";
        
        // if($result){
        //     echo"<pre>";
        //     var_dump($result);
        //     echo "</pre>";
        // }
        // exit;
       
    }
}



?>



    
   
    
<div class="container">
       
       
<div class="form-container">
     

    <form method="POST" action="">
        <h2>
                Register and create an account
        </h2>
     
        <?php if($error): ?>
            <p style="color:red">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>

        <label for="username">Username:</label>
       <input type="text" name="username" placeholder="Enter your username" required value="<?php echo isset($username) ? $username : ''; ?>">


        <label for="email">Email:</label>
        <input  value="<?php echo isset($email) ? $email : ''; ?>" placeholder="Enter your email"  type="email" name="email" required >

        <label for="password">Password:</label>
        <input placeholder="Enter your password"  type="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input  placeholder="Confirm your password" type="password" name="confirm_password" required>

        <input type="submit" value="Register">
    </form>
</div>
</div>
<?php
include "Partials/footer.php";

?>
<?php
mysqli_close($connection);
?>