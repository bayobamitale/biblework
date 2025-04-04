<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Bible List</h1>

  <?php 

  $servername = "localhost";
  $username = "Bayo";
  $password = "Ade1234";
  $dbname = "bible";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `book_info`";
       
$result = $conn->query($sql);

// echo $sql; 

echo "<h1> Book List </h1><br /> <hr />";

if ( isset($result->num_rows) && $result->num_rows >0) {
  // output data of each row
  while($row = mysqli_fetch_array($result)) {
     echo $row["order"]. ". ". $row["title_short"]. " <br/>";
  }
} else {
  echo "No Texts found";
}


//header("Content-Type: application/json");
// echo json_encode($result);
//exit();

$conn->close();
   
?>

</body>
</html>