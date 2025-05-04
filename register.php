<?php 
include 'connection.php';
$msg = '';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];
    $select1 = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
    $select_user = mysqli_query($conn,$select1);
    $row = mysqli_num_rows($select_user);
    if($row > 0){
        $msg = "User already exists";     
    }
    else{
        $insert1 = "INSERT INTO `users`(`name`, `email`, `password`, `user_type`) VALUES ('$name','$email','$password','$user_type')";
        $insert_user = mysqli_query($conn, $insert1);
        if($insert_user){
            $msg = "Registration successful";
            header('location: login.php');
        }else{
            $msg = "Registration failed";
        }
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
        <form action="<? $_SERVER['PHP_SELF']?>" method="post">
            <h2>Registration</h2>
            <p class="msg"><?= $msg?></p>
            <div class="form-group">
                <!-- <label for="name">Name</label> -->
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>
              <div class="form-group">
                <!-- <label for="name">Email</label> -->
                <input type="text" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <select name="user_type" id="" class="form-control">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <!-- <label for="password">Confirm Password</label> -->
                <input type="password" name="cpassword" class="form-control" placeholder="Confirm your password" required>
            </div>  
            <button class="btn font-weight-bold" name="submit">Register Now</button>        
            <p>Already have an account? <a href="login.php">Login Now</a></p>
        </form>
    </div> 
</body>
</html>