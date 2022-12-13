<?php
// set session
ob_start();
session_start();
require 'include/config.php';

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

$quizpack = "";
$counter = 1;

if (isset($_GET['subject_name'])){
  $subject_name = $_GET['subject_name'];
} else {
  echo "Error has occured"; 
}

$querycheck = mysqli_query( $link, "SELECT * FROM settings;");
$setvalue = mysqli_fetch_assoc($querycheck);
$duration = $setvalue['duration'];

// fetch out questions and answers from the database
$value="SELECT * FROM questions WHERE `subject_name`='".$subject_name."' LIMIT 10";
$valuecheck=$link->query($value);
foreach ($valuecheck as $row){
}
$number_of_question= mysqli_num_rows($valuecheck);

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
        <div class="container">
              <div class="row">
                  <div class="col-md-8">
                      <h4 style="text-transform: uppercase;"><b><?php echo "Subject: " . " " . $subject_name; ?></b></h4>
                      <p>Total Number of Questions: <?php echo "$number_of_question"; ?></p>
                      <p>Total time given: 10 minutes</p>
                      <p style="color: #880000; font-size: 16px;text-transform: uppercase;"><b>Test Instructions:</b></p> 
                      <p>Attempts all Questions within the limited time provided.</p>
                      <p>Click on the START TEST button to start.</p>
                      <p>Click on the FINISH & SUBMIT button at the end of the test to submit and receive your score.</p>
                  </div>
                  <div class="col-md-4">
                      <div class="cta-btn">
                          <div class="btn btn-danger" id="timebar">Time Remaining <span id="timer">0h:10m:00s</span></div>
                      </div>
                  </div>
              </div><br>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary" id="mybut" onclick="myFunction()">START TEST</button>
                    </div>
                  </div><br>
                  <h4 style="color: #880000; font-size: 18px; text-transform: uppercase;" id="examSession">Test now in session...</h4>
          <div id="MyDiv" style="max-height: 500px; overflow-x: auto; border: 0px solid #CECECE; background: #f4f4f4; padding: 18px 18px 18px 18px; border-radius: 10px;">
            <div class="row">
            <div class="col-md-12">
              <?php
              if ($number_of_question == 0) {
               echo "<h4>Questions not available for this subject! Click the Go Back button to continue</h4>";
              } else {
                echo "<form method='POST' role='form' id='form' action='result.php';>"?>
                <?php
         
               $sql = mysqli_query( $link, "SELECT * FROM questions WHERE `subject_name`='".$subject_name."' ORDER BY RAND() LIMIT 10");
                 $i = 1;
                 foreach ($sql as $row){
                   $question_id = $row['question_id'];
                   $questions = $row['question'];
                   $optionA = $row['option_A'];
                   $optionB = $row['option_B'];
                   $optionC= $row['option_C'];
                   $optionD = $row['option_D'];
                   $correct_answer = $row['correct_answer'];
                   $_SESSION['subject_name'] = $subject_name;
                                    
                   $number_of_question= mysqli_num_rows($sql);  
                   $remainder = $sql->num_rows/$number_of_question;
                ?>
                
                <?php if($i==1){?>
                 <div id='question<?php echo $i;?>' class='cont'>
                  <div class="form-group">
                     <label style="font-weight: normal; text-align: justify;" class="questions"><b><?php echo "Question" . " " . $counter++; ?></b>&nbsp<?php echo $questions; ?></label><br>
                     <div id="quiz-options">
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="A"> <?php echo $optionA; ?>
                       </label><br>
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="B"> <?php echo $optionB; ?>
                       </label><br>
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="C"> <?php echo $optionC; ?>
                       </label><br>
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="D"> <?php echo $optionD; ?>
                       </label><br>  
                       <input type="hidden" name="correct_answer[]" value="<?php echo $correct_answer; ?>">              
                       <button id='next<?php echo $i;?>' class='next btn btn-primary pull-right' type='button' >Next</button>
                       
                     </div>
                   </div>
                 </div>
                 <?php }elseif($i<1 || $i<$sql->num_rows){?>
                   <div id='question<?php echo $i;?>' class='cont'>
                  <div class="form-group">
                     <label style="font-weight: normal; text-align: justify;" class="questions"><b><?php echo "Question" . " " . $counter++; ?></b>&nbsp<?php echo $questions; ?></label><br>
                     <div id="quiz-options">
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="A"> <?php echo $optionA; ?>
                       </label><br>
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="B"> <?php echo $optionB; ?>
                       </label><br>
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="C"> <?php echo $optionC; ?>
                       </label><br>
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="D"> <?php echo $optionD; ?>
                       </label><br>
                       <input type="hidden" name="correct_answer[]" value="<?php echo $correct_answer; ?>">
                       <br>                  
                       <button id='pre<?php echo $i;?>' class='previous btn btn-primary' type='button'>Previous</button>                    
                       <button id='next<?php echo $i;?>' class='next btn btn-primary pull-right' type='button' >Next</button>
                     </div>
                  </div>
                 </div>
               <?php }elseif(( $remainder < 1 ) || ( $i == $number_of_question && $remainder == 1 ) ){?>
                   <div id='question<?php echo $i;?>' class='cont'>
                  <div class="form-group">
                     <label style="font-weight: normal; text-align: justify;" class="questions"><b><?php echo "Question" . " " . $counter++; ?></b>&nbsp<?php echo $questions; ?></label><br>
                     <div id="quiz-options">
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="A"> <?php echo $optionA; ?>
                       </label><br>
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="B"> <?php echo $optionB; ?>
                       </label><br>
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="C"> <?php echo $optionC; ?>
                       </label><br>
                       <label style="font-weight: normal; cursor: pointer;">
                         <input type="checkbox" name="option[]" value="D"> <?php echo $optionD; ?>
                       </label><br>
                       <input type="hidden" name="correct_answer[]" value="<?php echo $correct_answer; ?>"> 
                        <br>      
                       <button id='pre<?php echo $i;?>' class='previous btn btn-primary' type='button'>Previous</button>                    
                       <input class='btn btn-danger pull-right' value="Finish & Submit" name="submit" type='submit'>
                     </div>
                  </div>
                 </div>
                 <?php } 
               $i++;} ?>
                
             <?php echo "</form>";
              }
              ?>
              </div>
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
  
  <script src="js/jquery/jquery-2.1.3.min.js" type="text/javascript"> </script>
  <script src="js/jquery/bootstrap.min.js" type="text/javascript"> </script>
  <script src="js/sweet-alert.js" type="text/javascript"> </script>
  <script src="js/jGrowl/jquery.jgrowl.js" type="text/javascript"> </script>

  <script>
  $(document).ready(function() {
    $('input[type="checkbox"]').change(function(){ 
        var $this =  $(this).parents('#quiz-options').find('input[type="checkbox"]');
        $this.not(this).prop('checked', false);
    });    
});


function myFunction() {
  var x = document.getElementById("MyDiv");
  var b = document.getElementById("mybut");
  var c = document.getElementById("examSession");
  if (x.style.display === "none") { 
    b.style.visibility = 'hidden';
    x.style.display = "block";
    c.style.display ="block";
    startTimer();
  }
}
window.onload = function () {
  document.getElementById('MyDiv').style.display = 'none';
  document.getElementById('examSession').style.display = 'none';
};

 
function startTimer() {
  var zeroFill = function(units) {
    return units < 10 ? "0" + units + "" : units;
  };
  var count = 0;

  var interval = window.setInterval(function() {
    var centisecondsRemaining = 60100 - count;
    var hr = Math.floor((centisecondsRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var min = Math.floor(centisecondsRemaining / 100 / 60);
    var sec = zeroFill(Math.floor(centisecondsRemaining / 100 % 60));
    //var cs = zeroFill(centisecondsRemaining % 100);
    document.getElementById('timer').innerHTML = hr + "h" + ":" + min + "m" + ":" + sec + "s";
    count++;
    if (centisecondsRemaining === 0) {
      clearInterval(interval);
      alert('Your Time is up... Click OK to continue');
      window.location = 'user_dashboard.php';
    }
  }, 10);
}

$('.cont').addClass('hide');
    count=$('.questions').length;
     $('#question'+1).removeClass('hide');

     $(document).on('click','.next',function(){
         element=$(this).attr('id');
         last = parseInt(element.substr(element.length - 1));
         nex=last+1;
         $('#question'+last).addClass('hide');

         $('#question'+nex).removeClass('hide');
     });

     $(document).on('click','.previous',function(){
         element=$(this).attr('id');
         last = parseInt(element.substr(element.length - 1));
         pre=last-1;
         $('#question'+last).addClass('hide');

         $('#question'+pre).removeClass('hide');
     });

</script>
  </body>
</html>
