<?php

class Controller {
    public function model($model) {
        require_once "../ActivityMVC/core/Opensql.php";
        require_once "../ActivityMVC/models/$model.php";
        return new $model ();
    }
    
    public function view($view, $data = Array()) {
        require_once "../ActivityMVC/views/$view.php";
    }
}

?>