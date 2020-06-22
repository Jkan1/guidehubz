<?php
namespace App\Models\Admin;

use PDO;

class User extends \Core\Model
{

  public static function getAll($e_username,$e_password)
  {
    //$host = 'localhost';
    //$dbname = 'mvcframeworkdesign';
    //$username = 'root';
    //$password = '';

    try {
      //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username, $password);
      $db = static::getDB();


      $stmt = $db->prepare('SELECT * FROM `user-info` WHERE username=:nam');
      $stmt->bindParam(':nam', $e_username);
      //$stmt->bindParam(':add', $txtAdd);
      //$stmt->bindParam(':cit', $txtCit);
      $stmt->execute();



      //$stmt = $db->query('SELECT * FROM `user-info` WHERE username=\''."$e_username'");
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  }

}

?>