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
$check = mysqli_query( $link, "SELECT * FROM admin_tab WHERE username='".$username."'");
$setting = mysqli_fetch_assoc($check);
$usernames = $setting['username'];
$fullnames = $setting['fullname'];
$last_log_date = $setting['last_log_date'];

$last_log_date = date('Y-m-d H:i:s');

// Define variables and initialize with empty values
$username = $fullname = $grade = $password = $confirm_password = "";
$username_err = $fullname_err = $grade_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT username, fullname, grade, password FROM students_tab WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Username has been registered.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Something went wrong. Please try again.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate fullname
    if(empty(trim($_POST['fullname']))){
        $fullname_err = "Please enter fullname.";     
    } else{
        $fullname = trim($_POST['fullname']);
    }

    // Validate grade
    if($_POST['grade'] == ""){
        $grade_err = "Please enter class.";     
    } else{
        $grade = trim($_POST['grade']);
    }

    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter password.";     
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm Password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Wwrong Password.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($fullname_err) && empty($grade_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO students_tab (username, fullname, grade, password) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_fullname, $param_grade, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_fullname = $fullname;
            $param_grade = $grade;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
              $update_last_log_date = "UPDATE students_tab SET `last_log_date`='".$last_log_date."' WHERE `username`='".$username."'";
              $checkupdate = $link->query($update_last_log_date); 
                header("location: add_students.php?msg=success");
            } else{
                header("location: add_students.php?msg=failed");
                //echo "Something went wrong. Please try again";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
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
      <!-- CSS File -->
    <link rel="stylesheet" href="css/custom.css" />

    <script src="js/jquery/bootstrap.min.js" type="text/javascript" > </script>
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
                  <h2>Welcome! <?php echo $fullnames; ?></h2>
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
        <div class="col-md-6 text-center">
        <h2>Add Student</h2>
          <br>
          <?php if(isset($_GET['msg'])){
            if ($_GET['msg'] === "success"){
              echo "<div class='alert alert-success' role='alert'>Changes saved successfuly!</div>";
            }
            else{
              echo "<div class='alert alert-danger' role='alert'>Failed to save changes!</div>";
            }
          } ?>
	    <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
    <div class="form-group">
      <div class="input-group mb-3"><div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-user"></i></span>
        </div>
        <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" name = "username" placeholder="Username" style="" />
      </div>
      <span class="help-block" style="color: red;"><?php echo $username_err; ?></span>
    </div>

    <div class="form-group">
      <div class="input-group mb-3"><div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
        </div>
        <input type="text" class="form-control <?php echo (!empty($fullname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fullname; ?>" name = "fullname" placeholder="Full Name" style="" />
      </div>
      <span class="help-block" style="color: red;"><?php echo $fullname_err; ?></span>
    </div>

    <div class="form-group">
      <div class="input-group mb-3"><div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-users"></i></span>
        </div>
                <select class="custom-select <?php echo (!empty($grade_err)) ? 'is-invalid' : ''; ?>" name="grade">
                    <option value="" style="display:none">Class</option>
                    <option value="SS3">SS3</option>
                    <option value="SS2">SS2</option>
                    <option value="SS1">SS1</option>
                </select>
      </div>
      <span class="help-block" style="color: red;"><?php echo $grade_err; ?></span>
    </div>

    <div class="form-group">
      <div class="input-group mb-3"><div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-lock"></i></span>
        </div>
        <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name = "password" placeholder="Password" />
      </div>
      <span class="help-block" style="color: red;"><?php echo $password_err; ?></span>
    </div>

    <div class="form-group">
      <div class="input-group mb-3"><div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-lock"></i></span>
      </div>
        <input type="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" name = "confirm_password" placeholder="Confirm Password" />
      </div>
      <span class="help-block" style="color: red;"><?php echo $confirm_password_err; ?></span>
    </div>

    <div class="form-group text-center">
      <input type="submit" class="btn btn-primary" value="Add">
    </div>
    </form>
        </div>
        <div class="col-md-3"></div>
      </div>
    
      </div>
    </section>
    <section class="">
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
