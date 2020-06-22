<?php
namespace App\Models;

use PDO;

class Subscriber extends \Core\Model
{


  public static function getAll($e_email)
  {
    //$host = 'localhost';
    //$dbname = 'mvcframeworkdesign';
    //$username = 'root';
    //$password = '';

    try {
      //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
      $db = static::getDB();

      $stmt = $db->query('SELECT * FROM `subscribes` WHERE email=\''.$e_email.'\'');
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $results;
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  }

  public static function insertAll($e_email)
  {
    //$host = 'localhost';
    //$dbname = 'mvcframeworkdesign';
    //$username = 'root';
    //$password = '';

    try {
      //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
      $db = static::getDB();

      $stmt = $db->query("INSERT INTO `subscribes`(`email`) VALUES ('$e_email')");
      return true;
    } catch(PDOException $e) {
        echo $e->getMessage();
        throw new \Exception("Error in updating Subscriber database!");
        return false;
    }
  }

}

?>