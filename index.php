<?php
  // if (!isset($_COOKIE['studentID'])) {
  //   header("Location: ./login/index.php");
  // }
/*
  $db_con['host'] = "10.30.49.96";
  $db_con['port'] = "5432";
  $db_con['user'] = "dophp";
  $db_con['password'] = "Nalkerstet!";
  $db_con['dbname'] = "stalkernet";
  $conn_string = "host=" . $db_con['host'] . " port=" . $db_con['port'] . " user=" . $db_con['user'] . " password=" . $db_con['password'] . " dbname=" . $db_con['dbname'];
  $db = pg_connect($conn_string);

  echo $conn_string; */

  // $cookie_studentID = $_COOKIE['studentID'];
?>
<?php 
	$basic_search_query = $_POST["basic_search_query"];
	$reg_search_query_string = "SELECT firstname, lastname, dorm, profile_pic_url FROM person WHERE '" . $basic_search_query . "' LIKE '%' || firstname || '%' OR '" . $basic_search_query . "' LIKE '%' || lastname || '%';"; //postgres command
	$reg_search_query = pg_query($db, $reg_search_query_string);
	$search_results = pg_fetch_all($reg_search_query); //runs postgres command on db




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
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">ABOUT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">ACADEMICS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">ADMISSIONS & AID</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">STUDENT LIFE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">GIVING</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">ATHLETICS</a>
          </li>
        </ul>
      </div>
    </nav>

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
    		if (bool empty($search_results)) {
    			echo "<p> No results were found. </p>";

    		} else {
    			foreach ($search_results as $key=>$value) {
    				echo "<li>";
    				echo "<img src=\"" . $value->profile_pic_url . "\">";
    				echo "<p>" . $value->firstname . " " . $value->lastname . "</p>";
    				echo "<p>" . $value->dorm . "</p>";
    				echo "</li>";
    			}
    		}
    	?>
    	</ul>
    </div>
  </body>
</html>
