<?php 
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <title>Welcome - <?php echo $_SESSION['username']; ?></title>
 </head>
    <body>
       <?php require "partials/navbar.php"; ?>


	   <div class="container my-3">
	        <div class="alert alert-success" role="alert">
	          <h4 class="alert-heading">Welcome - <?php echo $_SESSION['username']; ?></h4>
	          <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
	          <hr>
	        </div>
	    </div>

	    <style>
		    .table {
		        border: 50px solid black;
		        background-color: white;
		    }

		    .tp {
		        background-color: #5e6f77;
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
		    label {
    			display: inline-block;
    			margin-bottom: 0.5rem;
    			color: #767474;
			}
			.dataTables_wrapper .dataTables_length select {
    			border: 1px solid #aaa;
    			border-radius: 25px;
    			background-color: transparent;
    			padding: 4px 7px;
    			box-shadow: 0px 0px 2px 2px rgb(158 158 158 / 40%), 0px 2px 8px rgb(234 235 229);
			}


		    html, 
		    body {
		      font: 100%/1.5 Verdana, sans-serif
		    }

		    #myTable tr{
		        vertical-align: middle;
		    }

		    #myTable tr td img{
		        border-radius: 50%;
		    }
		    .dataTables_wrapper .dataTables_filter input {
			    border: 1px solid #aaa;
			    border-radius: 25px;
			    padding: 5px;
			    background-color: transparent;
			    margin-left: 3px;
			    box-shadow: 0px 0px 2px 2px rgb(158 158 158 / 40%), 0px 2px 8px rgb(234 235 229);
			    outline: none;
			}
			.dataTables_wrapper .dataTables_filter input:hover{
				border-radius: 25px;
				outline: none;
			}

			.btn-sm {
    			padding: 4px 8px;
    			font-size: 16px;
    			line-height: 1.5;
    			border-radius: 20px;
			}
			

		</style>


	<div class="container ">

	      <?php
	        include 'partials/db.php';

	        $sql = "SELECT * FROM tour";
	        $result = mysqli_query($conn, $sql);
	        $number_of_result = mysqli_num_rows($result);

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
	        echo "<thead>";
	        echo "<tbody class = 'table-group-divider'>";
	         

	        if ($number_of_result > 0) {
	            while ($row = mysqli_fetch_assoc($result)) {
	                echo "<tr>";

	                echo "<td>" . $row["sno"] . "<br>";
	                echo "<td><img src='partials/photos/".$row['pfimage']."' width='100' height='100'  /></td>";
	                echo "<td>" . $row["firstname"] . " " .$row["lastname"]. "<br>";
	                echo "<td>" . $row["email"] . "<br>";
	                echo "<td>" . $row["gender"] . "<br>";
	                echo "<td>" . $row["mobilenumber"] . "<br>";
	                echo "<td>" . $row["address"] . "<br>";
	                echo "<td>" . $row["city"] . "<br>";
	                echo "<td class='action-btn'>
	                        <a href='partials/update.php?sno=".$row['sno']."' class='btn btn-success btn-sm'><i class='bi bi-pencil'></i></a>
	                        <a href='partials/delete.php?sno=".$row['sno']."' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i></a>
	                    </td>";
	                echo "</tr>";
	            }
	        }
	                echo "</tbody>";
	        ?>
	      </table>   
	</div>


	    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
	    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

	    <script>
	      $(document).ready( function () {
	          $('#myTable').DataTable();
	      } );
	    </script>
    </body>
</html>


