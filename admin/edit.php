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

// get data for question
if (isset($_GET['question_id'])){
  $question_id = $_GET['question_id'];

  // fetch data with the question id
  $select_question = "SELECT * FROM `questions` WHERE `id`='".$question_id."' LIMIT 1";
  $check_select = $link->query($select_question);
  if ($check_select->num_rows > 0){
    while ($row = $check_select->fetch_assoc()){
      $question_name = $row['question'];
      $subjectName = $row['subject_name'];
      $optionA = $row['option_A'];
      $optionB = $row['option_B'];
      $optionC = $row['option_C'];
      $optionD = $row['option_D'];
      $correctAnswer = $row['correct_answer'];
    }
  } else {
    echo "Question ID not found";
    die();
  }

}

if (isset($_POST['update'])){
  // get inputed values
  $subject_name = $_POST['subject_name'];
  $question = $_POST['question'];
  $option_A = $_POST['option_A'];
  $option_B = $_POST['option_B'];
  $option_C = $_POST['option_C'];
  $option_D = $_POST['option_D'];
  $correct_answer = $_POST['correct_answer'];
  //$date_added = date('Y-m-d H:i:s');

  // check if all field is not empty
  if (empty($question && $option_A && $option_B && $option_C && $option_D) == false)
  {
  
    //insert data into the data
    $sqlupdate = "UPDATE questions SET `subject_name`='".$subject_name."', `question`='".$question."', `option_A`='".$option_A."', `option_B`='".$option_B."', `option_C`='".$option_C."', `option_D`='".$option_D."', `correct_answer`='".$correct_answer."' WHERE `id`='".$question_id."' LIMIT 1";
    $checksql = $link->query($sqlupdate);
    if ($checksql){
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { 
          swal({
            title: "Congratulations!",
            text: "Question '.$question_id.' Updated Successfully",
            type: "success",
            confirmButtonText: "OK"
          },
          function(isConfirm){
            if (isConfirm) {
              window.location.href = "edit.php?question_id='.$question_id.'";
            }
          }); }, 500)';
        echo '</script>';
    } else {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { 
        swal({
          title: "Opps!",
          text: "Error has occured",
          type: "warning",
          confirmButtonText: "TRY AGAIN"
        },
        function(isConfirm){
          if (isConfirm) {
            window.location.href = "edit.php?question_id='.$question_id.'";
          }
        }); }, 500)';
      echo '</script>';
    }
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { 
      swal({
        title: "Opps!",
        text: "All fields are require",
        type: "warning",
        confirmButtonText: "TRY AGAIN"
      },
      function(isConfirm){
        if (isConfirm) {
          window.location.href = "edit.php?question_id='.$question_id.'";
        }
      }); }, 500)';
    echo '</script>';
  }
   
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

    <link href="style/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="style/sweet-alert.css" type="text/css" rel="stylesheet" />
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

    <script src="js/jquery/jquery-2.1.3.min.js" type="text/javascript"> </script>
    <script src="js/sweet-alert.js" type="text/javascript"> </script>
    <script src="js/jGrowl/jquery.jgrowl.js" type="text/javascript"> </script>
    <script src="js/jquery/bootstrap.min.js" type="text/javascript" > </script>
    <script src="js/tinymce/tinymce.min.js" type="text/javascript"></script>
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
    <section class="main-contents">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="text-center">
        <h3 style="color: #880000; text-transform: uppercase;">Question ID: <?php echo $question_id; ?> (<?php echo $subjectName; ?>)</h3>
        </div>
              <form class="" id="addQquizForm" method="POST" action="">
                <div class="form-group">
                  <label>Edit Subject</label>
                  <select name="subject_name" class="form-control">
                    <option value="<?php echo $subjectName; ?>"><?php echo $subjectName; ?></option>
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
                  </select>
                </div>
                <div class="form-group">
                <label>Edit Question</label>
                  <textarea class="form-control" placeholder="Enter Question" rows="10" cols="40" id="" name="question" ><?php echo $question_name; ?></textarea> 
                </div>
                <div class="form-group">
                  <label>Change Option A</label>
                  <input class="form-control" placeholder="Option A" id="" name="option_A" type="text" autocomplete="off" value="<?php echo $optionA; ?>">
                </div>
                <div class="form-group">
                  <label>Change Option B</label>
                  <input class="form-control" placeholder="Option B" id="" name="option_B" type="text" autocomplete="off" value="<?php echo $optionB; ?>">
                </div>
                <div class="form-group">
                  <label>Change Option C</label>
                  <input class="form-control" placeholder="Option C" id="" name="option_C" type="text" autocomplete="off" value="<?php echo $optionC; ?>">
                </div>
                <div class="form-group">
                  <label>Change Option D</label>
                  <input class="form-control" placeholder="Option D" id="" name="option_D" type="text" autocomplete="off" value="<?php echo $optionD; ?>">
                </div>
                <div class="form-group">
                  <label>Change Correct Answer</label>
                  <select class="form-control" name="correct_answer">
                    <option value="<?php echo $correctAnswer; ?>"><?php echo $correctAnswer; ?></option>
                    <option value="A">Option A</option>
                    <option value="B">Option B</option>
                    <option value="C">Option C</option>
                    <option value="D">Option D</option>
                  </select>
                </div>
                <div class="row text-center">
                    <input type="submit" class="btn btn-primary" style="margin-right: 12px;" name="update" id="addBtn" value="Update Question">
                </div>
              </form>
    </div>
    <div class="col-md-3"></div>
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
