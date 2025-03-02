<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("location: login.php");
    exit;
}

include 'partials/bookdb.php';

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Browse Books</title>
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
    <h1 class="text-center">Browse Books</h1>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table">
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>'.$row['bookid'].'</td>
                    <td>'.$row['Title'].'</td>
                    <td>'.$row['Author'].'</td>
                </tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No books available.</p>';
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>