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

$subject_name = $_SESSION['subject_name'];

// fetch out login date for sessioned user
$query = mysqli_query( $link, "SELECT * FROM students_tab WHERE username='".$username."'");
$setting = mysqli_fetch_assoc($query);
$last_log_date = $setting['last_log_date'];

// fetch out questions and answers from the database
$sql = "SELECT * FROM questions WHERE `subject_name`='".$subject_name."' LIMIT 10";
$value  = $link->query($sql);
foreach ($value as $row){
  $id = $row['id'];
  $questions = $row['question'];
  $optionA = $row['option_A'];
  $optionB = $row['option_B'];
  $optionC= $row['option_C'];
  $optionD = $row['option_D'];
  $answer = $row['correct_answer'];
 }

 $number_of_question= mysqli_num_rows($value);

//check and compare anwsers
if (isset($_POST['submit'])){
 
        $option_array = $_POST['option'];
        $each_question_correct_answer = $_POST["correct_answer"];
        //echo json_encode($each_question_correct_answer).'<br/>'; die();

        $each_question_correct_answer_string = implode(',', $each_question_correct_answer);
        //echo $each_question_correct_answer_string . '<br>';

        if (empty($option_array) == false){
          //convert answers back to array
          
          $correct_answer_array = explode(",", $each_question_correct_answer_string);
          //echo json_encode($correct_answer_array).'<br/>';
          //use array_intersect to check for corresponding answers
          $score= array_intersect_assoc($correct_answer_array,$option_array);
          $resultcount = count($score);
          $wrongAnswers = $number_of_question - $resultcount;
          //echo $percentage_score; exit();

          $date_taken = date('Y-m-d H:i:s');


          $insertresult = "INSERT INTO results (`username`, `fullname`, `score`, `date_taken`, `subject_name`, `grade`) VALUES ('$username', '$fullname', '$resultcount', '$date_taken', '$subject_name', '$grade')";
          
          $checkinsert = $link->query($insertresult);
          if (!$checkinsert){
            die ('Error inserting has occurred');
          }
        } else {
          ?><script type="text/javascript">
            alert('You need to attempt at least one question');
            window.location = "select_subject.php";
          </script><?php
        }
    
} else {
  echo "<p style='text-align: center; font-size: 18px;'>Your Quiz session has expired... Click <a href='user_dashboard.php'>here</a> to go to your dashboard and re-take the exam if needed</p>";
  die();
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
                </div>
              </div>
            </div>
          </div>
    </section>
    <section class="main-content">
          <div class="container">
              <div class="row">
                <div class="col-md-12 text-center">
                <h3 style="text-transform: uppercase; font-weight: bold; color:#880000;"><?php echo "Your Result For : " . " " . $subject_name; ?></h3>
                </div>
              </div>
                <div class="row">
                  <div class="col-md-3"></div>
                    <div class="col-md-6 text-center result-header">
                      <div class="card-header">
                          <h3>You Scored <?php echo $resultcount;?>  / <?php echo $number_of_question; ?></h3>
                      </div>
                      <div class="card-body">
                          <h3>Details is shown below:</h3>
                              <div><i class="fa fa-check" style="color:green;"></i> <span class="answer"><?php echo $resultcount;?></span> Correct Answer(s)</div>
                              <div><i class="fa fa-times" style="color:#880000;"></i> <span class="answer"><?php echo $wrongAnswers;?></span> Wrong or Unanswered </div>
                      </div>
                    </div>
                  <div class="col-md-3"></div>
                </div>
              </div>
              <div class="row">
            <div class="col-md-12 text-center" style="margin-top:15px;">
              <a href="user_dashboard.php" class="btn btn-primary">Take Another Test</a>
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
