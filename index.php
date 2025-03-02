<?php
$add = false;
$showerror = false;
$searchError = false;
include 'partials/bookdb.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['add'])) {
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
    } elseif (isset($_POST['search'])) {
        $searchKeyword = mysqli_real_escape_string($conn, $_POST['searchKeyword']);
        $searchSql = "SELECT * FROM books WHERE Title LIKE '%$searchKeyword%' OR Author LIKE '%$searchKeyword%'";
        $searchResult = mysqli_query($conn, $searchSql);
        if (mysqli_num_rows($searchResult) == 0) {
            $searchError = "No books found matching your search criteria.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Librix</title>

    <!-- Bootstrap CSS -->
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
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
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
if($searchError){
    echo' <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> '.$searchError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
<div class="container my-5">
    <h1 class="text-center">Welcome to Librix</h1>
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

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="mt-4">
        <div class="mb-3">
            <label for="searchKeyword" class="form-label">Search Books</label>
            <input type="text" class="form-control" id="searchKeyword" name="searchKeyword" placeholder="Enter book title or author">
        </div>
        <button type="submit" class="btn btn-secondary" name="search">Search</button>
    </form>

    <?php
    if (isset($_POST['search']) && $searchResult && mysqli_num_rows($searchResult) > 0) {
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
        while ($row = mysqli_fetch_assoc($searchResult)) {
            echo '<tr>
                    <td>'.$row['bookid'].'</td>
                    <td>'.$row['Title'].'</td>
                    <td>'.$row['Author'].'</td>
                </tr>';
        }
        echo '</tbody></table>';
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>