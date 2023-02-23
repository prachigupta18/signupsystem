<?php
 include 'db.php';

 
 $sno = $_GET['sno'];

$sqlImageUnlink = "SELECT * FROM tour WHERE sno = {$sno};";
$result = mysqli_query($conn, $sqlImageUnlink) or die("Query Failed: SELECT");
$row = mysqli_fetch_assoc($result);

unlink("photos/".$row['pfimage']);

$sql = "DELETE FROM tour WHERE sno = {$sno}";

if (mysqli_query($conn, $sql)) {
	header("location: ../index.php");
}else{
	echo "Query Failed";
}

?>