<?php 
namespace App\Models;

use PDO;

class Searches extends \Core\Model
{

    public static function getSearch($dbTable,$search)
    {
        //$host = 'localhost';
        //$dbname = 'mvcframeworkdesign';
        //$username = 'root';
        //$password = '';

        // $search = preg_split('/\s+/', $str);
        // array_pop($search);
        //SELECT * FROM wallpapers 
        //WHERE tags LIKE '%New%' OR name LIKE '%new%' 
        //or tags LIKE '%York%' OR name LIKE '%York%'

        $search = preg_split('/\s+/', $search);
        //array_pop($search);

        $query = 'SELECT * FROM '.$dbTable.' WHERE ';
        
        for($i = 0 ; $i<count($search); $i++)
        {
           $query = $query . 'title LIKE \'%'.$search[$i].'%\' OR category LIKE \'%'.$search[$i].'%\''; 
           if($i != (count($search) -1))
           {
               $query = $query . ' OR ';
           }
        }

        try {
            //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
            $db = static::getDB();

            $stmt = $db->query($query . ' ORDER BY timeofupdate DESC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}


?>