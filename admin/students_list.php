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

$msg = "";
$results = "";

// fetch out login date for sessioned admin
$check = mysqli_query( $link, "SELECT * FROM admin_tab WHERE username='".$username."'");
$setting = mysqli_fetch_assoc($check);
$last_log_date = $setting['last_log_date'];

$query = mysqli_query($link, "SELECT fullname, username, grade FROM students_tab;");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Prodigy CBT | Simple CBT Solutions for Schools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <meta name="description" content="A Simple Computer-Based-Test (CBT) web application made using HTML, CSS (Bootstrap), JavaScript, PHP and MySQL">
    <meta name="keywords" content="CBT, Quiz, Online-Test, Computer-Based Exam, HTML,CSS,JavaScript,PHP, MySQL">
    <meta name="author" content="Adegboyega Olumuyiwa" />

    <link href="style/sweet-alert.css" type="text/css" rel="stylesheet" />
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
    <link rel="stylesheet" href="css/datatables.min.css">
      <!-- CSS File -->
    <link rel="stylesheet" href="css/custom.css" />

    <script src="js/jquery/jquery-2.1.3.min.js" type="text/javascript"> </script>
    <script src="js/sweet-alert.js" type="text/javascript"> </script>
    <script src="js/jGrowl/jquery.jgrowl.js" type="text/javascript"> </script>
    <script src="js/jquery/bootstrap.min.js" type="text/javascript" > </script>
    <script src="js/tinymce/tinymce.min.js" type="text/javascript"></script>
  </head>

  <body>
  <script src="js/jquery-3.6.0.js"></script>
        <script src="js/datatables.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready( function () {
        $('#viewResult').DataTable( {
        language: {
            processing:     "Processing...",
            search:         "Search&nbsp;:",
            lengthMenu:    "Showing _MENU_ students",
            info:           "Showing results of _START_ to _END_ students from a total of _TOTAL_ students",
            infoEmpty:      "Showing data 0 out of 0 from total 0 data",
            infoFiltered:   "(Filter from total _MAX_ data)",
            infoPostFix:    "",
            loadingRecords: "Loading...",
            zeroRecords:    "No result to display",
            emptyTable:     "No result in Table",
            paginate: {
                first:      "First",
                previous:   "Previous",
                next:       "Next",
                last:       "Last"
            },
            aria: {
                sortAscending:  ": Sort Ascending",
                sortDescending: ": Sort Descending"
            },
            language: {
            decimal: ",",
            }
        }   
    } );
    } );
    </script>
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
    <center><h2>Students' List</h2></center>
        <?php if(isset($_GET['msg'])){
            if ($_GET['msg'] === "success"){
              echo "<div class='alert alert-success' role='alert'>Changes Saved Successfuly!</div>";
            }
            else{
              echo "<div class='alert alert-danger' role='alert'>Failed to Save changes!</div>";
            }
          } ?>
          <?php if(isset($_GET['msg1'])){
            if ($_GET['msg1'] === "success"){
              echo "<div class='alert alert-success' role='alert'>Deleted Successfuly!</div>";
            }
            else{
              echo "<div class='alert alert-danger' role='alert'>Failed to Delete!</div>";
            }
          } ?>

	    <table id="viewResult" class="table display table-bordered table-striped" style="width:100%;text-transform:uppercase;font-family:Ubuntu;">
          <thead>
              <tr class="info">
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Class</th>
                  <th>Change</th>
                  <th>Delete</th>
              </tr>
          </thead>
          <tbody>
                  <?php
                  while ( $view = mysqli_fetch_assoc($query) ) {
                    echo "<tr>";
                    echo "<td>" . $view['fullname'] . "</td>";
                    echo "<td>" . $view['username'] . "</td>";
                    echo "<td>" . $view['grade'] . "</td>";
                    echo "<td> <a href=\"edit_students.php?id=$view[username]\" class=\"btn btn-primary\">Change</a> </td>";
                    echo "<td> <a href=\"delete_students.php?id=$view[username]\" class=\"btn btn-danger\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a> </td>";
                    echo "</tr>";
                  }
                  ?>
          </tbody>
      </table>
      </div>
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
