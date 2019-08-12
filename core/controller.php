<?php

namespace core;
// set sebagai abstrak class, karena akan di extend oleh subclasses.
abstract class controller{
    // variable berisikan model yang dipakai untuk mendapatkan data.
    protected $model = null;

    // fungsi untuk render view ??.
    // parameter 1: $view nama view yang akan dirender.
    // parameter 2: $data data yang diambil dari model pada controller.
    protected function renderView($view, $data) {
        // ambil view dari direktori view di tambah dengan nama view.
        $view = DIR_VIEW . $view;
        // check jika view valid jika tidak maka hentikan program.
        if(!is_file($view)) {
            exit("View $view tidak ditemukan");
        } 
        // render view.
        include($view);
    }

}