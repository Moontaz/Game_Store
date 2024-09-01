<?php
class App
{
   protected $controller = 'HomeController';
   protected $method = 'index';
   protected $params = [];

   public function __construct()
   {
      session_start(); // Memulai sesi

      $url = $this->parseURL();
      // echo '<pre>';
      // print_r($url);
      // echo '</pre>';
      // Controller
      if (!empty($url) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
         $this->controller = ucfirst($url[0]) . 'Controller';
         unset($url[0]);
      }

      require_once '../app/controllers/' . $this->controller . '.php';
      $this->controller = new $this->controller;

      // Method
      if (isset($url[1])) {
         if (method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
         }
      }
      $this->params = $url ? array_values($url) : [];

      // Cek autentikasi untuk halaman yang memerlukan login
      if ($this->controller != 'AuthController' && $this->method != 'login' && $this->method != 'register' && $this->method != 'logout' && !isset($_SESSION['user'])) {
         header('Location: ' . BASEURL . '/?url=auth/login');
         exit;
      }

      // Call the controller's method with the parameters
      call_user_func_array([$this->controller, $this->method], $this->params);
   }

   public function parseURL()
   {
      if (isset($_GET['url'])) {
         $url = rtrim($_GET['url'], '/');
         $url = filter_var($url, FILTER_SANITIZE_URL);
         $url = explode('/', $url);
         return $url;
      }
      return [];
   }
}
