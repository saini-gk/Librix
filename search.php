<?php
// Set up database connection parameters
$servername = "localhost";
$username = "root";
$password = "Gunjan@123";
$dbname = "LMS";

// Create the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($conn->error) { die("Query failed: " . $conn->error); }

// If the search form is submitted
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];

    // Perform search query
    $sql = "SELECT * FROM books WHERE title LIKE '%$searchTerm%'";
    $res = $conn->query("SELECT * FROM books");

    $res = mysqli_query($conn, "SELECT * FROM books");
    // Display search results
    if ($res->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Title</th><th>Author</th></tr>";
        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['ID']."</td>";
            echo "<td>".$row['Title']."</td>";
            echo "<td>".$row['Author']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
}
?>

<!-- HTML Form to submit the book search -->
<form method="post" action="">
    <input type="text" name="searchTerm" placeholder="Enter book title">
    <input type="submit" name="search" value="Search">
</form>