<?php
if (isset($_POST['serviceBtn'])) {
  $service_name = $_POST['service_name'];
  $short_description = $_POST['short_description'];
  $description = $_POST['description'];
  $img = $_FILES['service_image']['name'];


  /** 
      renaming the image name with 
      with random string
     **/
  $new_img_name = uniqid('CodeCrane-', true);
  $new_upload_img_name = "assets/img/services/" . uniqid('IMG-', true) . basename($img);
  $target_folder = "../assets/img/services/" . $new_img_name;
  $target_file = $target_folder . basename($img);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $extension = substr($img, strlen($img) - 4, strlen($img));
  $allowed_extension = array(".jpg", ".png", ".jpeg", ".gif", ".webp");

  if(in_array($extension,$allowed_extension)){
    $sql = "INSERT INTO services (service_name,short_description,description	,service_image) 
    VALUES ('$service_name','$short_description','$description','$new_upload_img_name')";
    $query = mysqli_query($con, $sql);
  
    if ($query) {
      move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file);
      $_SESSION['message'] = "Success";
      ?>
<script>
location.replace("list.php?Services");
</script>
<?php
    } else {
      $_SESSION['error'] = "Failed";
      ?>
<script>
location.replace("list.php?Services");
</script>
<?php
  
    }
  }else{
    $_SESSION['warning'] = "Invalid Extension";
    $_SESSION['replace_url'] = "add.php?Services";
    ?>
<script>
location.replace("list.php?Services");
</script>
<?php
  }


}

// add members

if(isset($_POST['submitMember'])){
  $full_name = $_POST['full_name'];
  $education = $_POST['education'];
  $post = $_POST['post'];
  $department = $_POST['department'];
  $facebook = $_POST['facebook'];
  $instagram = $_POST['instagram'];
  $linkedin = $_POST['linkedin'];
  $twitter = $_POST['twitter'];
  $youtube = $_POST['youtube'];
  $github = $_POST['github'];
  $image = $_FILES['image']['name'];
  $extension = pathinfo($image, PATHINFO_EXTENSION);
  $supported_extension = array("jpg","png","jpeg","gif","webp");
  if(in_array($extension, $supported_extension)){
    $new_name = rand().".".$extension; 
    $new_path_name = "assets/img/members/" .$new_name;
    $image_path = "../assets/img/members/" .$new_name;

    $sql = "INSERT INTO members ( `full_name`, `education`, `post`, `department`, `facebook`, `instagram`, `linkedin`, `twitter`, `youtube`, `github`, `image`) 
    VALUES ('$full_name','$education','$post','$department','$facebook','$instagram','$linkedin','$twitter','$youtube','$github','$new_path_name')";
    $query = mysqli_query($con,$sql);
    
    if($sql){
      move_uploaded_file($_FILES['image']['tmp_name'],$image_path);
      $_SESSION['message'] = "Success";
          ?>
<script>
location.replace("list.php?Team-Members");
</script>
<?php
        }else{
          $_SESSION['error'] = "Failed";
          ?>
<script>
location.replace("list.php?Team-Members");
</script>
<?php
        }
      }else{
      $_SESSION['warning'] = "Invalid Extension";
      $_SESSION['replace_url'] = "add.php?Team-Members";
      ?>
<script>
location.replace("list.php?Team-Members");
</script>
<?php
      }

}

// add projects

if(isset($_POST['submitProject'])){
  $project_name = $_POST['project_name'];
  $short_description = $_POST['short_description'];
  $description = $_POST['description'];
  
  $image = $_FILES['image']['name'];
  $extension = pathinfo($image, PATHINFO_EXTENSION);
  $allowed_extension = array("jpg","jpeg","png","webp","gif");

  if(in_array($extension,$allowed_extension)){
    $new_name = rand().".".$extension;
    $new_img_name = "assets/img/Projects/".$new_name;
    $image_path = "../assets/img/Projects/".$new_name;

    $sql = "INSERT INTO projects (`project_name`, `short_description`, `description`, `image`) 
    VALUES ('$project_name','$short_description','$description','$new_img_name')";
    $query = mysqli_query($con, $sql);
    
    if($query){
      move_uploaded_file($_FILES['image']['tmp_name'],$image_path);
      $_SESSION['message'] = "Success";
      ?>
<script>
location.replace("list.php?Projects");
</script>
<?php
    }else{
      $_SESSION['error'] = "Failed";
      ?>
<script>
location.replace("list.php?Projects");
</script>
<?php
    }
  }else{
    $_SESSION['warning'] = "Invalid Extension";
      $_SESSION['replace_url'] = "add.php?Projects";
      ?>
<script>
location.replace("list.php?Projects");
</script>
<?php
  }

}
?>