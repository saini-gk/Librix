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
    <title>Welcome <?php echo $_SESSION['FName']; ?></title>
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
    </style>
</head>
<body>
<?php require 'partials/_nav.php' ?>
<div class="container my-5">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Hi! <?php echo $_SESSION['FName']; ?></h4>
        <p>Welcome to Librix. Here you can manage your account, browse available books, and more.</p>
        <hr>
        <p class="mb-0">You can <a href="logout.php" class="alert-link">Log Out</a> using this link.</p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">View Profile</h5>
                    <p class="card-text">View and edit your profile information.</p>
                    <a href="profile.php" class="btn btn-primary">Go to Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Browse Books</h5>
                    <p class="card-text">Browse the available books in the library.</p>
                    <a href="browse.php" class="btn btn-primary">Browse Books</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Add New Book</h5>
                    <p class="card-text">Add a new book to the library collection.</p>
                    <a href="addbook.php" class="btn btn-primary">Add Book</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>