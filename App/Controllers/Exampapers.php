<?php 
namespace App\Controllers;
use \Core\View;
use App\Models\Searches;
use App\Models\ExamPaper;

class Exampapers extends \Core\Controller
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

public function indexAction($var)
{
    /*// echo "Hello from the index action of the Home controller!";
    //echo '<p>Query String parameters: <pre>' . htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
    $data = ExamPaper::getAll();
    //$total_count = count($data);
    //$page = "lisasdt21";
    if($var== NULL)
      {$var = "1";}
    //$page = trim($var,"list");
    $page = str_replace('list','',$var);
    $page = (int)$page;
    
    if($page==0)
    {
      throw new \Exception("Page (listPage) String is not entered correctly",404);
    }

    $total_count = count($data);
    
    $tenX = $total_count/10;

    $list_count = $page*10;
    
    if($page > $tenX+1 )
      {
        throw new \Exception("Page (ListPage) Limit exceeded!",404);
      }
    */
    //echo "Var:".$var."<br>".$total_count."<br>".$page."<br>".$list_count;
    //echo "<br>";
    //echo 12/10;// ans 1.2 

    if(isset($_GET['search']) && $_GET['search']!='' && $_GET['search']!=' ' && preg_match('/(\s\s)+/i',$_GET['search']) != 1)
    {
      $search = $_GET['search'];
      $url = $_SERVER['QUERY_STRING'];

      if(preg_match('/exampapers/i', $url) == 1)
      {
          $dbTable = 'files';
          $pageModule = 'exampapers';
      } else 
      { 
        $dbTable = 'joblists';
        $pageModule = 'joblist'; 
      }

      $searchDB = Searches::getSearch($dbTable,$search);
      $total_count = count($searchDB);
      $carouselData = ExamPaper::getCarousel();

      View::renderTemplate('Search/index.html',[
          'data' => $searchDB,
          'total_count' => $total_count,
          'carouselData' => $carouselData,
          'pageModule' => $pageModule,
          'searchString' => $search
      ]);
  }
  else {

    $carouselData = ExamPaper::getCarousel();

    View::renderTemplate('ExamPapers/index.html',[
      'carouselData' => $carouselData
      //'data' => $data,
      //'total_count' => $total_count,
      //'page' => $page,
      //'list_count' => $list_count
    ]);
    }
  }

public function upscAction($var)
{
    $pagefunction = "upsc";
    $category = "UPSC";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
    $carouselData = ExamPaper::getCarousel();
    View::renderTemplate('ExamPapers/indexcategory.html',[
      'pagefunction' => $pagefunction,
      'pagecategory' => $category,
      'data' => $data,
      'total_count' => $total_count,
      'page' => $page,
      'list_count' => $list_count,
      'carouselData' => $carouselData
    ]);
}

public function sscAction($var)
{
    $pagefunction = "ssc";
    $category = "SSC";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}

public function privateAction($var)
{
    $pagefunction = "private";
    $category = "Private";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}

public function railwayAction($var)
{
    $pagefunction = "railway";
    $category = "Railway";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}

public function bankpoAction($var)
{
    $pagefunction = "bankpo";
    $category = "Bank PO";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}


public function cdsAction($var)
{
    $pagefunction = "cds";
    $category = "CDS";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}


public function afcatAction($var)
{
    $pagefunction = "afcat";
    $category = "AFCAT";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}



public function delhipoliceAction($var)
{
    $pagefunction = "delhipolice";
    $category = "Delhi Police";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}


public function ppscAction($var)
{
    $pagefunction = "ppsc";
    $category = "PPSC";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}

public function punjabpoliceAction($var)
{
    $pagefunction = "punjabpolice";
    $category = "Punjab Police";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}

public function uppscAction($var)
{
    $pagefunction = "uppsc";
    $category = "UPPSC";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}


public function mppscAction($var)
{
    $pagefunction = "mppsc";
    $category = "MPPSC";
    $data = ExamPaper::getAll($category);
    if($var== NULL)
      {$var = "1";}
    $page = str_replace('list','',$var);
    $page = (int)$page;
    if($page==0)
      {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    $total_count = count($data);    
    $tenX = $total_count/10;
    $list_count = $page*10;
    if($page > $tenX+1 )
      {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
      $carouselData = ExamPaper::getCarousel();
  View::renderTemplate('ExamPapers/indexcategory.html',[
    'pagefunction' => $pagefunction,
    'pagecategory' => $category,
    'data' => $data,
    'total_count' => $total_count,
    'page' => $page,
    'list_count' => $list_count,
    'carouselData' => $carouselData
 ]);
}

}

?>