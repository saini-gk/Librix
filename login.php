<?php
$login = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $Email = $_POST["Email"];
    $password = $_POST["password"];
    
    $sql = "SELECT * FROM `new user` WHERE FName='$FName' AND LName='$LName' AND Email='$Email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        $login = true; 
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        $_SESSION['FName'] = $row['FName'];
        $_SESSION['LName'] = $row['LName'];
        $_SESSION['Email'] = $row['Email'];
        header("location: welcome.php");
    } else {
        $showerror = "Invalid credentials";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f8ff;
        }
        .navbar {
            background-color: #e3f2fd;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
    <title>Login</title>
</head>
<body>
<?php require 'partials/_nav.php' ?>
<?php
if($login){
    echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Login Successful!</strong> You are logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
if($showerror){
    echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong> '.$showerror.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
<div class="container my-5">
    <h1 class="text-center">Login to your account</h1>
    <form action="login.php" method="post">
        <div class="mb-3">
            <label for="FName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="FName" name="FName">
        </div>
        <div class="mb-3">
            <label for="LName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="LName" name="LName">
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>