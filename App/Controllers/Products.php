<?php 

namespace App\Controllers;
use Core\Controller;
use Core\View;

class Products extends Controller
{

    public function index()
    {
        View::renderTemplate('products.php',['name'=>'Mostafa Mahfouz']);
    }


    public function show()
    {
        echo "this is class ".__CLASS__." and this is method : ".__METHOD__;
        print_r($this->route_params);
    }



    public function add()
    {
        echo "this is class ".__CLASS__." and this is method : ".__METHOD__;
    }
}