<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("location: login.php");
    exit;
}

$update = false;
$showerror = false;
include 'partials/_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $FName = mysqli_real_escape_string($conn, $_POST["FName"]);
    $LName = mysqli_real_escape_string($conn, $_POST["LName"]);
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "UPDATE `new user` SET FName='$FName', LName='$LName', Email='$Email', password='$password' WHERE Email='".$_SESSION['Email']."'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['FName'] = $FName;
        $_SESSION['LName'] = $LName;
        $_SESSION['Email'] = $Email;
        $update = true;
    } else {
        $showerror = "Error: " . mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Profile</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f1faee;
            color: #1d3557;
        }
        .btn-primary {
            background-color: #457b9d;
            border-color: #457b9d;
        }
        .btn-secondary {
            background-color: #a8dadc;
            border-color: #a8dadc;
        }
        .alert-success {
            background-color: #a8dadc;
            color: #1d3557;
        }
        .alert-danger {
            background-color: #e63946;
            color: #f1faee;
        }
    </style>
</head>
<body>
<?php require 'partials/_nav.php' ?>
<?php
if($update){
    echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Profile has been updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
if($showerror){
    echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '.$showerror.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
<div class="container my-5">
    <h1 class="text-center">Edit Profile</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="mb-3">
            <label for="FName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="FName" name="FName" value="<?php echo $_SESSION['FName']; ?>">
        </div>
        <div class="mb-3">
            <label for="LName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="LName" name="LName" value="<?php echo $_SESSION['LName']; ?>">
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $_SESSION['Email']; ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>