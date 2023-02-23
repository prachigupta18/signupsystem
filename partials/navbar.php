<?php


if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
   $loggedin = true;
} else{
  $loggedin = false;
}



?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/signupsystem/index.php">SignupSystem</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/signupsystem/index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <?php if(!$loggedin) { ?>
      <li class="nav-item">
        <a class="nav-link" href="/signupsystem/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/signupsystem/signup.php">Signup</a>
      </li>
      <?php } ?>
      
      <?php if($loggedin) { ?>
      <li class="nav-item">
        <a class="nav-link" href="/signupsystem/registration.php">Registration</a>
      </li>

       <li class="nav-item">
        <a class="nav-link" href="/signupsystem/datatable.php">Data Tables</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/signupsystem/logout.php">Logout</a>
      </li>
      <?php } ?>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="search-btn btn-outline-success   py-1 px-2 my-2 my-sm-0"type="submit">Search</button>
    </form>
  </div>
</nav>