<?php

namespace MyProject;

class Router
{
    private $uri;
    private $controllerAndAction;
    public $args;
    public $controllerName;
    public $actionName;

    public function __construct()
    {
        $this->uri = explode('?', $_SERVER['REQUEST_URI']);
        $this->controllerAndAction = explode('/', $this->uri[0]) ?? '';
        if (!empty($this->controllerAndAction[1])) {
            $this->controllerName = $this->controllerAndAction[1];
        } else {
            $this->controllerName = 'MainController';
        }

        if (!empty($this->controllerAndAction[2])) {
            $this->actionName = $this->controllerAndAction[2];
        } else {
            $this->actionName = 'main';
        }

        if(isset($this->uri[1])) {
            parse_str($this->uri[1], $this->args);
        }
    }

    public function getController()
    {
        return $this->controllerName;
    }

    public function getAction()
    {
        return $this->actionName;
    }
}