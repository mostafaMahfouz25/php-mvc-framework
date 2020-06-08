<?php 


namespace Core;

abstract class Controller 
{
    protected $route_params = [];


    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }


    public function __call($method,$args)
    {
        throw new \Exception("Method : ".$method ."Not Found In The Controller : ".\get_class($this));
    }
}