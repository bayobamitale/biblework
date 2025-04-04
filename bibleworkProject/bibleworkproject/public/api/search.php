<?php 
  require "1httpheader.php";

  $request_body = file_get_contents('php://input');
  $data = json_decode($request_body);
  //var_dump($data->term);

   if (isset($data->term)){ 
          $term = $data->term ;
    }
    if (isset($data->version)){ 
           $bibleVersion = $data->version;
    }
 
require "1dbheader.php";

if ($term === ""){
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

$sql = "SELECT `title_short`, `c`, `v`, `t`  FROM `".$version."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `t` LIKE '%$term%' ";
//echo $sql; 
$result = $conn->query($sql);

$myArray = array();
if ( isset($result->num_rows) && $result->num_rows >0) {

  while($row = mysqli_fetch_array($result)) {
    // $myArray = $row;     //echo $row["title_short"]." ". $row["c"]." : ". $row["v"]. " Reads > ". $row["t"]."<br> <hr/>";
     array_push($myArray, $row);
  }
    
} else {
   // "{'result': 'No Texts found'}";
     $myArray = null;
}

echo json_encode($myArray);

$conn->close();
   
?>