<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Profile</title>
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
    </style>
</head>
<body>
<?php require 'partials/_nav.php' ?>
<div class="container my-5">
    <h1 class="text-center">Your Profile</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: <?php echo isset($_SESSION['FName']) ? $_SESSION['FName'] : ''; ?> <?php echo isset($_SESSION['LName']) ? $_SESSION['LName'] : ''; ?></h5>
            <p class="card-text">Email: <?php echo isset($_SESSION['Email']) ? $_SESSION['Email'] : ''; ?></p>
            <a href="editprofile.php" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>