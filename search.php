<?php
$servername = "localhost";
$username = "root";
$password = "Gunjan@123";
$dbname = "LMS";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchError = false;
$searchResult = null;

if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $sql = "SELECT * FROM books WHERE title LIKE '%$searchTerm%' OR author LIKE '%$searchTerm%'";
    $searchResult = $conn->query($sql);

    if ($searchResult->num_rows == 0) {
        $searchError = "No books found matching your search criteria.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Search Books</title>

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
        .alert-warning {
            background-color: #f1faee;
            color: #e63946;
        }
    </style>
</head>
<body>
<?php require 'partials/_nav.php' ?>

<div class="container my-5">
    <h1 class="text-center">Search Books</h1>
    <form method="post" action="">
        <div class="mb-3">
            <input type="text" class="form-control" name="searchTerm" placeholder="Enter book title or author">
        </div>
        <button type="submit" class="btn btn-primary" name="search">Search</button>
    </form>

    <?php
    if ($searchError) {
        echo' <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                <strong>Warning!</strong> '.$searchError.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }

    if ($searchResult && $searchResult->num_rows > 0) {
        echo '<h2 class="my-4">Search Results</h2>';
        echo '<table class="table">
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = $searchResult->fetch_assoc()) {
            echo '<tr>
                    <td>'.$row['bookid'].'</td>
                    <td>'.$row['title'].'</td>
                    <td>'.$row['author'].'</td>
                </tr>';
        }
        echo '</tbody></table>';
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>