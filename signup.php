<?php
  $showAlert = false;
  $showError = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "partials/db.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $existSql = "SELECT * FROM form1 WHERE uname = '$username'";
    $existResult = mysqli_query($conn , $existSql);
    $existNum = mysqli_num_rows($existResult);

    if ($existNum > 0) {
      $showError = "Username is Already Exists. ";
      } else{

        if($password == $cpassword){
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO form1 (`uname`,`passwrd`,`dt`) VALUES('$username','$hash',current_timestamp())";
          $result = mysqli_query($conn, $sql);

          if($result){
            $showAlert = true;
          }
        }else{
          $showError = "Password did not Same";
      }
    }
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

    <title>SignUp</title>
    <style>
    .navbar{
      margin-bottom: 59px;
       margin-top: -20px;
    }

    .search-btn{
      background: #343a40;
      border-radius: 5px;
    }
    .search-btn .btn-outline-success:hover {
      color: #fff;        
      background-color: #28a745;
      border-color: #28a745;
    }
       
  
    body {
    /*background-image: url(http://kreativo.se/backlogin.jpg);*/
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#8be8cf), color-stop(100%,#cdeb8b));
      font-family: "Helvetica Neue", Helvetica, Arial;
      padding-top: 20px;
    }

    .container {
      width: 406px;
      max-width: 406px;
      margin: 0 auto;
    }

    #signup {
      padding: 0px 25px 25px;
      background: #fff;
      box-shadow: 
          0px 0px 0px 5px rgba( 255,255,255,0.4 ), 
          0px 4px 20px rgba( 0,0,0,0.33 );
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      border-radius: 5px;
      display: table;
      position: static;
    }

    #signup .header {
      margin-bottom: 20px;
    }

    #signup .header h3 {
      color: #333333;
      text-align: center;
      font-size: 30px;
      padding-top: 13px;
      font-weight: bold;
      margin-bottom: 5px;
      text-shadow: 0px 1px 3px rgba(000,000,000,0.3),
        0px 0px 0px rgba(255,255,255,0); 
    }

    #signup .header p {
      color: #8f8f8f;
      font-size: 16px;
      font-weight: 300;
    }

    #signup .sep {
      height: 1px;
      background: #e8e8e8;
      width: 406px;
      margin: 0px -25px;
    }

    #signup .inputs {
      margin-top: 25px;
    }

    #signup .inputs label {
      color: #8f8f8f;
      font-size: 12px;
      font-weight: 300;
      letter-spacing: 1px;
      margin-bottom: 7px;
      display: block;
    }

    input::-webkit-input-placeholder {
      color:    #b5b5b5;
    }

    input:-moz-placeholder {
      color:    #b5b5b5;
    }

    #signup .inputs input[type=text], input[type=password] {
      background: #f5f5f5;
      font-size: 0.8rem;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      border-radius: 3px;
      border: none;
      padding: 13px 10px;
      width: 330px;
      margin-bottom: 20px;
      box-shadow: inset 0px 2px 3px rgba( 0,0,0,0.1 );
      clear: both;
    }

    #signup .inputs input[type=text]:focus, input[type=password]:focus {
      background: #fff;
      box-shadow: 0px 0px 0px 3px #fff38e, inset 0px 2px 3px rgba( 0,0,0,0.2 ), 0px 5px 5px rgba( 0,0,0,0.15 );
      outline: none;   
    }

    #signup .inputs .checkboxy {
      display: block;
      position: static;
      height: 25px;
      margin-top: 10px;
      clear: both;
    }

    #signup .inputs input[type=checkbox] {
      float: left;
      margin-right: 10px;
      margin-top: 3px;
    }

    #signup .inputs label.terms {
      float: left;
      font-size: 14px;
      font-style: italic;
    }

    #signup .inputs #submit {
      width: 100%;
      margin-top: 20px;
      padding: 15px 0;
      color: #fff;
      font-size: 14px;
      font-weight: 500;
      letter-spacing: 1px;
      text-align: center;
      text-decoration: none;
      background: -moz-linear-gradient(top,#b9c5dd 0%, #a4b0cb);
      background: -webkit-gradient(linear, left top, left bottom,from(#b9c5dd),
        to(#a4b0cb));        
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      border-radius: 5px;
      border: 1px solid #737b8d;
      -moz-box-shadow: 0px 5px 5px rgba(000,000,000,0.1),
        inset 0px 1px 0px rgba(255,255,255,0.5);        
     -webkit-box-shadow:  0px 5px 5px rgba(000,000,000,0.1),
        inset 0px 1px 0px rgba(255,255,255,0.5);
      box-shadow: 0px 5px 5px rgba(000,000,000,0.1),
        inset 0px 1px 0px rgba(255,255,255,0.5);        
      text-shadow: 0px 1px 3px rgba(000,000,000,0.3),
        0px 0px 0px rgba(255,255,255,0);        
      display: table;
      position: static;
      clear: both;
    }

    #signup .inputs #submit:hover {
      background: -moz-linear-gradient(top, #a4b0cb 0%, #b9c5dd);        
      background: -webkit-gradient(linear, left top, left bottom,  from(#a4b0cb), to(#b9c5dd));        
    }
    </style>

  </head>
  <body>
     <?php require "partials/navbar.php"; ?>


    <?php if($showAlert) { echo
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account has been created and now you can login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    } ?>


    <?php if($showError) { echo
      '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! </strong>'. $showError .'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
    } ?>

     
    <div class="container">

      <form id="signup" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <div class="header">        
          <h3>Sign Up</h3>            
          <p>You want to fill out this form</p>            
        </div>
        
        <div class="sep"></div>

        <div class="inputs">
        
          <!-- <input type="email" placeholder="e-mail" autofocus /> -->
          <input type="text" name="username" placeholder="@Username" autofocus required>
          <input type="password" placeholder=" Password" name="password" required>
          <input type="password" placeholder="Confirm Password" name="cpassword" required>
            
          <div class="checkboxy">
            <input name="cecky" id="checky" value="1" type="checkbox" /><label class="terms">I accept the terms of use</label>
          </div>            
          <button id="submit" href="#">SIGN UP FOR INVITE NOW</button>        
        </div>
      </form>
    </div>
​
    


  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>	
</body>
</html>