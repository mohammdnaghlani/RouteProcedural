<?php

    function start() 
    {
        $current_uri =  getCurrentUri();
        $route_exists = routeExists($current_uri) ;
        if(!$route_exists){
            header("HTTP/1.0 404 Not Found");
            die('404 page not found !') ;
        }
        extract($route_exists) ;
        $allowed_method = allowedMethod($method);
        if(!$allowed_method){
            header("HTTP/1.0 403 access denide");
            die('403 access denide !') ; 
        }
        if(strpos($target , '@')){
            list($folder,$file) = explode('@' , $target) ;
            $file_path = BASE_PATH . $folder . DIRECTORY_SEPARATOR . $file .'.php';
        }else{
            $file_path = BASE_PATH . $target .'.php';
        }      

        if(!file_exists($file_path)){
            die('not found') ; // FIXME : create alert .
        }
        $params = getParams() ;

        include $file_path ;
        return ;
    }


    function getCurrentUri()
    {
        $current_uri =explode('?' ,$_SERVER['REQUEST_URI']  );
        $current_uri = rtrim($current_uri[0], '/');
        return $current_uri ;
    }


    function routeExists(string $current_uri) 
    {
        $get_all_routes = include BASE_PATH . 'routes.php' ;

        return(isset($get_all_routes[$current_uri]) ? $get_all_routes[$current_uri] : false) ;
    }

    function allowedMethod(string $method) 
    {
        $current_method = strtolower($_SERVER['REQUEST_METHOD']) ;
        return ($current_method === $method ?:false ) ;
    }


    function getParams()
    {
        return (object) $_REQUEST ;
    }