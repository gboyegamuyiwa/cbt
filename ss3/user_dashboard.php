<?php
// set session
session_start();
require 'include/config.php';

if (!isset($_SESSION['username'])){
	header ('location: ../index.php');
} else {
// set session for sessioned data
$username = $_SESSION['username'];
$fullname = $_SESSION['fullname'];
$grade = $_SESSION['grade'];
}

// fetch out login date for sessioned user
$query = mysqli_query( $link, "SELECT * FROM students_tab WHERE username='".$username."'");
$setting = mysqli_fetch_assoc($query);
$last_log_date = $setting['last_log_date'];

$msg = "";
$results = "";
$counter = 1;
$quizpack = "";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Prodigy CBT | Simple CBT Solutions for Schools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <meta name="description" content="A Simple Computer-Based-Test (CBT) web application made using HTML, CSS (Bootstrap), JavaScript, PHP and MySQL">
    <meta name="keywords" content="CBT, Quiz, Online-Test, Computer-Based Exam, HTML,CSS,JavaScript,PHP, MySQL">
    <meta name="author" content="Adegboyega Olumuyiwa" />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <link rel="stylesheet" href="css/font.css">
    <!-- CSS File -->
    <link rel="stylesheet" href="css/custom.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  </head>

  <body>
    <section class="container-fluid">
      <div class="row">
        <div class="header">
          <div class="header-text">
            Prodigy CBT Application
          </div>
        </div>
      </div>
    </section>
    <section class="home">
      <div class="container">
          <div class="content-header">
            <div class="row">
              <div class="col-md-8">
                <div class="content-text">
                  <h2>Welcome! <?php echo $fullname; ?></h2>
                  <h2>Class:  <?php echo $grade; ?></h2>
                  <p class="last-login">Last Login: <?php echo $last_log_date; ?></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="content-btn">
                  <a href="../logout.php" class="btn btn-danger">Log Out</a>
                  </div>
              </div>
            </div>
          </div>
    </section>
    <section class="main-content">
      <div class="container">
          <div class="dashboard">
              <div class="dashboard-heading">
                  <div class="dashboard-title text-center">
                      <h4>Select your subjects from the options below and click on START to continue</h4>
                  </div>
              </div>
          </div> 
          <div class="dashboard-collapse">
              <div class="dashboard-body">
                <div class="row">
                <div class="col-md-2"></div>
                  <div class="col-md-8 overflow-hidden">
  
                    <?php

                      $result = mysqli_query($link,"SELECT * FROM ss3_subjects ORDER BY subject_name ASC") or die('Error');
                      echo  '<div class="panel"><div class="table-responsive" style="text-transform:uppercase;"><table class="table table-striped table-bordered text-center" style="font-family: Ubuntu;">
                      <tr class="info"><td style="width:20%;"><b>S/N</b></td><td style="width:50%;"><b>Subjects</b></td><td style="width:20%;"></td></tr>';
                      $c=1;
                      while($row = mysqli_fetch_array($result)) {
	                    $subject_name = $row['subject_name'];
                      $check=mysqli_query($link,"SELECT score FROM results WHERE subject_name='$subject_name' AND username='$username'" )or die('Error98');
          
                      $rowcount=mysqli_num_rows($check);	

                      if($rowcount == 0){
	                    echo '<tr><td>'.$c++.'</td><td style="text-transform:uppercase">'.$subject_name.'</td>
	                    <td><b><a href="test.php?subject_name='.$subject_name.'" class="pull-right btn sub1" style="background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true" ></span>&nbsp;<span><b>START</b></span></a></b></td></tr>';
                      }
                      else
                      {
                      echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td style="text-transform:uppercase">'.$subject_name.'&nbsp;<span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
	                    <td><b><a href="#" class="pull-right btn sub1" style="margin:0px;background:red" ><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span><b>DONE</b></span></a></b></td></tr>';
                      }
                    }
                      $c=0;
                      echo '</table></div></div>';
                    ?>
                  </div>
                  <div class="col-md-2"></div>
                  </div>
              </div>
          </div>
          <div class="row mt-20">
              <div class="col-md-12 text-center">
                  <a href="view_results.php"><button class="btn btn-primary">Check Results</button></a>
              </div>
          </div>
      </div>
    </section>
    <section class="row">
      <div class="footer">
          <div class="col-md-12">
            <div class="footer-text">&copy; Prodigy Technologies,  2022</div>
          </div>
      </div>
  </section>
  </body>
</html>
