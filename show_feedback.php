<!DOCTYPE html>
<html>
<head>
  <title>Feedback</title>
</head>
</html>
<?php
   session_start();
    require_once('connection.php');
    if(isset($_SESSION['login_time']))
     {
      $current_time = time();
        $login_time = $_SESSION['login_time'];
      if($current_time - $login_time   > 30000)   
      {
         header('location: admin_logout.php');
      }
     }
     else header('location: admin_logout.php');
?>
<!DOCTYPE html>
<html>

    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
  <div style="height: 55px;"></div>
      <div class="row row-card row-deck">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Feedback</h2>
            </div>
            <div class="card-body">
              <form action="" method="POST">
               <div class="col-sm-12 col-lg-12">
                 <div class="form-group">
                    <label class="form-label">Select Quiz :</label>
                  <!--   <div class="input-field col s12"> -->
                      <select  name="exam_id" class="form-control custom-select select-exam">
                        <option value disabled>Select Quiz</option>
                        <?php 
                      
                      $temp = "SELECT * FROM quizes WHERE admin_email_id='$_SESSION[admin_id]' ORDER BY quiz_name";
                               $result = mysqli_query($conn,$temp);

                          while($row = $result->fetch_assoc())
                          {
                            $sql = "SELECT * FROM question_bank WHERE quiz_id='$row[quiz_id]'";
                            $temp = mysqli_query($conn,$sql);  
                            if($temp->num_rows>0)
                              {  
                              
                                  echo "<option  value='$row[quiz_id]'>$row[quiz_name]</option>";
                              }
                          }
                          
                      ?>
                       
                       </select>
                         
                            <button name="submit" class="check-score btn btn-primary ml-auto" value="Check" type="submit">Check</button>
                         
                 </div>
               </div>
              </form>
            </div>
            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap">
                <thead>
                  <span style="margin-left: 25px;margin-top : 20px;font-weight: bold;">
                    <?php 
                    if(isset($_POST['exam_id']))
                    {
                      $sql = "SELECT quiz_name FROM quizes WHERE quiz_id='$_POST[exam_id]'";
                      $result = mysqli_query($conn,$sql);
                      $row = $result->fetch_assoc();
                      echo $row['quiz_name'];
                    }
                    ?> 
                  </span>
                </thead>
                <thead>
                  <tr>
                    <th class="w-1">S No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registration No</th>
                    <th>Comment</th>
                   
                  </tr>
                </thead>
                <tbody>
        <?php 
        if(isset($_POST['exam_id']))
        {
         $sql = "SELECT * FROM feedback JOIN attempts on feedback.attempt_id=attempts.attempt_id WHERE quiz_id='$_POST[exam_id]'";
            $result1 = mysqli_query($conn,$sql);
       
            $i = 1;
            while($row = $result1->fetch_assoc())
            {
                ?>


                  <tr>                                                 <!-- Passed -->
                    <td>                                                 <!-- | -->
                      <span class="text-muted"><?php echo $i;?></span>                  <!-- | -->  
                    </td>                                                <!-- |  -->                                    <!-- | -->
                    <td><?php echo $row['fullname'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['registration_no'];?></td>
                    <td><?php echo $row['comment']; ?></td>
                                                                     
                  </tr> 

<?php      
                   $i = $i + 1;
            }
        }
        ?>
                                                                  <!-- user -->
                </tbody>
              </table>
            </div>
          </div>
        </div>       
      </div>
    </div>


    <?php include 'includes/scripts.php'; ?>
   </body>

</html>