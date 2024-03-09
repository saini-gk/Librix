<?php
$showalert = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $Email = $_POST["Email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"]; 
    // $exists = false;
    $existsSql = "SELECT * FROM `new user` where Email = '$Email'";
    $result = mysqli_query($conn, $existsSql);
    $numExistsRows = mysqli_num_rows($result);
    if($numExistsRows > 0){
     //  $exists= true;
     $showerror =" Email is already exists";

  }
  else{
    // $exists= false;
    if(($password == $confirmpassword) ){
            $sql = "INSERT INTO `new user` ( `FName`, `LName`, `Email`, `Password`, `Date`) VALUES ('$FName', '$LName', '$Email', '$password', CURRENT_TIMESTAMP)";
            $result = mysqli_query($conn, $sql);
        if($result){
            $showalert = true; 
        }
    else{
      $showerror ="Password doesnot match ";
    }
    }
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

    <title>Sign Up</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
        <?php
        if($showalert){
        echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registration Successful!</strong> You have created a new account. You can now <a href = "login.php">login</a> to your account.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            ';
        }
        if($showerror){
          echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
             '.$showerror.' 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
              ';
          }
            ?>  
    <div class="container">
        <h1 class="text-center">New User Register Here</h1>
        <form action="signup.php" method="post" >
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
    <input type="email" class="form-control" id="Email" name="Email" placeholder="gunjn@gunjan.com"aria-describedby="emailHelp">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    
  </div>
  <div class="form-group">
    <label for="confirmpassword">Confirm Password</label>
    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
    
    <small id="emailHelp" class="form-text text-muted">Both password must be Same</small>
  </div>
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>

    </div>

    
  </body>
</html>