<?php 

//index.php

include('database_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product filter in php</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
   
	<style>
	.header {
  padding: 80px;
  text-align: center;
  background: #1abc9c;
  color: white;
}
.navbar {
  overflow: hidden;
  background-color: #333;
}
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}


	</style>
</head>

<body>
<div class="header">
  <h1>SHORTFILM</h1>
  <p>.......Valley of Movies............</p>
</div>
<div class="navbar">
  <a href="#">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;HOME&emsp;&emsp;&emsp;</a>
  <a href="#">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;MOVIES&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</a>
  <a href="#">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ARTICLES&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</a>
  <a href="#" class="right">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;PLAYLISTS&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</a>
</div>

</div>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
         <br />
         <h2 align="center">Movies</h2>
         <br />
            <div class="col-md-3">                    
    <div class="list-group">
     
    
     <h3>Genre:</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
     <?php

                    $query = "SELECT DISTINCT(Genre) FROM shortfilm";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector genre" value="<?php echo $row['Genre']; ?>"  > <?php echo $row['Genre']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

    <div class="list-group">
     <h3>Language</h3>
                    <?php

                    $query = "SELECT DISTINCT(Language) FROM shortfilm ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector language" value="<?php echo $row['Language']; ?>" > <?php echo $row['Language']; ?></label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>
    
    
            </div>

            <div class="col-md-9">
             <br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
 text-align:center; 
 background: url('loader.gif') no-repeat center; 
 height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
      
        var genre = get_filter('genre');
        var language = get_filter('language');
        
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, genre:genre, language:language},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

     function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

  

});
</script>

</body>

</html>
