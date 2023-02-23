<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header('location: login.php');
  exit;
} 
?>
<?php 
$showalert = false;
$showerror = false;
$showAlert = false;

$firstnameerr = $lastnameerr = $emailerr = $gendererr  = $mobilenumbererr = $addresserr = $cityerr = "";
$firstname = $lastname =   $email =  $gender = $mobilenumber = $address = $city = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include 'db.php';

    $sno = $_GET['sno'];

    if (empty($_POST["firstname"])) {
      $firstnameerr = "*firstname is required";
    } else {
      $firstname = test_input($_POST["firstname"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
        $firstnameerr = "*Only letters and white spaces allowed";
      }
    }

    if (empty($_POST["lastname"])) {
      $lastnameerr = "*lastname is required";
    } else {
      $lastname = test_input($_POST["lastname"]);
      if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
        $lastnameerr = "*Only letters and white spaces allowed";
      }
    }

    if (empty($_POST["email"])) {
      $emailerr  = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailerr  = "*Invalid email format";
     }
    }

    if (empty($_POST["gender"])) {
   	 	$gendererr = "Gender is required";
    } else {
    	$gender = test_input($_POST["gender"]);
  	}

  	if (empty($_POST['mobilenumber'])) {
    	$mobilenumbererr = "Please Enter Contact Number";
  	} elseif (strlen($_POST['mobilenumber']) > 10) {
    	$mobilenumbererr = "*mobile Number sholud be of 10 digits";
  	} elseif (!preg_match("/^[6-9]\d{9}$/", $_POST['mobilenumber'])) {
    	$mobilenumbererr = "*Invalid Contact Number";
  	}else {
    	$mobilenumber = test_input($_POST["mobilenumber"]);
  	}

  	if (empty($_POST["address"])) {
    	$addresserr = "Address is required";
  	} else {
    $address = test_input($_POST["address"]);
  	}

  	if (empty($_POST["city"])) {
    	$cityerr = "City is required";
  	} else {
    $city = test_input($_POST["city"]);
  	}

  	if (empty($_FILES['F']['name'])) {
        $image_name = $_POST['old-F'];
      }else{
        $errors = array();

        $file_name = $_FILES['F']['name'];
        $file_size = $_FILES['F']['size'];
        $file_tmp = $_FILES['F']['tmp_name'];
        $file_type = $_FILES['F']['type'];
        $exp = explode('.',$file_name);
        $file_ext = end($exp);

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
          $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
        }

        if ($file_size > 2097152) {
          $errors[] = "File size must be 2mb or lower.";
        }
        $new_name = time(). "-".basename($file_name);
          $target = "photos/".$new_name;
          $image_name = $new_name;

        if (empty($errors) == true) {
          move_uploaded_file($file_tmp,$target);
        }else{
          print_r($errors);
          die();
        }
      }


  	if ($firstnameerr == "" && $lastnameerr == "" && $emailerr == "" && $gendererr == "" && $mobilenumbererr == "" && $addresserr == "" && $cityerr == "") {
    	$sql = "UPDATE tour SET pfimage='{$image_name}', firstname ='{$firstname}', lastname ='{$lastname}', email ='{$email}', gender ='{$gender}', mobilenumber ='{$mobilenumber}', address ='{$address}', city ='{$city}' WHERE sno = '{$sno}' ";
    	$result = mysqli_query($conn, $sql);
      	if ($result) {
        	$showalert = true;
       
        	header("location: ../index.php");
      	} else {
        	$showerror = "your form did not be submit";
        
      	}
    	} else {
     	 $showAlert = 'Please fill all the fields correctly.';
      
    	}
}

function test_input($data)
{
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>update.php</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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
  .error {
    color: #ff0000;
  }

  .bag-in {
    padding: 10px;
    margin-bottom: 20px;
    width: 100%;
    height: 50px;
  }

  section {
    background-color: gray;
  }

  .container.my-5 {
    background-color: #fff;
    border-top: 5px solid cyan;
  }

  .btn {
    margin-bottom: 20px;
  }

  body {
    background-color: gray;
  }
</style>
</head>
<body>
	<?php include 'navbar.php';?>
    <?php if ($showerror) {
  		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  		<strong>warning! </strong>' . $showerror . '
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>';
	  }
	?>

	<?php if ($showAlert) {
  		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  		<strong>warning! </strong>' . $showAlert . '
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>';
	  }
	?>

	<?php
      include 'db.php';

      $sno = $_GET['sno'];

      $sql = "SELECT * FROM tour WHERE sno = {$sno}";
      $result = mysqli_query($conn , $sql);
      if(mysqli_num_rows($result) > 0){
    	while($row = mysqli_fetch_assoc($result)) {
        	$row["sno"];
        	$row['pfimage'];
        	$row["firstname"];
        	$row["lastname"];
        	$row["email"];
        	$row["gender"];
        	$row["mobilenumber"];
        	$row["address"];
        	$row["city"];

	?><?php // echo $_SERVER['SERVER_NAME'];?>
	<form action="update.php?sno=<?php echo $sno; ?>" method="post" enctype="multipart/form-data">

        <input type="hidden" name="sno" value="<?php echo $row['sno']; ?>">

        <h1 class=" pg text-center my-3">Personal Information</h1>

      	<label for="firstname">First Name: </label> <span class="error"><?php echo $firstnameerr; ?></span><br>
      	<input class="bag-in" type="text" placeholder="Enter first name" value="<?php echo $row["firstname"]; ?>" name="firstname">

      	<label for="lastname">Last Name: </label> <span class="error"><?php echo $lastnameerr; ?></span><br>
      	<input class="bag-in" type="text" placeholder="Enetr last name" value="<?php echo $row["lastname"]; ?>" name="lastname">


      	<label for="email">E-mail: </label> <span class="error"><?php echo $emailerr; ?></span><br>
      	<input class="bag-in" type="text" placeholder="Enter Email" value="<?php echo $row["email"]; ?>" name="email">


      	<label>Gender:</label> <span class="error"><?php echo $gendererr; ?></span><br>
      	<ul>
        	<input type="radio" name="gender" <?php if($row["gender"] == "male") {?> checked="checked" <?php } ?> value="male"> Male
    	    	<input type="radio" name="gender" <?php if($row["gender"] == "female") {?> checked="checked" <?php } ?> value="female"> Female
        	<input type="radio" name="gender" <?php if($row["gender"] == "other") {?> checked="checked" <?php } ?> value="other"> Other
      	</ul>

      	<label for="F" class="control-label modal-label">Profile Image:</label>
      	<input type="file" name="F" id="F" class="form-control" />
      	<img src="photos/<?php echo $row['pfimage']; ?>" width="100" height="100">
      	<input type="hidden" name="old-F" value="<?php echo $row['pfimage']; ?>">

      	<h1 class="text-center my-4">Contact Information</h1>

      	<label for="contact">mobile Number: </label> <span class="error"><?php echo $mobilenumbererr; ?></span><br>
      	<input class="bag-in" type="text" maxlength="12" placeholder="Enter mobile Number" value="<?php echo $row["mobilenumber"]; ?>" name="mobilenumber">



     	 <label for="address">Address: </label><br> <span class="error"><?php echo $addresserr; ?></span>
      	<input class="bag-in" type="text" placeholder="Enter Address" value="<?php echo $row["address"]; ?>" name="address"><br>


      	<label for="city">City: </label><br> <span class="error"><?php echo $cityerr ?></span><br>
        <input class="bag-in" type="text" placeholder="Enter city" value="<?php echo $row["city"]; ?>" name="city">

      	<button type="submit" class="btn btn-primary">Update</button>
    </form>
    <?php  
     }
  }

?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>	