<?php 

namespace App\Controllers;

use Core\Controller;
use Core\View;

use App\Models\Post;

class Posts extends Controller
{

    public function index()
    {
        $posts = Post::getAll();
        View::renderTemplate('posts.php',['name'=>'Mostafa Mahfouz','posts'=>$posts]);
    }

}