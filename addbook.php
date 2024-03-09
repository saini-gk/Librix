<?php
$add = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/bookdb.php';
    $conn = mysqli_connect("localhost", "root", "Gunjan@123", "lms");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    $bookid = mysqli_real_escape_string($conn, $_POST["bookid"]);
    $Title = mysqli_real_escape_string($conn, $_POST["Title"]);
    $Author = mysqli_real_escape_string($conn, $_POST["Author"]);
    // $exists = false;
    $existsSql = "SELECT * FROM books WHERE bookid = '$bookid'";
    $result = mysqli_query($conn, $existsSql);
    if ($numExistsRows > 0) {
        $showerror = "Book ID already exists";
    }
    
    else{
    // $exists= false;
    $sql = "INSERT INTO books (bookid, Title, Author) VALUES ('$bookid', '$Title', '$Author')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $add = true;
        } else {
            $showerror = "Error: " . mysqli_error($conn);
        }
    }

}  
mysqli_close($conn);
?>