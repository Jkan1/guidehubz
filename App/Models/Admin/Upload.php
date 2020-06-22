<?php
namespace App\Models\Admin;

use PDO;

class Upload extends \Core\Model
{

  public static function insertAll($category,$year,$title,$filename,$comment)
  {
    //$host = 'localhost';
    //$dbname = 'mvcframeworkdesign';
    //$username = 'root';
    //$password = '';

    try {
      //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
      $db = static::getDB();

      $stmt = $db->query("INSERT INTO `files` (`category`, `year`, `title`, `comment`, `filename`) VALUES ('$category', '$year', '$title', '$comment', '$filename')");
      return true;
    } catch(PDOException $e) {
        echo $e->getMessage();
        throw new \Exception("Error in updating database!");
        return false;
    }
  }

  public static function insertJob($title,$description,$eligibility,$impdates,$website,$category)
  {
    //$host = 'localhost';
    //$dbname = 'mvcframeworkdesign';
    //$username = 'root';
    //$password = '';

    try {
      //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
      $db = static::getDB();

      $stmt = $db->query("INSERT INTO `joblists` (`category`, `title`, `eligibility`, `impdates`, `description`, `website`) VALUES ('$category', '$title', '$eligibility', '$impdates', '$description', '$website')");
      return true;
    } catch(PDOException $e) {
        echo $e->getMessage();
        throw new \Exception("Error in updating database!");
        return false;
    }
  }

  public static function getAll()
  {
    //$host = 'localhost';
    //$dbname = 'mvcframeworkdesign';
    //$username = 'root';
    //$password = '';

    try {
      //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
      $db = static::getDB();

      $stmt = $db->query("SELECT `email` FROM `subscribes`");
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch(PDOException $e) {
        echo $e->getMessage();
        throw new \Exception("Error in loading Subscribed Emails!");
        return false;
    }
  }


}
?>