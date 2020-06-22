<?php 
namespace App\Controllers\Admin;
use \Core\View;
use App\Models\Admin\Upload;

class Profile extends \Core\Controller
{

protected function before()
{
  session_start();

  if(isset($_SESSION['logged-in']))
  {
    if($_SESSION['logged-in'] == false)
    {  
      //echo "Log in first!";
      throw new \Exception("Log into admin first to access this page.",404);
      return false;
    }
    else if($_SESSION['logged-in'] == true)
    {
      //echo 'Welcome '.$_SESSION['user'];
      return true;    
    }
  }
  else 
  {
    $_SESSION['logged-in'] = false;
    //echo "Log in first!";
  }

}

protected function after()
{

}

public function indexAction()
{

  if (isset($_POST['submit'])) 
  {
    $category = $_POST['category'];
    $year = $_POST['year'];
    $comment = $_POST['comment'];
    $name = $_POST['name'];
    $uploadfilename = $_FILES["upload_file"]['name'];
    $extension = strtolower(substr($uploadfilename, strpos($uploadfilename, '.') + 1));
    $type = $_FILES['upload_file']['type'];
    $filename = preg_replace('/\s+/', '', $_POST['filename']);
    $uploadfilename= $filename.".".$extension;
    $target_dir = "Files/";
    $target_file = $target_dir . $uploadfilename;
    $uploadOk = 1;  
    
    //echo "Category:$category <br>";
    //echo "Year:$year <br>";
    //echo "Name:$name <br>";
    //echo "Comment:$comment <br>";
    //echo 'Filename:'.$_POST['filename'].'<br>';
    //echo "SaveFilename:$uploadfilename <br>";
    //$target_file = $target_dir . basename($_FILES["upload_file"]["name"]);
    //$filename =  basename($_FILES["upload_file"]["name"]);;
    //echo "$uploadfilename <br> $extension <br> $type";
    //echo "Target File: $target_file and $target_dir";
    //echo "<br>Filename:\"$filennn\"";
    //echo "<br>Filename:\"$uploadfilename\"";
    //
    if (file_exists($target_file)) {
      echo "<script>alert('Sorry, file already exists.');</script>";
      $uploadOk = 0;
    }
    if ($_FILES["upload_file"]["type"] != "application/pdf") {
      echo "<script>alert('Sorry, your file is not PDF!.');</script>";
      $uploadOk = 0;
    }
  /*  // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }*/
      if ($uploadOk == 0) {
      echo "<script>alert('Sorry, your file was not uploaded.');</script>";
    } else {
        if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file)) {
          //echo "<script>alert('The file ". $uploadfilename . " has been uploaded.');</script>";
          $result = Upload::insertAll($category,$year,$name,$filename,$comment); 
          if(!$result)
          {
            echo "<script>alert('Sorry! Database not updated!!');</script>";  
          }
          else
          {
            echo "<script>alert('Database Updated!!');</script>";
          }
        } 
        else 
        {
          echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }
  }

  if(isset($_POST['sendtoall']))
  {
    $emails = Upload::getAll();
    $count =  count($emails); 
    if($count < 1 )
    {
      echo "<script>alert('Sorry, No Subscribers in database.');</script>";
    }   
    else
    { 
      $all_emails = "";
      for($i = 0; $i<$count;$i++){
        if($i==0)
        {  $all_emails = $emails[$i]['email']; }
        $all_emails = $all_emails.",".$emails[$i]['email'];
      }

      $email_to = "guidehubz@gmail.com";
      $headers   = array();
      $headers[] = "MIME-Version: 1.0";
      $headers[] = "Content-type: text/plain; charset=iso-8859-1";
      $headers[] = "From: GuideHubZ <noreply@guidehubz.com>";
      $headers[] = "Bcc: $all_emails";
      $headers[] = "Reply-To: Admin | GuideHubZ <guidehubz@gmail.com>";
      $headers[] = "X-Mailer: PHP/".phpversion();
      $subject = $_POST['subject']." | GuideHubZ";
      $message = $_POST['message'];
      /*Updates are Available.
      This is an Test email.
      Thank you
      GuideHubZ (India) Team';*/
      mail($email_to, $subject, $message, implode("\r\n", $headers));
      echo "<script>alert('Mail Succesfully Sent to all!');</script>";
    } 
  }


  if (isset($_POST['submitJob'])) 
  {
    $category = $_POST['Jobcategory'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $eligibility = $_POST['eligibility'];
    $impdates = $_POST['impdates'];
    $website = $_POST['website'];
    $uploadOk = 1;  
    
    // echo "Category:$category <br>";
    // echo "Title:$title <br>";
    // echo "Description:$description <br>";
    // echo "Eligibility:$eligibility <br>";
    // echo 'Impdates:'.$_POST['impdates'].'<br>';
    // echo "Website:$website <br>";
    
    
    if ($uploadOk != 1) {
      echo "<script>alert('Sorry, database not updated.');</script>";
    } else {
          $result = Upload::insertJob($title,$description,$eligibility,$impdates,$website,$category); 
          if(!$result)
          {
            echo "<script>alert('Sorry! Database not updated!!');</script>";  
          }
          else
          {
            echo "<script>alert('Database Updated!!');</script>";
          }
        }
    
  }
  


  //echo "Profile Page!";
  View::renderTemplate('Admin/profile.html',[
    'user' => $_SESSION['user']
    //'colors' => ['red','green','blue']
 ]);
}
}

?>
