<?php 

namespace App\Controllers;
use Core\Controller;
use Core\View;


class Home extends Controller
{
    public function index()
    {
        // View::render('home.php',['name'=>'Mostafa Mahfouz']);
        View::renderTemplate('home.php',['name'=>'Mostafa Mahfouz']);
    }
}