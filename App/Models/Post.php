<?php 

namespace App\Models;

use Core\Model;
use PDO;

class Post extends Model
{
    public static function getAll()
    {

        try 
        {
            $db = static::getDB();
            $stmt = $db->query("SELECT * FROM posts");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }
}