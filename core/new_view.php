<?php

namespace core;

class new_view{
  // tujuan view ini adalah untuk membuat view yang extensible dan less dependency. mungkin.,

  // path dari view secara lengkap.
  protected $template = '';

  // component dari view misal didalam base ada aside, ada navigation, sidebar, dll.
  protected $components = array();

  // data yang disediakan untuk ditampilkan sesuai metode yang diinginkan.
  protected $data = array();

  // contruct memerlukan parameter:
  // parameter 1: $name nama dari file view seperti /app/views/name.ext
  public function __construct($name) {
    $name = DIR_VIEW . $name;
    // cek jika nama valid
    if(!is_file($name)) exit("view named: $name is not valid.");

    $this->template = $name;
  }
  // tambah data untuk view ini.
  // parameter 1: $data data berupa array.
  public function setData($data){
    $this->data = $data;
  }
  // menambah komponen view.
  // parameter 1: $name nama dari komponen
  // parameter 2: $comp objek view yang akan dijadika komponen.
  public function addComponent($name, $comp) {
    $this->components[$name] = $comp;
  }
  // tambah data daripada set. harus dipanggil setelah set.
  // parameter 1: $name identifier dari value.
  // parameter 2: $value value dari data.
  public function addData($name, $value) {
    $this->data[$name] = $value;
  }
  // untuk mencetak data.
  // parameter 1: $name nama atau identifier dari data.
  public function print($name) {
    if(!in_array($name, $this->data)) {
      exit('data yang ditentukan tidak ada');
    }
    // print jika tipe data adalah string, jika tidak print type data.
    if(is_string($this->data[$name])) {
      print($this->data[$name]);
    } else {
      print(gettype($this->data[$name]));
    }
  }
  // untuk mengambil data yang bisa saja berupa array atau terserah.
  // parameter 1: $name nama daripada data yang akan diambil.
  public function take($name) {
    if(!in_array($name, $this->data)) {
      exit('nama data tidak valid');
    }
    return $this->data[$name];
  }
  // untuk menampilkan komponen
  // parameter 1: $name nama komponen yang ingin ditampilkan,
  // jika $name kosong maka akan view diri sendiri.
  public function view($name = null) {
    if(!in_array($name, $this->components)){
      exit('component yang ditentukan tidak ada');
    }
    if($name === null) {
      require_once($this->template);
    } else {
      require_once($this->components[$name]);
    }
  }
}