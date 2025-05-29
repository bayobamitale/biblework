<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Bible Search</h1>

  <?php 
  
  $searchText = $_POST["words"];
  $bibleVersion = $_POST["version"];

  //echo "<br /> <hr />";

  //echo "Term :" . $searchText;
  //echo "Version: ".  $bibleVersion;

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
//   echo "Connected successfully";

if ($searchText === ""){
    die("Search Text is required: " );
}

$kjv = "t_kjv";
$asv = "t_asv";
$web = "t_web";
$ylt = "t_ylt";
$bbe = "t_bbe";

if ($bibleVersion == "kjv") $version = "t_kjv";
else if ($bibleVersion == "asv" ) $version = "t_asv";
else if ($bibleVersion == "ylt") $version = "t_ylt";
else if ($bibleVersion == "web") $version = "t_web";
else if ($bibleVersion == "bbe") $version = "t_bbe";
else $version = "t_kjv";

$sql = "SELECT * FROM `".$version."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `t` LIKE '%$searchText%' ";

$result = $conn->query($sql);
//echo $sql; 
//echo $result;
echo "<h1> Keyword: " . $searchText ." (". $bibleVersion. ")</h1><br /> <hr />";

if ( isset($result->num_rows) && $result->num_rows >0) {
  // output data of each row
  while($row = mysqli_fetch_array($result)) {
     echo $row["title_short"]." ". $row["c"]." : ". $row["v"]. " Reads > ". $row["t"]."<br> <hr/>";
  }
} else {
  echo "No Texts found";
}


$conn->close();
   
?>

</body>
</html>