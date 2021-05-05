<?php

// Class to call the controller and its method.
class App
{
    // Default paramets of file name controller passed through $_GET
    protected $controller = 'home';

    // Default paramets of method name in the above controller passed through $_GET
    protected $method = 'index';

    // Default other paramets passed through $_GET
    protected $parms = [];


    // Called when an app is created
    public function __construct()
    {
        $url = $this->parseUrl();

        //check if controller file exist or not
        if(file_exists('../app/controller/'.$url[0].'.php'))
        {
            $this->controller = $url[0];
            unset($url[0]);
        }


        //getting and creating instance of the class of the controller
        require_once '../app/controller/'.$this->controller.'.php';

        $this->controller = new $this->controller;


        //check if the method exist in the controller class
        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //storing the parameters in parms
        $this->parms = $url ? array_values($url) : [];

        //calling the method of the class controller and sending the parameters as array
        call_user_func_array([$this->controller, $this->method], [$this->parms]);
    }


    //Converting url into an array of controller name, method name and other parameters
    public function parseUrl()
    {
        if(isset($_GET['url']))
        {
            $url = ltrim($_GET['url'], '/Php_Login_MVC_structure/');
            $url = ltrim($url, 'mvc/public');

            $url = explode('/',filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
            return $url;

        }
    }
}

?>
