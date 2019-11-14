<?php
  // if (!isset($_COOKIE['studentID'])) {
  //   header("Location: ./login/index.php");
  // }

  $db_con['host'] = "bminer-apps";
  $db_con['port'] = "5433";
  $db_con['user'] = "dophp";
  $db_con['password'] = "Nalkerstet!";
  $db_con['dbname'] = "dophp";
  $conn_string = "host=" . $db_con['host'] . " port=" . $db_con['port'] . " user=" . $db_con['user'] . " password=" . $db_con['password'] . " dbname=" . $db_con['dbname'];
  $db = pg_connect($conn_string);

  // echo $conn_string; 

  $cookie_studentID = $_COOKIE['studentID'];
?>
<?php 
	$basic_search_query = $_POST["basic_search_query"];
  $reg_search_query_string = "SELECT firstname, lastname, dorm, profile_pic_url FROM person;"; //postgres command
	//$reg_search_query_string = "SELECT firstname, lastname, dorm, profile_pic_url FROM person WHERE '" . $basic_search_query . "' LIKE '%' || firstname || '%' OR '" . $basic_search_query . "' LIKE '%' || lastname || '%';"; //postgres command
	$reg_search_query = pg_query($db, $reg_search_query_string);
	$search_results = pg_fetch_all_columns($reg_search_query); //runs postgres command on db

  var_dump($search_results);


 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Stalkernet</title>

    <script type="text/javascript" src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>

    <link rel="stylesheet" type="text/css" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
  </head>
    
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light westmont">
      <a class="navbar-brand" href="#">
        <img src="./images/westmont.png" height="30" alt="">
      </a>
      <div class="collapse navbar-collapse" id="navbarNav">
	<nav class="navbar navbar-expand-lg navbar-light bg-light westmont">
      </div>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="https://www.westmont.edu/about">ABOUT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.westmont.edu/academics">ACADEMICS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.westmont.edu/admissions-aid">ADMISSIONS & AID</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.westmont.edu/student-life">STUDENT LIFE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.westmont.edu/giving">GIVING</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://athletics.westmont.edu/index.aspx">ATHLETICS</a>
          </li>
        </ul>
      </div>
    </nav>
   <br>
   
	


   <div class="hero-image">
	 <div class="hero-text" align="center">
	    <h1>Welomce to Westmont Student Finder</h1>
	  </div>
   </div>
		

   <br>
    <div class="container">
      <div class="row" id="reg_search_cont">
        <div class="col-md-10">
          <form method="POST" action="./index.php">
            <div class="input-group mb-3">
              <input name="basic_search_query" type="text" class="form-control" placeholder="Search..." aria-label="Search for a student" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">GO</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row" id="adv_search_cont">
        <div class="col-md-10"></div>
      </div>
    </div>
    <div class="container">
    	<ul id="results">
    	<?php
    		if (empty($search_results)) {
    		 	echo "<p> No results were found. </p>";

    		 } else {
    		 	foreach ($search_results as $key=>$value) {
    		 		echo "<li>";
    		 		echo "<img src=\"" . $value->getProfilePicURL . "\">";
    		 		echo "<p>" . $value->getFirstname . " " . $value->getLastname . "</p>";
    		 		echo "<p>" . $value->getDorm . "</p>";
    		 		echo "</li>";
    		 	}
    		 }
    	?>
    	</ul>
    </div>
  </body>
</html>
