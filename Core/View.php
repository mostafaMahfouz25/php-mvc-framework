<?php 

/**
 * View Class 
 * php version 7.3.7
 */
namespace Core;
class View 
{

    /**
     * render template to view 
     * @param string $view => name of file 
     * @param array args => load data to view 
     * @return file 
     */
    public static function render($view,$args = [])
    {
        extract($args,EXTR_SKIP);
        $file = "../App/Views/$view";
        if(is_readable($file))
        {
            require $file;
        }
        else 
        {
            echo "$file Is Not Exist";
        }
    }


    /**
     * render template to view using twig template engin 
     * @param string $view => name of file 
     * @param array args => load data to view 
     * @return file 
     */
    public static function renderTemplate($template,$args = [])
    {
        static $twig = null;
        if($twig == null)
        {
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views/');
            $twig = new \Twig\Environment($loader);
        }
        
        echo $twig->render($template,$args);
    }


}