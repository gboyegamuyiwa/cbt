<?php
session_start();

require_once 'include/config.php';

if (!isset($_SESSION['username'])){
	header ('location: ./index.php');
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

$qryresult="SELECT * FROM results WHERE `username`='".$username."' LIMIT 30";
$qryresultcheck=$link->query($qryresult);
if ($qryresultcheck->num_rows > 0){
  while ($row = $qryresultcheck->fetch_assoc()) {
    $id = $row['id'];
    $username = $row['username'];
    $subject_name = $row['subject_name'];
    $score= $row['score'];
    //$date_taken = $row['date_taken'];
    $date_taken=strftime("%d %b, %Y %H:%M:%S",strtotime($row['date_taken']));

    $results .= "<tr>";
    $results .= "<td><b>".$counter++. "</b></td>";
    $results .= "<td>".$date_taken. "</td>";
    $results .= "<td style='text-transform:uppercase';>".$subject_name."</td>"; 
    $results .= "<td>".$score."</td>";
    $results .= "</tr>";
  }
} else {
  $msg =  "No Result found";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Prodigy CBT | Simple CBT Solutions for Schools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <meta name="description" content="A Simple Computer-Based-Test (CBT) web application made using HTML, CSS (Bootstrap), JavaScript, PHP and MySQL">
    <meta name="keywords" content="CBT, Quiz, Online-Test, Computer-Based Exam, HTML,CSS,JavaScript,PHP, MySQL">
    <meta name="author" content="Adegboyega Olumuyiwa" />

    <link rel="stylesheet" href="style/bootstrap.min.css" />
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
                  <a href="user_dashboard.php" class="btn btn-success">Go Back</a>
                  </div>
              </div>
            </div>
          </div>
    </section>
    <section class="main-content">          
    <div class="col-md-12">
        <div class="container">
          <div class="row">
            <div class="col-md-8 page-title">
              <h4 style="color:#880000;"><b>Your Test Details are:</b></h4>
            </div>
            <div class="col-md-12">
              <p style="text-align: center; color: #880000; font-size: 20px;"><?php echo $msg; ?></p>
               <div style="max-height: 400px; overflow-x: auto">
                 <table class="table table-bordered" style="font-family: Ubuntu;">
                  <thead>
                    <tr class="info" style="text-transform: uppercase;">
                      <th>S/N</th>
                      <th>Date Of Test</th>
                      <th>Subject</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <?php echo $results; ?>
                  </table>
                </div>
            </div>
         
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
