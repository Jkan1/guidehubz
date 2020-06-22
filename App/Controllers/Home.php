<?php 
namespace App\Controllers;
use \Core\View;
use App\Models\JobLists;

class Home extends \Core\Controller
{

protected function before()
{
  session_start();
  if (isset($_SESSION['flashMessage'])) {
    echo $_SESSION['flashMessage'];
    unset($_SESSION['flashMessage']);
    session_unset();
    session_destroy();
  }
  //echo "(before) "; 
  //return false;
}

protected function after()
{
  //echo " (after)";
}

public function indexAction()
{
 // echo "Hello from the index action of the Home controller!";
 //View::render('Home/index.php',[
 //  'name' =>  'Kanishka',
 //  'colors' => ['red','green','blue']
 //]);
 View::renderTemplate('Home/index.html',[
    //'name' => 'DaveTwig',
    //'colors' => ['red','green','blue']
 ]);
}

public function aboutusAction()
{
 //echo "Hello from the aboutus action of the Home controller!";
 $carouselData = JobLists::getCarousel();
 View::renderTemplate('Home/aboutus.html',[
   'carouselData' => $carouselData
 ]);
}


}

?>