<?php

// load file konfigurasi yang ada di ../core/config.php
require('../core/config.php');

// daftarkan callback autoload.
// nama class adalah berupa namespace dan nama, misal kalau sebuah class di
// directori core kita beri namespace core, misal yang berada di app/models kita beri namespace
// app/model, dan seterusnya.
spl_autoload_register(function($namaClass) {
    // ubah backslash menjadi slash karena di linux seperti itu, diwindows memang memakai backslash.
    $namaClass = str_replace("\\", "/", $namaClass);
    // misal namanya: core/router.php, ubah menjadi DIR_BASE . /core/router.php
    $namaClass = DIR_BASE . "/" . $namaClass . ".php";

    // tidak ada pengecekan disini, kalau ada class yang akan meng-include nanti,
    // harus diverifikasi dahulu keberadaan class tersebut on the go.
    require($namaClass);
});

// buat objek router baru.
$router = new core\router();

// daftarkan route yang diperlukan.
// route bisa dalam 2 tipe, pertama langsung: add(query, arrayParameter),
// atau add({controller}/{action}).

// misal untuk kosong tanpa apa apa, atau default page saat mengunjungi laman website.
// kita tetapkan controller:home dan action:index.
$router->add('', array('controller' => 'home', 'action' => 'index'));

// dan lain lainnya . . .
$router->add('{controller}');
$router->add('{controller}/{action}');
$router->add('{controller}/{id:d+}/{action}');


// dispatch atau arahkan ke controller dan action sesuai query string dan parameter.
$router->dispatch($_SERVER['QUERY_STRING']);

var_dump($router->getRoutes());
var_dump($router->getParams());
var_dump($_SERVER['QUERY_STRING']);
