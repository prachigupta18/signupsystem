<?php
$showalert = false;
$showerror = false;
$showAlert = false;
$showAlertImage = false;

$firstnameerr = $lastnameerr = $emailerr = $gendererr  = $mobilenumbererr = $addresserr = $cityerr = "";
$firstname = $lastname =   $email =  $gender = $mobilenumber = $address = $city = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/db.php';

  if (empty($_POST["firstname"])) {
    $firstnameerr = "Firstname is required";
  } else {
    $firstname = test_input($_POST["firstname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
      $firstnameerr = "*Only letters and white spaces allowed";
    }
  }

  if (empty($_POST["lastname"])) {
    $lastnameerr = "Lastname is required";
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

  if (isset($_FILES['F'])) {
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
    $target = "partials/photos/".$new_name;

    if (empty($errors) == true) {
      move_uploaded_file($file_tmp,$target);
    }else{
      //print_r($errors);
      $showAlertImage = $errors;
      //die();
    }
  }



  if ($firstnameerr == "" && $lastnameerr == "" && $emailerr == "" && $gendererr == "" && $mobilenumbererr == "" && $addresserr == "" && $cityerr == "") {
    $sql = "INSERT INTO `tour`(`pfimage`,`firstname`,`lastname`,`email`,`gender`,`mobilenumber`,`address`,`city`) VALUES('$new_name','$firstname','$lastname','$email','$gender','$mobilenumber','$address','$city')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $showalert = true;
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
<style>
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

  .btn-submit {
    margin-bottom: 20px;
  }

  body {
    background-color: gray;
  }
</style>
<?php if ($showalert) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success! </strong> your form submit
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>';
}
?>

<?php if ($showerror) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>warning! </strong>' . $showerror . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>';
}
?>

<?php if ($showAlert) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>warning! </strong>' . $showAlert . '
  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>';
}
?>

<?php if ($showAlertImage) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>warning! </strong>' ; 
  print_r($showAlertImage[0]); 
  echo '<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>';
}
?>


<div class="container my-5">

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <h1 class=" pg text-center my-3">Personal Information</h1>

    <label for="firstname">First Name: </label> <span class="error">* <?php echo $firstnameerr; ?></span><br>
    <input class="bag-in" type="text" placeholder="Enter first name" name="firstname">

    <label for="lastname">Last Name: </label> <span class="error">* <?php echo $lastnameerr; ?></span><br>
    <input class="bag-in" type="text" placeholder="Enter last name" name="lastname">


    <label for="email">E-mail: </label> <span class="error">* <?php echo $emailerr; ?></span><br>
    <input class="bag-in" type="text" placeholder="Enter Email" name="email">


    <label>Gender:</label> <span class="error">* <?php echo $gendererr; ?></span><br>
    <ul>
      <input type="radio" name="gender" value="male"> Male
      <input type="radio" name="gender" value="female"> Female
      <input type="radio" name="gender" value="other"> Other
    </ul>

    <label for="F" class="control-label modal-label">Profile Image:</label>
    <input type="file" name="F" id="F1" class="form-control"/>

    <h1 class="text-center my-4">Contact Information</h1>

    <label for="contact">Mobile Number: </label> <span class="error">* <?php echo $mobilenumbererr; ?></span><br>
    <input class="bag-in" type="text" maxlength="12" placeholder="Enter Contact Number" name="mobilenumber">



    <label for="address">Address: </label> <span class="error">* <?php echo $addresserr; ?></span>
    <input class="bag-in" type="text" placeholder="Enter Address" name="address"><br>


    <label for="city">City: </label> <span class="error">* <?php echo $cityerr ?></span><br>
    <input class="bag-in" type="text" placeholder="Enter city" name="city">


    <button type="submit" class="btn btn-submit btn-primary">Submit</button>
  </form>
</div>