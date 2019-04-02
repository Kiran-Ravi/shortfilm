<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
 $query = "
  SELECT * FROM shortfilm where (Duration >'0')";
 
 if(isset($_POST["genre"]))
 {
  $genre_filter = implode("','", $_POST["genre"]);
  $query .= "AND Genre IN('".$genre_filter."')";
 }
 if(isset($_POST["language"]))
 {
  $language_filter = implode("','", $_POST["language"]);
  $query .= "
   AND Language IN('".$language_filter."')
  ";
 }
 
 

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 $output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output .= '
    <div class="col-sm-0 col-g-2 col-md-4" >
    <div style="border:3px solid #ccc; border-radius:60px; padding:16px; margin-bottom:16px; height:auto;">
     <img src="image/'. $row['image'] .'" alt="" class="img-responsive" >
     <p align="center"><strong><a href="#">'. $row['Film_name'] .'</a></strong></p>
     <h4 style="text-align:center;" class="text-danger" >'. $row['Duration'] .'</h4>
     <p>Genre : '. $row['Genre'].'<br />
	 Duration : '. $row['Duration'] .'<br/>
    
     Language : '. $row['Language'] .'<br />
     Director name : '. $row['Director_name'] .'  </p>
    </div>

   </div>
   ';
  }
 }
 else
 {
  $output = '<h3>No Data Found</h3>';
 }
 echo $output;
}

?>
