<?php
include "Partials/header.php";
include "Partials/navigation.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
$result=mysqli_query($connection, "SELECT * FROM users");
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['edit_user'])) {
        $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
        $new_username = mysqli_real_escape_string($connection, $_POST['username']);
        $new_email = mysqli_real_escape_string($connection, $_POST['email']);
        $sql = "UPDATE users SET email='$new_email', username = '$new_username' WHERE id='$user_id'";
        $result = mysqli_query($connection, $sql);
        $query_status = check_query($connection, $result);
        if ($query_status === true) {
            $_SESSION['message'] = "User updated successfully to {$new_username}.";
            $_SESSION['message_type'] = "success";
            header("Location: admin.php");
            exit;
        }
    } elseif (isset($_POST['delete_user'])) {
        $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
        $sql = "DELETE FROM users WHERE id='$user_id'";
        $result = mysqli_query($connection, $sql);
        $query_status = check_query($connection, $result);
        if ($query_status === true){
            $_SESSION['message'] = "User deleted successfully record with ID:{$user_id}";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error deleting user: " . $query_status;
            $_SESSION['message_type'] = "error";
        }

        if (check_query($connection, $result)) {
            header("Location: admin.php");
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    
</body>
</html>
<nav>
    <ul>
        <li>
            <a href="index.html">Home</a>
        </li>

        <!-- When the user is logged in -->
        <li>
            <a href="Admin/admin.html">Admin</a>
        </li>
        <li>
            <a href="Admin/logout.html">Logout</a>
        </li>

        <!-- When the user is not logged in -->
        <li>
            <a href="Admin/register.html">Register</a>
        </li>
        <li>
            <a href="Admin/login.html">Login</a>
        </li>
    </ul>
</nav>

<h1>Manage Users</h1>

<div class="container">
    <?php if(isset($_SESSION['message'])): ?>
        <div class="notification<?php echo $_Session['message_type']?>">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);    
                unset($_SESSION['message_type']);
            ?>
        </div>
       
        <?php endif; ?>
    <table class="user-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php while($user=mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $user['id']?></td>
            <td><?php echo $user['username']?></td>
            <td><?php echo $user['email']?></td>
            <td><?php echo full_month_date($user['reg_date'])?></td>
            <td>
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                     <input type="text" name="username" value="<?php echo $user['username'];?>" required>
                    <input type="email" name="email" value="<?php echo $user['email'];?>" required>
                    <button class="edit" type="submit" name="edit_user">Edit</button>
                </form>
                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <button class="delete" type="submit" name="delete_user">Delete</button>
                </form>
            </td>
        </tr>
        
            <?php endwhile; ?>
        <!-- Additional user rows can go here -->
        </tbody>
    </table>
</div>

<!-- Include Footer -->
<?php
include "Partials/footer.php";
mysqli_close($connection);
?>
