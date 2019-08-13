<?php

namespace core;

class view{
  // menyimpan nama template.
  private $template;
  // menyimpan data yang diberikan di constructor.
  private $data;
  // constructor.
  // parameter 1: $template nama file template untuk view ini.
  public function __construct($template) {
    $this->template = DIR_VIEW . $template;
  }
  // untuk sementara definisi template untuk view ini.
  // parameter 1: $data data template view.
  protected function setData($data) {
    $this->data = $data;
  }
  // untuk menampilkan semua template yang diload dengan echo atau print.
  public function __toString() {
    return $this->template;
  }
}