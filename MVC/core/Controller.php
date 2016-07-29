<?php

class Controller {
    public function model($model) {
        require_once "../MVC/core/PDOsql.php";
        require_once "../MVC/models/$model.php";
        return new $model ();
    }
    
    public function view($view, $data = Array()) {
        require_once "../MVC/views/$view.php";
    }
}

?>