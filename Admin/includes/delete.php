<?php
include 'dbcon.php';

// delete question
if(isset($_POST['questionDeleteBtn'])){
  $id = $_POST['id'];

  $delete = mysqli_query($con, "DELETE FROM questions WHERE id='$id'");
  if($delete){
    echo 200;
  }else{
    echo 500;
  }
}
?>