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

$sql = mysqli_query( $link, "SELECT * FROM ss3_subjects;");
$settings = mysqli_fetch_assoc($sql);
$subject_name = $settings['subject_name'];

if (isset($_POST['add'])){
  // get inputed values
  $subject_name = $_POST['subject_name'];
  $question = $_POST['question'];
  $option_A = $_POST['option_A'];
  $option_B = $_POST['option_B'];
  $option_C = $_POST['option_C'];
  $option_D = $_POST['option_D'];
  $correct_answer = $_POST['correct_answer'];
  $date_added = date('Y-m-d H:i:s');
  // generate pin for this email
  for ($index = 0; $index < 1; $index++){
    $rand = mt_rand(1000000000, (int)9999999999);
    $question_id = $rand;
  }

  // check if all field is not empty
  if (empty($subject_name && $question && $option_A && $option_B && $option_C && $option_D && $correct_answer) == false)
  {
    $query_question_id = "SELECT question_id FROM questions WHERE `question_id`='".$question_id."'";
    $check_query = $link->query($query_question_id);
    if ($check_query->num_rows == 0)
    {
      //insert data into the data
      $sqlinsert = "INSERT INTO questions (`subject_name`, `question`, `option_A`, `option_B`, `option_C`, `option_D`, `correct_answer`, `date_added`, `question_id`) VALUES ('".$subject_name."', '".$question."', '".$option_A."', '".$option_B."', '".$option_C."', '".$option_D."', '".$correct_answer."', '".$date_added."', '".$question_id."')";
      $checksql = $link->query($sqlinsert);
      if ($checksql){
        ?><script type="text/javascript">
          alert ('Question Added Successfully');
        </script><?php
      } else {
        ?><script type="text/javascript">
          alert ('Error has occurred');
        </script><?php
      }
    } else {
      $index -= 1;
      ?><script type="text/javascript">
        alert ('Opps! Error has occurred');
      </script><?php
    }
  } else {
    ?><script type="text/javascript">
        alert ('All fields are required');
    </script><?php
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
                  </div>
              </div>
            </div>
          </div>
    </section>
    <section class="main-content">
      <div class="container">
        <div class="row">
          <div class="col-md-4 box">
            <a href="#" data-target="#addQuiz" data-toggle="modal">
              <div class="small-box">
                <i class="fa fa-question-circle"></i>
                  <h2>Add Subject</h2>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="edit_questions.php">
              <div class="small-box">
                <i class="fa fa-book"></i>
                  <h2>Edit Subject</h2>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="students_results.php">
              <div class="small-box">
                <i class="fa fa-calculator"></i>
                  <h2>Check Results</h2>
              </div>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <a href="add_students.php">
              <div class="small-box">
                <i class="fa fa-user-plus"></i>
                  <h2>Add Student</h2>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="students_list.php">
              <div class="small-box">
                <i class="fa fa-user"></i>
                  <h2>Edit Student</h2>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="#">
              <div class="small-box">
                <i class="fa fa-cogs"></i>
                  <h2>Settings</h2>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="addQuiz" role="dialog">
    <div class="modal-dialog modal-lg" style="max-height: 500px; overflow-x: auto;">
        <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">close</button>
          <h4 class="modal-title" style="text-align: left;">ADD SUBJECT</h4>
        </div>
        <div class="modal-body">
          <div class="login-box-body">
            <p class="login-box-msg" style="text-align: left; font-size: 16px;">Enter Question Details</p>
            <div class="form-group">
              <form id="addQquizForm" method="POST" action="">
                <div class="form-group">
                  <select name="subject_name" class="form-control">
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
                <p style="text-align: left; font-size: 16px;">Enter Question</p>
                  <textarea class="form-control" placeholder="Enter Question" rows="10" cols="40" id="" name="question" ></textarea> 
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Option A" id="" name="option_A" type="text" autocomplete="off"  />
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Option B" id="" name="option_B" type="text" autocomplete="off"  />
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Option C" id="" name="option_C" type="text" autocomplete="off"  />
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Option D" id="" name="option_D" type="text" autocomplete="off"  />
                </div>
                <div class="form-group">
                  <select class="form-control" name="correct_answer">
                    <option value="Null">Select Correct Option</option>
                    <option value="A">Option A</option>
                    <option value="B">Option B</option>
                    <option value="C">Option C</option>
                    <option value="D">Option D</option>
                  </select>
                </div>
                <div class="row text-center">
                    <input type="submit" class="btn btn-success" style="margin-right: 12px;" name="add" id="addBtn" value="Add Question">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="row">
      <div class="footer">
          <div class="col-md-12">
            <div class="footer-text">&copy; Prodigy Technologies,  2022</div>
          </div>
      </div>
  </section>
  <script>
tinymce.init({ selector:'textarea',
height: 150,
menubar: false,
plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
content_css: 'http://localhost/myCBT/style/content_css.css' });
</script>
</body>
</html>
