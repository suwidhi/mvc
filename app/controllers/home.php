<?php

namespace app\controllers;

// controller untuk home.
class home extends \core\controller{
    // fungsi action index.
    public function indexAction() {
        // untuk sekarang hanya untuk percobaan print selamat datang.
        echo "selamat datang di index untuk controller home";
    }
    // fungsi test untuk menguji fungsionalitas.
    public function testAction() {
        // view itu secara universal.
        $view = new \core\view('index.php');
        require($view);
    }
}