<?php 
  require_once('connection.php');
  session_start();
  if(isset($_GET['quizID']))
   {
    	 $quizID = $_GET['quizID'];

    	 $sql = "SELECT show_evaluation FROM quizes WHERE quiz_id='$quizID'";
          
         $result = mysqli_query($conn,$sql);
          
      if($result->num_rows==1)
      {
          $row = $result->fetch_assoc();
          if($row['show_evaluation'])
          	$toggle = 0;
          else $toggle = 1;
          $sql = "UPDATE quizes SET show_evaluation='$toggle' WHERE quiz_id='$quizID'";
          mysqli_query($conn,$sql);
          if($toggle == 0){
            $_SESSION['message'] = 'Evaluation Concealed';
            $_SESSION['color'] = '#27ae60';
          }
          else{
            $_SESSION['message'] = 'Evaluation Revealed';
            $_SESSION['color'] = '#f39c12';
          }
          header('location: public_access.php');
      }
      else{
            $_SESSION['message'] = 'Something Went Wrong!';
            $_SESSION['color'] = '#e74c3c';
          header('location: public_access.php');
      }
  }
  else {
            $_SESSION['message'] = 'Something Went Wrong!';
            $_SESSION['color'] = '#e74c3c';
          header('location: public_access.php');
  }
?>