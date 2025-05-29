<?php 
  require "1httpheader.php";

  $request_body = file_get_contents('php://input');
  $data = json_decode($request_body);
  $book = "";
  $bibleVersion = "kjv";
  $chapter = 1;
  
  //echo $data;
   if ( $_SERVER['REQUEST_METHOD'] == "POST"){
   
       if (isset($data->book)){ 
          $book = $data->book ;
       }
   
       if (isset($data->version)){ 
           $bibleVersion = $data->version;
       }

        if (isset($data->chapter)){ 
           $chapter = $data->chapter;
        }
  }

require "1dbheader.php";

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

//$myArray = array()
$result = $conn->query($sql);

if ( isset($result->num_rows) && $result->num_rows >0) {

  while($row = mysqli_fetch_array($result)) {
        $myArray[] = $row;   // $row["v"]. ".  ". $row["t"]."<br> <hr/>";
  }
} else {
  // echo "No Texts found";
    $myArray = null;
}

echo json_encode($myArray);

$conn->close();
   
?>

