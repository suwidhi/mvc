<?php

namespace app\controllers;

// controller untuk home.
class home extends \core\controller{
    // fungsi action index.
    public function indexAction() {
        // bawa ke index.
        \core\view::render('index.php');
    }
    // fungsi test untuk menguji fungsionalitas.
    public function testAction() {
        //var_dump($this->data);
        // test dengan custom variable.
        \core\view::render('display.php', $this->data);
    }
    // coba untuk menampilkan data
    public function displayAction(){
        $model = new \app\models\test();
        $data = $model->getData();
        \core\view::render('display.php', $data);
    }
}