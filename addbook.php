<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("location: login.php");
    exit;
}

$add = false;
$showerror = false;
include 'partials/bookdb.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $bookid = mysqli_real_escape_string($conn, $_POST["Bookid"]);
    $Title = mysqli_real_escape_string($conn, $_POST["Title"]);
    $Author = mysqli_real_escape_string($conn, $_POST["Author"]);

    $existsSql = "SELECT * FROM books WHERE bookid = '$bookid'";
    $result = mysqli_query($conn, $existsSql);
    $numExistsRows = mysqli_num_rows($result);

    if($numExistsRows > 0){
        $showerror = "Book ID already exists";
    } else {
        $sql = "INSERT INTO books (bookid, Title, Author) VALUES ('$bookid', '$Title', '$Author')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $add = true;
        } else {
            $showerror = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Book</title>

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
if($add){
    echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Book has been added successfully.
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
    <h1 class="text-center">Add a New Book</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input type="text" class="form-control" id="Title" name="Title">
        </div>
        <div class="mb-3">
            <label for="Author" class="form-label">Author Name</label>
            <input type="text" class="form-control" id="Author" name="Author">
        </div>
        <div class="mb-3">
            <label for="ID" class="form-label">Book ID</label>
            <input type="number" class="form-control" id="ID" name="Bookid">
        </div>
        <button type="submit" class="btn btn-primary" name="add">Add Book</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>