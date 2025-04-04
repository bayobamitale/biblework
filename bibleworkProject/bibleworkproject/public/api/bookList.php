<?php
require "1httpheader.php";
require "1dbheader.php";

//$sql = "SELECT `order`, `title_short` FROM `book_info`";
$sql = "SELECT * FROM `book_info`";
       
$result = $conn->query($sql);

$myArray = array();

if ( isset($result->num_rows) && $result->num_rows >0) {
  // output data of each row
  while($row = mysqli_fetch_array($result)) {
     //echo $row["order"]. ". ". $row["title_short"]. " <br/>";
      $myArray[] = $row;
  }
} else {
  //echo "No Texts found";
  $myArray = null;
}

echo json_encode($myArray);

//header("Content-Type: application/json");
// echo json_encode($result);
//exit();

$conn->close();
   
?>