<?php 
namespace App\Models;

use PDO;

class JobLists extends \Core\Model
{

    public static function getAll()
    {
        //$host = 'localhost';
        //$dbname = 'mvcframeworkdesign';
        //$username = 'root';
        //$password = '';
        try {
            //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
            $db = static::getDB();
  
            $stmt = $db->query('SELECT * FROM joblists ORDER BY timeofupdate DESC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public static function getCarousel()
    {
        //$host = 'localhost';
        //$dbname = 'mvcframeworkdesign';
        //$username = 'root';
        //$password = '';
        //fetch first 3 rows only
        try {
            //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
            $db = static::getDB();
  
            $stmt = $db->query('SELECT * FROM joblists ORDER BY timeofupdate DESC LIMIT 5');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>