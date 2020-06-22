<?php 
namespace App\Controllers;
use \Core\View;

class Download extends \Core\Controller
{

protected function before()
{
  //echo "(before) "; 
  //return false;
}

protected function after()
{
  //echo " (after)";
}

public function indexAction($var)
{
 // echo "Hello from the index action of the Home controller!";
 $var=$var.".pdf";
 $attachment_location = $_SERVER["DOCUMENT_ROOT"] . "/Files/$var";
 if (file_exists($attachment_location)) {
     header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
     header("Cache-Control: public"); // needed for internet explorer
     header("Content-Type: application/zip");
     header("Content-Transfer-Encoding: Binary");
     header("Content-Length:".filesize($attachment_location));
     header("Content-Disposition: attachment; filename=$var");
     readfile($attachment_location); 
     die();     
 } else {
     //die("Error: File not found.".$attachment_location);
     throw new \Exception("Error: File not found.".$attachment_location);
     die();
 } 

}

public function aboutusAction()
{
 //echo "Hello from the aboutus action of the Home controller!";
 View::renderTemplate('Home/aboutus.html',[
   
 ]);
}


}

?>