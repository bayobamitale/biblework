<?php 
  require "1httpheader.php";

   $book = "";
   $chapter = "";
   $fromVerse = "";
   $toVerse="";
   $bibleVersion = "";

  $request_body = file_get_contents('php://input');
  $data = json_decode($request_body);
  // var_dump($data->book);

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
       if (isset($data->version)){ 
           $bibleVersion = $data->version;
       }else{
           $bibleVersion = "kjv";
       }
  }

  if($book == "")  $book = "Gen";
  if( $chapter == "")  $chapter = 1;
  if($fromVerse == "")  $fromVerse = 1;
  if($toVerse == "")  $toVerse = 1;
  if($bibleVersion == "")  $bibleVersion = "kjv";
 
require "1dbheader.php";

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

$sql = "SELECT `title_short`, `c`, `v`, `t` FROM `".$version."` AS tk INNER JOIN `book_info` AS bk ON bk.order = tk.b WHERE `title_short` LIKE '%$book%' AND `c` = $chapter AND `v` >= $fromVerse AND `v` <= $toVerse";
//echo $sql;

$result = $conn->query($sql);
$myArray = array();

if ( isset($result->num_rows) && $result->num_rows >0) {

  while($row = mysqli_fetch_array($result)) {
      //$myArray[] = $row;
      array_push($myArray, $row);
  }
    
} else {
    //"{'result': 'No Texts found'}";
    $myArray = null;
}

echo json_encode($myArray);

$conn->close();
   
?>