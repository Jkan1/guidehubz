<?php 
namespace App\Controllers;
use \Core\View;
use App\Models\JobLists;
use App\Models\Searches;

class Joblist extends \Core\Controller
{

protected function before()
{
    //echo "Bfore";
}

protected function after()
{
    //echo "After";
}

public function joblistAction($var)
{
    //echo "WELCOME TO JOB LISTS.";
    View::renderTemplate('JobList/index.html',[
        //
    ]);
}

public function indexAction($var)
{

    if(isset($_GET['search']) && $_GET['search']!='' && $_GET['search']!=' ' && preg_match('/(\s\s)+/i',$_GET['search']) != 1)
    {
        $search = $_GET['search'];
        $url = $_SERVER['QUERY_STRING'];

        if(preg_match('/\/exampapers/i', $url) == 1)
        {
            $dbTable = 'files';
            $pageModule = 'exampapers';
        } else { $dbTable = 'joblists';$pageModule = 'joblist'; }

        $searchDB = Searches::getSearch($dbTable,$search);
        $total_count = count($searchDB);
        $carouselData = JobLists::getCarousel();
        
        View::renderTemplate('Search/index.html',[
            'data' => $searchDB,
            'total_count' => $total_count,
            'carouselData' => $carouselData,
            'pageModule' => $pageModule,
            'searchString' => $search
        ]);
    }
    else {

        //$pagefunction = "upsc";
        //$category = "UPSC";
        $carouselData = JobLists::getCarousel();
        $data = JobLists::getAll();
        if($var== NULL)
            {$var = "1";}
        $page = str_replace('list','',$var);
        $page = (int)$page;
        if($page==0)
            {throw new \Exception("Page (ListPage) String is not entered correctly",404);}
        $total_count = count($data);    
        $tenX = $total_count/10;
        $list_count = $page*10;
        if($page > $tenX+1 )
            {throw new \Exception("Page (ListPage) Limit exceeded!",404);}
        View::renderTemplate('Joblist/joblist.html',[
            //'pagefunction' => $pagefunction,
            //'pagecategory' => $category,
            'carouselData' => $carouselData,
            'data' => $data,
            'total_count' => $total_count,
            'page' => $page,
            'list_count' => $list_count
        ]);
    }
    // View::renderTemplate('Joblist/joblist.html',[]);
}


}

?>