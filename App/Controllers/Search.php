<?php 
namespace App\Controllers;
use App\Models\Searches;
use App\Models\ExamPaper;
use \Core\View;

class Search extends \Core\Controller
{

    protected function before()
    {
        //before
    }

    protected function after()
    {
        //after
    }

    // public function indexAction($var)
    // {
    //     // $search = preg_split('/\s+/', $search);
    //     // array_pop($search);
    //     // $query = 'SELECT * FROM wallpapers WHERE ';
    //     // for($i = 0 ; $i<count($search); $i++)
    //     // {
    //     //    $query = $query . 'title LIKE \'%'.$search[$i].'%\' OR category LIKE \'%'.$search[$i].'%\' '; 
    //     //    if($i != (count($search) -1))
    //     //    {
    //     //        $query = $query . ' OR ';
    //     //    }
    //     // }

    //     $search = $_GET['search'];
    //     $url = $_SERVER['QUERY_STRING'];

    //     if(preg_match('/\/exampapers\//i', $url) == 1)
    //     {
    //         $dbTable = 'files';
    //         $pageModule = 'exampapers';
    //     } else { $dbTable = 'joblists';$pageModule = 'joblist'; }

    //     $searchDB = Searches::getSearch($dbTable,$search);
    
    //     if($var== NULL)
    //         {$var = "1";}
    //     $page = str_replace('list','',$var);
    //     $page = (int)$page;
    //     if($page==0)
    //         {throw new \Exception("Page (listPage) String is not entered correctly",404);}
    //     $total_count = count($searchDB);    
    //     $tenX = $total_count/10;
    //     $list_count = $page*10;
    //     if($page > $tenX+1 )
    //         {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
    //     $carouselData = ExamPaper::getCarousel();
    //     View::renderTemplate('Search/index.html',[
    //         'data' => $searchDB,
    //         'total_count' => $total_count,
    //         'page' => $page,
    //         'list_count' => $list_count,
    //         'carouselData' => $carouselData,
    //         'pageModule' => $pageModule
    //     ]);

    // }

}

?>