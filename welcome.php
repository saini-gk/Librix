<?php
  session_start();
  if(!isset($_SESSION['login']) || $_SESSION['login']!=true){
    header("location:login.php");
    exit;

  }
  
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Welcome <?php $_SESSION['FName']?></title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <div class="container my-5 " >
    <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Hi! <?php echo $_SESSION['FName'] ?></h4>
  <p>Welcome to Librix</p>
  <hr>
  <style>
    a:link {
        color: rgba(126, 45, 202, 0.733);
        background-color: transparent;
        text-decoration: line_through;
       }
       a:hover {
        color: red;
        background-color: transparent;
        text-decoration: underline;
      }
      a:visited {
      color: pink;
      background-color: transparent;
      text-decoration: none;
      }

  </style>
  <p class="mb-0">You can <a href="logout.php">LogOut</a> using this link</p>
</div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>