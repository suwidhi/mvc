<?php

namespace core;

class view{
// view itu sederhana. hanya untuk render nama view yang diberikan.
// fungsi untuk merender view.
// parameter 1: $view nama view yang ada di \app\view\namaview.ext
// parameter 2: $data (optional) data yang akan dipakai diview.

public static function render($name, $data= array()) {
  // lokasi view secara utuh.
  $file = DIR_VIEW . $name;
  // cek jika view memang ada.
  if(!is_file($file)) {
    exit('Error, tidak mampu merender view. Hubungi administrator.');
  }
  require($file);
  exit;
}
}