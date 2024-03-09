<?php
if(isset($_SESSION['login']) && $_SESSION['login'] ==true){
  $login = true;
}
else{
  $login = false;
}
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/LMSV1">Librix</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>';

      if(!$login){
      echo '<li class="nav-item">
        <a class="nav-link" href="/LMSV1/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/LMSV1/signup.php">SignUp</a>
      </li>';
      }
      if($login){
      echo '<li class="nav-item">
        <a class="nav-link" href="/LMSV1/logout.php">Log Out</a>
      </li>';
      } 
    echo '</ul>
  
  </div>
</nav>';
?>