<?php
namespace core;

class router{
    // variable routes berisi semua route yang ditambahkan pada method add.
    private $routes = array();

    // variable params berisi parameter yang didapat setelah query string diproses.
    private $params = array();

    // fungsi add: menambahkan route baru.
    // parameter 1: $route nama route atau dalam bentuk format {}.
    // parameter 2: $param opsional, berisi parameter untuk rute yang diberikan.
    public function add($route, $param = array()) {
        // misal route yang diberikan: {controller}/{action}.
        // akan diubah menjadi regexp: /^(?<controller>[a-z-_]+)\/(?<action>[a-z-_]+)$/

        // 1. escape tanda / menjad \/
        $route = preg_replace("/\//", "\\/", $route);

        // 2. ganti yang ada di antara tanda { dan }.
        $route = preg_replace("/\{([a-z-_]+)\}/", "(?<$1>[a-z_-]+)", $route);

        // 3. custom query, misal {id:\d+} menjadi (?<id>d+)
        $route = preg_replace("/\{([a-z-_]+):(.*)\}/", "(?<$1>$2)", $route);

        // 4. tambah delimiter.
        $route = "/^" . $route . "$/";

        // simpan ke variable routes.
        $this->routes[$route] = $param;
    }

    // fungsi dispatch: menentukan controller dan action yang sesuai dengan query string.
    // parameter 1: $query Query string pada server.
    public function dispatch($query) {
        // karena nama controller dan action semua small caps, ubah semua menjadi hurup kecil
        $query = strtolower($query);
        // cari pada route dan cocokkan dengan query string yang ada
        foreach($this->routes as $route => $param) {
            // jika cocok hentikan pencarian dan set variable params ke param yang cocok.
            if(preg_match($route, $query, $matches)) {
                // langsung saja variable $params = $param yang match saat ini
                $this->params = $param;
                // setiap matches yang keynya berupa string kita masukkan ke var $params;
                foreach($matches as $key => $value) {
                    if(is_string($key)) {
                        $this->params[$key] = $value;
                    }
                }
            }
        }
        // controller yang didapat, jika kosong maka home.
        $controller = isset($this->params['controller']) 
                    ? $this->correctControllerName($this->params['controller']) : 'home';
        // action yang didapat jika kosong maka index.
        $action = isset($this->params['action']) 
                ? $this->correctActionName($this->params['action']) : 'index';
        var_dump(array($controller, $action));
        // nama class controller yang mungkin.
        $controllerClass = "app\\controllers\\" . $controller;
        // nama file untuk controller yang mungkin,
        $controllerFile = DIR_CONTROLLER . $controller . '.php';

        // cek jika controller memang ada jika tidak langsung 404.
        if(!file_exists($controllerFile)) {
            $this->error404();
        }

        // jika file ada maka buat objek controller.
        $controllerObject = new $controllerClass();
        $controllerAction = $action . "Action";

        // cek jika action ada di controller.
        if(!method_exists($controllerObject, $controllerAction)) {
            $this->error404();
        }

        // dispatch.
        call_user_func(array($controllerObject, $action));
        exit;

    }
    // mendapatkan semua parameter yang match dengan route saat ini.
    public function getParams() {
        return $this->params;
    }

    // mendapatkan semua routes yang tersimpan, fungsi sementara. Akan dihapus setelah final.
    public function getRoutes(){
        return $this->routes;
    }
    // untuk menampilka route yang tidak ada
    protected function error404() {
        \core\view::render('404.php');
    }
    // ubah nama controller agar sesuai dengan query string
    // parameter 1: $name nama controller.
    protected function correctControllerName($name) {
        // perubahan yang dilakukan hanya mengubah '-' menjadi '_';
        return str_replace('-', '_', $name);
    }
    // ubah nama action agar sesuai.
    // parameter 1: $name nama action.
    protected function correctActionName($name) {
        // misal nama 'nama-action-percobaan' menjadi 'namaActionPercobaan';
        // 1. ubah '-' menjadi ' ';
        $name = str_replace('-', ' ', $name);
        // 2. ubah setiap hurup awal kata menjadi hurup besar.
        $name = ucwords($name);
        // 3. ubah ' ' menjadi '';
        $name = str_replace(' ', '', $name);
        // 4. ubah hurup pertama menjadi hurup kecil.
        $name = lcfirst($name);
        return $name;
    }
}