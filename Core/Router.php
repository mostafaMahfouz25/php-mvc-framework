<?php 

/**
 * 
 * Router class 
 * cofiguration to route 
 * 
 */

namespace Core;

class Router
{
    /**
     * 
     * routeing table ( associative array)
     */
    protected $routes = [];

    /**
     * 
     * parameters from matched route
     */
    protected $params = [];


    /**
     * 
     * add route to the routing table 
     * @param string $route the route url 
     * @param array $params  parameters (controller , action , parameters)
     * @return void 
     */

    public function add($route,$params =[])
    {
        // convert the route to regular expression  - escape forward slashes 
        $route = preg_replace('/\//','\\/',$route);
        // convert variables 
        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z0-9]+)',$route);
        // convert variables with custome regular expression 
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/','(?P<\1>[a-z0-9]+)',$route);
        $route = '/^'.$route.'$/i';
        $this->routes[$route] = $params;
    }

    /**
     * get all the routes from routing table 
     * @return array
     * 
     */

    public function getRoutes()
    {
        return $this->routes;
    } 



    /**
     * match  the route to the route in the routing table ,setting the params 
     * property if a route is found 
     * @param string $url => the route url 
     * @return bool true if mateched found  , false otherwise 
     */

    public function match($url)
    {
        //  using regular expression 
        // $url = trim($url,"/");
        foreach($this->routes as $route => $params)
        {   
            if(preg_match($route,$url,$matches))
            {      
                // get named captured 
                foreach($matches as $key => $match)
                {
                    if(is_string($key))
                    {
                        $params[$key] = $match;   
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        
        return false;
    }


    /**
     * get currently matched params 
     * @return @array
     * 
     */
    public function getParams()
    {
        return $this->params;
    }




    /**
     * fire controller and method 
     * extract controller name and method name from query string 
     * @return void 
     */

    public function dispatch()
    {
        $url = $this->removeQueryStringVariables($_SERVER['REQUEST_URI']);
        if($this->match($url))
        {
            $controller = $this->params['controller'];
            $controller = $this->convertedToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;

            if(class_exists($controller))
            {
                // create object from controller 
                $controller_object = new $controller($this->params);

                $action  = $this->params['action'];
                if(is_callable([$controller_object,$action]))
                {
                    $controller_object->$action();
                }
                else
                {
                    throw new \Exception("Method {$action} in Controller {$controller} Not Found");
                }
            }
            else 
            {
                throw new \Exception("This Controller {$controller} Not Exist ");
            }
        }
        else
        {
            throw new \Exception("Route Not Found ! :(","404");
        }
    }




    /**
     * converted string to studly caps 
     */
    private function convertedToStudlyCaps($string)
    {
        return str_replace(' ','',ucwords(str_replace('-',' ',$string)));
    }



    /**
     * 
     * 
     * remove query string varibles from route
     * 
     * 
     */
    private function removeQueryStringVariables($url)
    {
        if($url != '')
        {
            $parts = explode('?',$url,2);
            if(strpos($parts[0],'=')===false)
            {
                $url = $parts[0];
            }
            else 
            {
                $url = '';
            }
        }
        return $url;
    }



    /**
     * get namespace of class from params 
     * @return string 
     */

     private function getNamespace()
     {
        $namespace = "App\Controllers\\";
        if(array_key_exists('namespace',$this->params))
        {
            $namespace .= $this->params['namespace'].'\\'; 
        }
        return $namespace;
     }








    // $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
    // $url=trim($url,"/");
    // if(preg_match($reg_exp,$url,$matches))
    //     {
    //         // get named captured 
    //         $params = [];
    //         foreach($matches as $key => $match)
    //         {
    //             if(is_string($key))
    //             {
    //                 $params[$key] = $match;   
    //             }
    //         }
    //         $this->params = $params;
    //         return true;
    //     }

    // using basic way 
    // foreach($this->routes as $route => $params)
    // {
    //     if($url == $route)
    //     {
    //         $this->params = $params;
    //         return true;
    //     }
    // }


}