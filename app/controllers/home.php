<?php

namespace app\controllers;

use core\new_view;

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
        $view = new new_view('base.php');
        $list = new new_view('components/list.php');
        $list->setData(array('name' => 'test', 'list-items' => array('satu', 'dua', 'tiga')));

        $view->addComponent('main', $list);
        $view->view();
    }
}