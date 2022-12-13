<?php
// set session
session_start();
require_once 'include/config.php';

if (!isset($_SESSION['username'])){
	header ('location: ../index.php');
} else {
	// set session for sessioned data
	$username = $_SESSION['username'];
  $fullname = $_SESSION['fullname'];
}

// fetch out login date for sessioned admin
$query = mysqli_query( $link, "SELECT * FROM admin_tab WHERE username='".$username."'");
$setting = mysqli_fetch_assoc($query);
$last_log_date = $setting['last_log_date'];

$results = "";
$counter = 1;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Prodigy CBT | Simple CBT Solutions for Schools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <meta name="description" content="A Simple Computer-Based-Test (CBT) web application made using HTML, CSS (Bootstrap), JavaScript, PHP and MySQL">
    <meta name="keywords" content="CBT, Quiz, Online-Test, Computer-Based Exam, HTML,CSS,JavaScript,PHP, MySQL">
    <meta name="author" content="Adegboyega Olumuyiwa" />

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
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
  <section class="">
      <div class="row">
        <div class="col-md-12">
          <div class="header">
            <div class="header-text">
              Prodigy CBT Application
            </div>
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
                  <p class="last-login">Last Login: <?php echo $last_log_date; ?></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="content-btn">
                  <a href="../logout.php" class="btn btn-danger">Log Out</a>
                  <a href="admin_dashboard.php" class="btn btn-primary">Go back</a>
                </div>
              </div>
            </div>
          </div>
    </section>
    <section class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <h3 style="text-align: center;">Search By subject</h3>
          <div class="form-group">
            <form action="" method="GET">
              <select name="search_by_subject" class="form-control">
              <option value="">Select Subject</option>
                    <option value="ss3_accounts">Accounts</option>
                    <option value="ss3_agric_science">Agric Science</option>
                    <option value="ss3_biology">Biology</option>
                    <option value="ss3_chemistry">Chemistry</option>
                    <option value="ss3_commerce">Commerce</option>
                    <option value="ss3_computer_science">Computer Science</option>
                    <option value="ss3_economics">Economics</option>
                    <option value="ss3_english">English</option>
                    <option value="ss3_geography">Geography</option>
                    <option value="ss3_government">Government</option>
                    <option value="ss3_literature">Literature</option>
                    <option value="ss3_mathematics">Mathematics</option>
                    <option value="ss3_physics">Physics</option>
                    <option value="ss3_yoruba">Yoruba</option>
              </select><br>
              <div class="col-md-12 text-center">
                <input type="submit" name="search" class="btn btn-primary" value="SEARCH">
              </div>
            </form>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div><br>
      <?php
        if (isset($_GET['search']))
        {
          // get inputed values
          $subject = $_GET['search_by_subject'];
          // check if all field is not empty
          if (empty($subject) == false)
          {
            if($_GET['search_by_subject'] == "ss3_accounts"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_agric_science"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_biology"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_chemistry"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_commerce"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_computer_science"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_economics"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_english"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_geography"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_governemt"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_literature"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_mathematics"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_physics"){
              require_once "select_query.php";
            } else if ($_GET['search_by_subject'] == "ss3_yoruba"){
              require_once "select_query.php";  
            } else if ($_GET['search_by_subject'] == "Null"){
              echo '<script type="text/javascript">';
              echo 'setTimeout(function () { 
              swal({
                title: "Error!",
                text: "Please Select subject",
                type: "warning",
                confirmButtonText: "OK"
              },
              function(isConfirm){
                if (isConfirm) {
                  window.location.href = "edit_questions.php";
                }
              }); }, 500)';
              echo '</script>';
            } 
          } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { 
            swal({
              title: "Error!",
              text: "Please Select subject",
              type: "warning",
              confirmButtonText: "OK"
            },
            function(isConfirm){
              if (isConfirm) {
                window.location.href = "edit_questions.php";
              }
            }); }, 500)';
            echo '</script>';
          }
        }

?>
    </section>
    <section class="foot">
      <div class="footer">
        <div class="row">
        <div class="col-md-12">
            <div class="footer-text">&copy; Prodigy Technologies,  2022</div>
          </div>
        </div>
      </div>
  </section>
  </body>
</html>
