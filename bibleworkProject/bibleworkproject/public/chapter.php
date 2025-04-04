<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Bible Chapters</h1>

  <?php 
  $book = $_POST["book"];
  $chapter = $_POST["chapter"];
  // $verse = $_POST["verse"];
  $bibleVersion = $_POST["version"];

  echo "<br /> <hr />";
  //echo $chapter;
  //echo $book;

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

if ($book === ""){
    die("Book is required: " );
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

$sql = "SELECT * FROM `".$version."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `title_short` LIKE '%$book%' AND `c` =$chapter ";
$titleSql = "SELECT `title_short` FROM `".$version."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `title_short` LIKE '%$book%' AND `c` =$chapter ";

$result = $conn->query($sql);
$titleResult = $conn->query($titleSql);
//echo $sql; 
$firstTitle = mysqli_fetch_array($titleResult)["title_short"];

if ( isset($result->num_rows) && $result->num_rows >0) {
echo "<h1> " .  $firstTitle . " Chapter ". $chapter. " (".$bibleVersion .")</h1><br /> <hr />";
  // output data of each row
  while($row = mysqli_fetch_array($result)) {
     // echo $row["title_short"]." ". $row["c"]." : ". $row["v"]. " Reads > ". $row["t"]."<br> <hr/>";
        echo  $row["v"]. ".  ". $row["t"]."<br> <hr/>";
  }
} else {
  echo "No Texts found";
}


$conn->close();
   
?>

</body>
</html>