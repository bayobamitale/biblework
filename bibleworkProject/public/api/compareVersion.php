<?php 
require "1httpheader.php";

$book = "";
   $chapter = "";
   $fromVerse = "";
   $toVerse="";
   $firstVersion = "";
   $secondVersion = "";

  $request_body = file_get_contents('php://input');
  $data = json_decode($request_body);
  // var_dump($data->book);
  //var_dump($data);

   if ( $_SERVER['REQUEST_METHOD'] == "POST"){
   
       if (isset($data->book)){ 
          $book = $data->book ;
       }
       if (isset($data->chapter)){ 
          $chapter = $data->chapter;
       }
       if (isset($data->fromVerse)){ 
          $fromVerse = $data->fromVerse;
       }
       if (isset($data->toVerse)){ 
          $toVerse = $data->toVerse;
       }
       if (isset($data->firstVersion)){ 
           $firstVersion = $data->firstVersion;
       }
       if (isset($data->secondVersion)){ 
           $secondVersion = $data->secondVersion;
       }
     
  }

  if($book == "")  $book = "Gen";
  if( $chapter == "")  $chapter = 1;
  if($fromVerse == "")  $fromVerse = 1;
  if($toVerse == "")  $toVerse = 1;
 
require "1dbheader.php";

$kjv = "t_kjv";
$asv = "t_asv";
$web = "t_web";
$ylt = "t_ylt";
$bbe = "t_bbe";

if ($firstVersion == "kjv") $version1 = "t_kjv";
else if ($firstVersion == "asv" ) $version1 = "t_asv";
else if ($firstVersion == "ylt") $version1 = "t_ylt";
else if ($firstVersion == "web") $version1 = "t_web";
else if ($firstVersion == "bbe") $version1 = "t_bbe";
else $version1 = "t_kjv";
if ($secondVersion == "kjv") $version2 = "t_kjv";
else if ($secondVersion == "asv" ) $version2 = "t_asv";
else if ($secondVersion == "ylt") $version2 = "t_ylt";
else if ($secondVersion == "web") $version2 = "t_web";
else if ($secondVersion == "bbe") $version2 = "t_bbe";
else $version2 = "t_kjv";

$sqlVersion1 = "SELECT * FROM `".$version1."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `title_short` LIKE '%$book%' AND `c` = $chapter AND `v` >= $fromVerse AND `v` <= $toVerse";

$sqlVersion2 = "SELECT * FROM `".$version2."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `title_short` LIKE '%$book%' AND `c` = $chapter AND `v` >= $fromVerse AND `v` <= $toVerse";

$result1 = $conn->query($sqlVersion1);
$result2 = $conn->query($sqlVersion2);

$myArray = array();

if ( isset($result1->num_rows) && $result1->num_rows >0) {
  // output data of each row
  //array_push($myArray, "{part 1: " . $firstVersion . " }");
  while($row = mysqli_fetch_array($result1)) {
     // echo $row["title_short"]." ". $row["c"]." : ". $row["v"]. " Reads > ". $row["t"]."<br> <hr/>";
        //echo  $row["v"]. ".  ". $row["t"]."<br> <hr/>";
      array_push($myArray, $row);
  }
} else {
 "{'result': 'No Texts found'}";
}
if ( isset($result2->num_rows) && $result2->num_rows >0) {
    // array_push($myArray, "{part 2: ". $secondVersion). "}");
  // output data of each row
  while($row2 = mysqli_fetch_array($result2)) {
     // echo $row2["title_short"]." ". $row2["c"]." : ". $row2["v"]. " Reads > ". $row2["t"]."<br> <hr/>";
     //   echo  $row2["v"]. ".  ". $row2["t"]."<br> <hr/>";
     array_push($myArray, $row2);
  }
} else {
  //"{'result': 'No Texts found'}";
   $myArray = null;
}

echo json_encode($myArray);

$conn->close();
   
?>