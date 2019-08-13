<?php

namespace core;
// set sebagai abstrak class, karena akan di extend oleh subclasses.
abstract class controller{
    // variable berisikan model yang dipakai untuk mendapatkan data.
    protected $model = null;
    //data untuk controller yang dipakai.
    protected $data;

    // constructor harus berisi data yang diberikan user, dalam hal ini 
    // untuk sementara mungkin hanya post atau get.
    public function __construct($data = array()) {
        $this->data = $data;
    }
    // fungsi untuk melakukan pemanggilan terhadap method objek.
    // parameter 1: $name nama method yang dipanggil.
    // parameter 2: $params: parameter berupa array.
    public function __call($name, $params) {
        // karena suatu alasan nama method biasanya ditambakan action, jadi index = indexAction.
        $name = $name . 'Action';
        // cek jika method terkait ada di objek ini.
        if(!method_exists($this, $name)) {
            exit('Ada yang salah dengan sistem, ini seharusnya tidak pernah terpanggil.');
        }
        $this->before();
        call_user_func(array($this, $name), $params);
        $this->after();
    }
    // method tentang apa yang terjadi sebelum terjadi pemanggilan.
    protected function before() {
        echo "sebelummnya";
    }
    // apa yang terjadi setelahnya.
    protected function after() {
        echo "sesudahnya";
    }

}