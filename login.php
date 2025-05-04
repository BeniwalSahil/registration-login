<?php 
session_start();
include_once 'connection.php';
$msg = '';
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $select1 = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
    $select_user = mysqli_query($conn,$select1);
    $row = mysqli_num_rows($select_user);
    if($row > 0){
        $fetch = mysqli_fetch_assoc($select_user);
       if($fetch['user_type'] == 'user'){
            $_SESSION['user'] = $fetch['email'];
            $_SESSION['id'] = $fetch['id'];
            header('location: user.php');
       }else if($fetch['user_type'] == 'admin'){
        $_SESSION['admin'] = $fetch['email'];
        $_SESSION['id'] = $fetch['id'];
        header('location: admin.php');
       }else{
        $msg = "Invalid user and password";
       }
    }else{
        echo "No user found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    </head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>
<body>
    <div class="form">
        <form action="<?=($_SERVER['PHP_SELF'])?>" method="post">
            <h2>Login</h2>
            <p class="msg"></p>
              <div class="form-group">
                <!-- <label for="name">Email</label> -->
                <input type="text" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            
            <div>
                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button class="btn font-weight-bold" name="submit">Login Now</button>        
            <p>Don't have an Account? <a href="register.php">Register Here</a></p>
        </form>
    </div> 
</body>
</html>