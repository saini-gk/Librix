<?php
if(isset($_SESSION['login']) && $_SESSION['login'] == true){
  $login = true;
} else {
  $login = false;
}
?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="/Librix/index.php">Librix</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/Librix/index.php">Home</a>
      </li>
      <?php if(!$login): ?>
      <li class="nav-item">
        <a class="nav-link" href="/Librix/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/Librix/signup.php">SignUp</a>
      </li>
      <?php endif; ?>
      <?php if($login): ?>
      <li class="nav-item">
        <a class="nav-link" href="/Librix/logout.php">Log Out</a>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>