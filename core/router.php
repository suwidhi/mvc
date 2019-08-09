<?php
namespace core;

class router{
    // variable routes berisi semua route yang ditambahkan pada method add.
    private $routes = array();

    // variable params berisi parameter yang didapat setelah query string diproses.
    private $params = array();

    // fungsi add: menambahkan route baru.
    // parameter 1: nama route atau dalam bentuk format {}.
    // parameter 2: opsional, berisi parameter untuk rute yang diberikan.
    public function add($route, $param = array()) {
        // misal route yang diberikan: {controller}/{action}.
        // akan diubah menjadi regexp: /^(?<controller>[a-z-_]+)\/(?<action>[a-z-_]+)$/

        // 1. escape tanda / menjad \/
        $route = preg_replace("/\//", "\\/", $route);

        // 2. ganti yang ada di antara tanda { dan }.
        $route = preg_replace("/\{([a-z-_]+)\}/", "(?_$1_[a-z_-]+)", $route);

        // 3. custom query, misal {id:\d+} menjadi (?<id>d+)
        $route = preg_replace("/\{([a-z-_]+):(.*)\}/", "(?_$1_$2)", $route);

        // 4. tambah delimiter.
        $route = "/^" . $route . "$/";

        // simpan ke variable routes.
        $this->routes[$route] = $param;
    }

    // fungsi dispatch: menentukan controller dan action yang sesuai dengan query string.
    // parameter 1: query string pada server.
    public function dispatch($query) {
        // karena nama controller dan action semua small caps, ubah semua menjadi hurup kecil
        $query = strtolower($query);
        // cari pada route dan cocokkan dengan query string yang ada
        foreach($this->routes as $route => $param) {
            // jika cocok hentikan pencarian dan set variable params ke param yang cocok.
            if(preg_match($route, $query, $matches)) {
                // sakit perut nanti lagi
            }
        }
    }
    
    public function getRoutes(){
        return $this->routes;
    }
}