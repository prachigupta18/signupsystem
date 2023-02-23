<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header('location: login.php');
  exit;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>search.php</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <style>


    .search-btn{
      background: #343a40;
      border-radius: 5px;
    }
    .search-btn .btn-outline-success:hover {
      color: #fff;        
      background-color: #28a745;
      border-color: #28a745;
    }


    .table {
        border: 50px solid black;
        background-color: white;
    }

    .tp {
        background-color: #50788b;
        color: white;
        text-shadow: 1px 1px #dfb1b1;
    }
    .th{
        padding: 10px;
    }

    .bag-in {
        padding: 10px;
        margin-bottom: 20px;
        width: 100%;
        height: 50px;
    }

    html, 
    body {
      font: 100%/1.5 Verdana, sans-serif
      overflow-x: hidden;
    }


    /* border-pagination */
    .b-pagination-outer {
      width: 100%;
      margin: 0 auto;
      text-align: center;
      overflow: hidden;
      display: flex
    }
    #border-pagination {
      margin: 0 auto;
      padding: 0;
      text-align: center
    }
    #border-pagination li {
      display: inline;

    }
    #border-pagination li a {
      display: block;
      text-decoration: none;
      color: #000;
     /* padding: 5px 10px;*/
      border: 1px solid #ddd;
      float: left;
      border-radius: 50px;
      padding: 2px 9px;
      font-size: 17px;
      margin-right: 3px;

    }
    #border-pagination li a {
      -webkit-transition: background-color 0.4s;
      transition: background-color 0.4s
      /*border-radius: 50px;
      padding: 2px 9px;
      font-size: 15px;
      margin-right: 3px;*/
    }
    #border-pagination li a.active {
      background-color: #673ab7;
      color: #fff;
    }
    #border-pagination li a:hover:not(.active) {
      background: #ddd;
    }

    #myTable tr{
        vertical-align: middle;
    }

    #myTable tr td img{
        border-radius: 50%;
    }
   .btn{
      border-radius: 10px;
      background: #d58e75;
      border: none;
      outline: none;
      font-size: 17px;
      padding: 6px 16px;
      box-shadow: 0px 0px 2px 2px rgb(158 158 158 / 40%), 0px 4px 16px rgb(0 0 0 / 30%);
    }
    .btn:hover{
      color: #fff;
      background: #009688;
    }
    

</style>
</head>
<body>
	<?php include 'navbar.php'; ?>

	<div class="container my-4 text-center">
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Welcome - <?php echo $_SESSION['username']; ?></h4>
      <p>Welcome to SignUpSystem. </p>
      <hr>
      <p class="mb-0">You can do logout by using this link.... <a href="/php/SignUpSystem/logout.php">using this link</a></p>
    </div>
  </div>

<div class="container ">
    <form class="search-post my-3" action="search.php" method ="GET">
      <div class="input-group">
          <input style=" border-radius: 20px; margin-bottom: 10px; box-shadow: 0px 0px 2px 2px rgb(158 158 158 / 40%), 0px 2px 8px rgb(234 235 229);" type="text" name="search" class="form-control" placeholder="Search students .....">
          <span class="input-group-btn pl-2">
              <button type="submit" class="btn btn-primary mx-1">Search <i class="icon-search"></i></button>
          </span>
      </div>
    </form>

    <?php

      include 'db.php';
      if (isset($_GET['search'])) {
      	$search_t = mysqli_real_escape_string($conn , $_GET['search']);
      }

      $sql = "SELECT * FROM tour WHERE firstname LIKE '$search_t' OR lastname LIKE '$search_t' ORDER BY sno DESC";

      $result = mysqli_query($conn , $sql);
      $number_of_result = mysqli_num_rows($result);

      if ($number_of_result > 0) {
    ?>
    <table id="myTable" class="table border">
    	<?php
           echo "<thead class = 'tp'>";
	       echo "<tr>";
	       echo "<th>SNo</th>";
	       echo "<th>Image</th>";
	       echo "<th>Name</th>";
	       echo "<th>Email</th>";
	       echo "<th>Gender</th>";
	       echo "<th>Mobile Number</th>";
	       echo "<th>Address</th>";
	       echo "<th>City</th>";
	       echo "<th>Action</th>";
	       echo "</tr>";
	       echo "</thead>";
             
            while ($row = mysqli_fetch_assoc($result)) {
             	echo "<tobody class = 'table-group-divider'>";
                echo "<tr>";

                echo "<td>" . $row["sno"] . "<br>";
                echo "<td><img src='photos/".$row['pfimage']."' width='100' height='100'  /></td>";
                echo "<td>" . $row["firstname"] . " " .$row["lastname"]. "<br>";
                echo "<td>" . $row["email"] . "<br>";
                echo "<td>" . $row["gender"] . "<br>";
                echo "<td>" . $row["mobilenumber"] . "<br>";
                echo "<td>" . $row["address"] . "<br>";
                echo "<td>" . $row["city"] . "<br>";
                echo "<td class='action-btn'>
                        <a href='update.php?sno=".$row['sno']."' class='btn btn-success btn-sm' data-toggle='modal'><i class='bi bi-pencil'></i></a>
                        <a href='delete.php?sno=".$row['sno']."' class='btn btn-danger btn-sm' data-toggle='modal'><i class='bi bi-trash'></i></a>
                     </td>";
                echo "</tr>";
                echo "</tbody>";
                //$number++;
            } 
            ?>
    </table>
        <?php
            }else{
                  echo "<h2>No Result Found</h2>";
                } 
        ?> 

</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>