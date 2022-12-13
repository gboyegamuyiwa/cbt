<?php
$select_subject = "SELECT * FROM questions WHERE `subject_name`='".$_GET['search_by_subject']."' ORDER BY `date_added` DESC";
$check_query = $link->query($select_subject);
if ($check_query->num_rows > 0)
{
while($fetch = $check_query->fetch_assoc()){
$question_id = $fetch['id'];
$date_added = $fetch['date_added'];
$subject_name = $fetch['subject_name'];
$question_name = $fetch['question'];
$date=strftime("%d %b, %Y %H:%M:%S",strtotime($fetch['date_added']));


$results .= "<form action='' method='POST'>";
$results .= "<tr style='text-align: center;'>";
$results .= "<td>".$counter++. "</td>";
$results .= "<td style='text-align: left;' width='40%'>".$question_name. "</td>";
$results .= "<td style='text-transform: uppercase;'>".$subject_name."</td>"; 
$results .= "<td>".$date."</td>";
$results .= '<td><a href="edit.php?question_id='.$question_id.'" class="btn btn-primary" target="_blank">Edit</a></td>';
$results .= '<td><input type="submit" name="delete" value="Delete" class="btn btn-danger"></td>';
$results .= "</tr>";
$results .= "</form>";

}

echo '<div class="col-md-12">
      <center><h3 style="text-transform: uppercase;color: #880000;">'.$check_query->num_rows.' Results Found For '.$_GET['search_by_subject'].'</h3></center>
     <div style="max-height: 500px; overflow-x: auto">
       <table class="table table-bordered" style="font-family: Montserrat;">
        <thead>
          <tr class="info" style="text-transform: uppercase; text-align: center;">
            <th style="text-align: center;">sn</th>
            <th style="text-align: center;">question</th>
            <th style="text-align: center;">Subjects</th>
            <th style="text-align: center;">date Added</th>
            <th style="text-align: center;">edit</th>
            <th style="text-align: center;">delete</th>
          </tr>
        </thead>
        '.$results.'
        </table>
      </div>
    </div>';
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { 
    swal({
      title: "Opps!",
      text: "No result found",
      type: "warning",
      confirmButtonText: "OK"
    },
    function(isConfirm){
      if (isConfirm) {
        window.location.href = "edit_questions.php";
      }
    }); }, 50)';
    echo '</script>';
  }

  // delete question
  if (isset($_POST['delete']))
  {
    echo '<script type="text/javascript">';
    echo ' 
      swal({
      title: "Are you sure?",
      text: "This question will be deleted permanently!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#880000",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"

      }).then(function(isConfirm){
        if (isConfirm) {
          swal("Successful", "question deleted Successfully", "success");
          windows.location = "edit_questions.php";
        } else {

        }
      });';
    echo '</script>';
  }
?>