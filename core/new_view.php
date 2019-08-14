<?php

namespace core;

class new_view{
  // tujuan view ini adalah untuk membuat view yang extensible dan less dependency. mungkin.,
  
  // nama view yang ditentukan.
  protected $template = '';

  // component dari view misal didalam base ada aside, ada navigation, sidebar, dll.
  protected $components = array();

  // data yang disediakan untuk ditampilkan sesuai metode yang diinginkan.
  protected $data = array();

  // contruct memerlukan parameter:
  // parameter 1: $name nama dari file view seperti /app/views/name.ext
  // parameter 2: $data data untuk view ini.
  public function __construct($name, $data) {
    $name = DIR_VIEW . $name;
    // cek jika nama valid
    if(!is_file($name)) exit('view name is not valid.');

    $this->template = $name;
    $this->data = $data;
  }

  // tambahkan komponen ke dalam view ini.
  // parameter 1: $name nama dari komponen.
  // parameter 2: view $comp view didalam view.
  public function addComponent($name, \core\new_view $view) {
    $this->components[$name] = $view;
  }
}