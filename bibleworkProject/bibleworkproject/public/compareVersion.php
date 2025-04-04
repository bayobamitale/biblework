<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Compare Versions </h1>

  <?php 
  
  $book = $_POST["book"];
  $chapter = $_POST["chapter"];
  $verse = $_POST["verse"];
  $bibleVersion1 = $_POST["version1"];
  $bibleVersion2 = $_POST["version2"];

  // echo "<br /> <hr />";
  // echo $chapter;
  // echo $book;

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

if ($bibleVersion1 == "kjv") $version1 = "t_kjv";
else if ($bibleVersion1 == "asv" ) $version1 = "t_asv";
else if ($bibleVersion1 == "ylt") $version1 = "t_ylt";
else if ($bibleVersion1 == "web") $version1 = "t_web";
else if ($bibleVersion1 == "bbe") $version1 = "t_bbe";
else $version1 = "t_kjv";
if ($bibleVersion2 == "kjv") $version2 = "t_kjv";
else if ($bibleVersion2 == "asv" ) $version2 = "t_asv";
else if ($bibleVersion2 == "ylt") $version2 = "t_ylt";
else if ($bibleVersion2 == "web") $version2 = "t_web";
else if ($bibleVersion2 == "bbe") $version2 = "t_bbe";
else $version2 = "t_kjv";

$sqlVersion1 = "SELECT * FROM `".$version1."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `title_short` LIKE '%$book%' AND `c` =$chapter AND `v` = $verse ";
$sqlVersion2 = "SELECT * FROM `".$version2."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `title_short` LIKE '%$book%' AND `c` =$chapter AND `v` = $verse ";

$titleSql = "SELECT `title_short` FROM `".$version1."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `title_short` LIKE '%$book%' AND `c` =$chapter AND `v` = $verse ";

$result1 = $conn->query($sqlVersion1);
$result2 = $conn->query($sqlVersion2);
$titleResult = $conn->query($titleSql);
//echo $sql; 
$firstTitle = mysqli_fetch_array($titleResult)["title_short"];

if ( isset($result1->num_rows) && $result1->num_rows >0) {
echo "<h1> " .  $firstTitle . " Chapter ". $chapter. " Verse ".$verse. " (".$bibleVersion1 .")</h1><br /> <hr />";
  // output data of each row
  while($row = mysqli_fetch_array($result1)) {
     // echo $row["title_short"]." ". $row["c"]." : ". $row["v"]. " Reads > ". $row["t"]."<br> <hr/>";
        echo  $row["v"]. ".  ". $row["t"]."<br> <hr/>";
  }
} else {
  echo "No Texts found";
}
if ( isset($result2->num_rows) && $result2->num_rows >0) {
echo "<h1> " .  $firstTitle . " Chapter ". $chapter. " Verse ".$verse. " (".$bibleVersion2 .")</h1><br /> <hr />";
  // output data of each row
  while($row2 = mysqli_fetch_array($result2)) {
     // echo $row2["title_short"]." ". $row2["c"]." : ". $row2["v"]. " Reads > ". $row2["t"]."<br> <hr/>";
        echo  $row2["v"]. ".  ". $row2["t"]."<br> <hr/>";
  }
} else {
  echo "No Texts found";
}

$conn->close();
   
?>

</body>
</html>