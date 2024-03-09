<?php
$add = false;
$showerror = false;
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
            $showerror = "Book ID is same";
        } else {
            $sql = "INSERT INTO books (bookid, Title, Author) VALUES ('$bookid', '$Title', '$Author')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $add = true;
            } else {
                $showerror = "Add Book ID" ;
            }
        }
    } elseif (isset($_POST['search'])) {
        $searchKeyword = isset($_GET['searchKeyword']) ? $_GET['searchKeyword'] : '';

        $searchSql = "SELECT * FROM books WHERE Title LIKE '%$searchKeyword%' OR Author LIKE '%$searchKeyword%'";
        $searchResult = mysqli_query($conn, $searchSql);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
</head>
<body>
<?php require 'partials/_nav.php' ?>
<?php
if($add){
    echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Book Added Successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    ';
}
if($showerror){
    echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Book not added</strong> '.$showerror.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
    ';
}
?>
<div class="container my-20">
    <h1 class="text-center">Welcome to Librix</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label for="Title">Title</label>
            <input type="text" class="form-control" id="Title" name="Title">
        </div>
        <div class="form-group">
            <label for="Author">Author Name</label>
            <input type="text" class="form-control" id="Author" name="Author">
        </div>
        <div class="form-group">
            <label for="ID">Book ID</label>
            <input type="number" class="form-control" id="ID" name="Bookid">
        </div>
        <button type="submit" class="btn btn-primary" name="add">Add Book</button>
        <button type="submit" class="btn btn-primary" name="search">Search Book</button>
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
                    <td>'.$row['Bookid'].'</td>
                    <td>'.$row['Title'].'</td>
                    <td>'.$row['Author'].'</td>
                </tr>';
        }
        echo '</tbody></table>';
    }
    ?>
</div>
</body>
</html>