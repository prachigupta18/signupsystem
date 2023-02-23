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

<div class="container ">

  <form class="search-post my-3" action="partials/search.php" method ="GET">
    <div class="input-group">
      <input style=" border-radius: 20px; margin-bottom: 10px; box-shadow: 0px 0px 2px 2px rgb(158 158 158 / 40%), 0px 2px 8px rgb(234 235 229);" type="text" name="search" class="form-control" placeholder="Search students .....">
      <span class="input-group-btn pl-2">
        <button  type="submit" class="btn mx-1">Search <i class="icon-search"></</button>
      </span>
    </div>
  </form>





  <?php
    include 'db.php';
    //define total number of results you want per page  
        $results_per_page = 2; 

        $sql = "SELECT * FROM tour";
        $result_total = mysqli_query($conn, $sql);
        $number_of_result = mysqli_num_rows($result_total);

        //determine the total number of pages available  
        $number_of_page = ceil($number_of_result / $results_per_page);

        if (!isset($_GET['page']) ) {  
            $page_no = 1;  
        } else {  
            $page_no = $_GET['page'];  
        } 

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page_no-1) * $results_per_page; 

        //retrieve the selected results from database   
        $query = "SELECT * FROM tour ORDER BY sno DESC LIMIT " . $page_first_result . ',' . $results_per_page;  
        $result = mysqli_query($conn, $query); 
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
  <div class="b-pagination-outer">
        <ul id="border-pagination">
            <?php
            //display the link of the pages in URL  
            for($page = 1; $page<= $number_of_page; $page++) {  
                if ($page == $page_no) {
                  $active = "active";
                }else{
                 $active = "";
                }
                echo '<li><a class="'.$active.'" href="../signupsystem/index.php?page=' . $page . '">' . $page . ' </a></li>';  
            } 
            ?>
        </ul>
    </div>
</div>

