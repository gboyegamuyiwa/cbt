<?php
require_once 'include/config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $error_msg = "";

$last_log_date = date('Y-m-d H:i:s');

session_start();

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, fullname, password FROM admin_tab WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                  // Bind result variables
                  mysqli_stmt_bind_result($stmt, $username, $fullname, $hashed_password);
                  if(mysqli_stmt_fetch($stmt)){
                      if(password_verify($password, $hashed_password)){
                        
                          /* Password is correct, so start a new session and
                          save the username to the session */
                          //session_start();
                          $_SESSION['username'] = $username;
                          $_SESSION['fullname'] = $fullname;
                          $update_last_log_date = "UPDATE admin_tab SET `last_log_date`='".$last_log_date."' WHERE `username`='".$username."'";
                          $checkupdate = $link->query($update_last_log_date);  
                          header("location: admin_dashboard.php");
                      
                      } else{
                          // Display an error message if password is not valid
                          $password_err = 'Wrong Password.';
                      }
                  }
              } else{
                  // Display an error message if username doesn't exist
                  $username_err = 'Username is already registered.';
              }
          } else{
              echo "Something went wrong. Please try again.";
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
    <!-- CSS File -->
    <link rel="stylesheet" href="../assets/css/style.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  </head>

  <body style="background-image: url('../assets/img/exam.jpg');">
    <section class="container">
      <div class="row">
        <div class="left-column col-md-5 text-center justify-center">
          <div class="img-left">
            <img src="../assets/img/logo.png" class="img-fluid" alt="logo" />
          </div>
          <div class="text">Prodigy CBT</div>
          <div class="sub-text">... simple CBT Solutions for schools</div>
        </div>
        <div class="col-md-7">
          <div class="login">
            <h1 class="text-center">ADMIN LOGIN</h1>

            <form class="form" id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <?php if(!empty($error_msg)){
                      echo "<center><div class='alert alert-danger' role='alert'>
                      <STRONG>Warning! </STRONG>$error_msg</div></center>";
                  }?>
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"
                      ><i class="fa fa-user"></i
                    ></span>
                  </div>
                  <input
                    class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                    type="text"
                    value="<?php echo $username; ?>" name = "username"
                    placeholder="Username"
                  />
                </div>
                <span class="help-block" style="color: red;"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"
                      ><i class="fa fa-lock"></i
                    ></span>
                  </div>
                  <input
                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                    type="password"
                    value="<?php echo $password; ?>" name = "password"
                    placeholder="Password"
                  />
                </div>
                <span class="help-block" style="color: red;"><?php echo $password_err; ?></span>
              </div>
              <input
                class="btn btn-success w-100"
                type="submit"
                value="LOGIN"
              />
            </form>
            <div class="text-center pt-3">
              <div class="register-link">
                Missed your way? <a href="../index.php"> Go Back</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
