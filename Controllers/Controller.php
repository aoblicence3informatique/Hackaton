<?php

namespace Controllers;

abstract class Controller {
    protected $viewPath;
    protected $template = 'default';

    public function __construct() {
        $this->viewPath = ROOT . DS . 'Views' . DS;
    }

    protected function render($view, $variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', DS, $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'Templates' . DS . $this->template . '.php');
    }

    protected function loadModel($model_name) {
        $class_name = '\\Models\\' . $model_name;
        return new $class_name();
    }

    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }
} 