<?php
    session_start();
	require_once('connection.php');
  
    if(isset($_SESSION['email']) && isset($_SESSION['name']))
    {
    	  $email = $_SESSION['email'];
        $name = $_SESSION['name']; 
        
    }
    else {
    	header('location: admin_logout.php');
      return;
         }
   if(isset($_GET['quizID']))
   {
    $quizID = $_GET['quizID'];

    	 $sql = "SELECT is_active FROM quizes WHERE quiz_id='$quizID'";
          
          $result = mysqli_query($conn,$sql);
          
      if($result->num_rows==1)
      {
          $row = $result->fetch_assoc();
          if($row['is_active'])
          	$toggle = 0;
          else $toggle = 1;
          $sql = "UPDATE quizes SET is_active='$toggle' WHERE quiz_id='$quizID'";
          mysqli_query($conn,$sql);
          if($toggle == 0){
            $_SESSION['message'] = 'Inactive';
            $_SESSION['color'] = '#f39c12';
          }
          else{
            $_SESSION['message'] = 'Active';
            $_SESSION['color'] = '#27ae60';
          }
          header('location: exam_status.php');
      }
      else{
            $_SESSION['message'] = 'Something Went Wrong!';
            $_SESSION['color'] = '#e74c3c';
          header('location: exam_status.php');
      }
  }
  else {
            $_SESSION['message'] = 'Something Went Wrong!';
            $_SESSION['color'] = '#e74c3c';
          header('location: exam_status.php');
  }
?>
