<?php
$login = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $Email = $_POST["Email"];
    $password = $_POST["password"];
    

      $sql = "Select * from `new user` where FName='$FName' AND LName='$LName' AND Email='$Email' AND password='$password'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
  if($num == 1){
      $login = true; 
      session_start();
      $_SESSION['login'] = true;
      $_SESSION['FName'] = $FName;
      $_SESSION['LName'] = $LName;
      header("location: welcome.php");
        }
    else{
      $showerror =" ";
    }
    }

  
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
  
    <?php require 'partials/_nav.php' ?>
        <?php
        if($login){
        echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Login Successful!</strong> You are logged in.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            ';
        }
        if($showerror){
          echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Password mismatch</strong> '.$showerror.' 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
              ';
          }
            ?>  
    <div class="container my-20 ">
        <h1 class="text-center">Login to your account</h1>
        <form action="login.php" method="post" >
  <div class="form-group">
    <label for="FName">First Name</label>
    <input type="text" class="form-control" id="FName" name="FName">
  </div>

  <div class="form-group">
    <label for="LName">Last Name</label>
    <input type="text" class="form-control" id="LName" name="LName">
  </div>

  <div class="form-group">
    <label for="Email">Email address</label>
    <input type="email" class="form-control" id="Email" name="Email" placeholder="gunjan@gunjan.com" aria-describedby="emailHelp">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>

    </div>

    
</body>
</html>