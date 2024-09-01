<?php
class AuthController extends Controller
{
   private $db;

   public function __construct()
   {
      $this->db = new Database;
   }

   public function login()
   {
      // Jika metode permintaan adalah POST
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $username = $_POST['username'];
         $password = $_POST['password'];

         // Panggil fungsi untuk mendapatkan pengguna berdasarkan email
         $user = $this->getUser($username);

         if ($user) {

            if ($password == $user['password']) {
               if (session_status() == PHP_SESSION_NONE) {
                  session_start(); // Memulai sesi hanya jika belum dimulai
               }
               $_SESSION['user'] = $user['username'];
               $_SESSION['email'] = $user['email'];
               $_SESSION['id'] = $user['id'];
               $role = $user['role'];
               // var_dump($role);
               if ($role == 'customer') {
                  // $_SESSION['cart'] = []
                  $_SESSION['cust_id'] = $this->model('User_model')->getCustIdbyUserId($_SESSION['id']);
                  header('location: ' . BASEURL . "?url=Home/index");
                  exit;
               } elseif ($role == 'developer') {
                  $_SESSION['dev_id'] = $this->model('User_model')->getDevIdbyUserId($_SESSION['id']);
                  header('location: ' . BASEURL . "?url=Home/index_dev");
                  exit;
               } elseif ($role == 'admin') {
                  header('location: ' . BASEURL . "?url=dashboard");
                  exit;
               }
            } else {
               echo "Password salah!";
               // header('Location: ' . BASEURL . '?url=auth/login');
               // exit;
            }
         } else {
            echo "Username salah!";
            // header('Location: ' . BASEURL . '?url=auth/login');
            // exit;
         }
      } else {
         $data['judul'] = 'Login';
         $this->view('template/header-nonnavbar', $data);
         $this->view('auth/login', $data);
         $this->view('template/footer');
      }
   }

   public function register()
   {
      // Jika metode permintaan adalah POST
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $data = $_POST;
         // var_dump($data);
         if ($this->model('User_model')->register($data)) {
            $_SESSION['flash'] = [
               'message' => 'Registration successful!',
               'type' => 'primary'
            ];
            header('Location: ' . BASEURL . '?url=auth/login');
            exit;
         } else {
            $_SESSION['flash'] = [
               'message' => 'Registration failed!',
               'type' => 'danger'
            ];
            header('Location: ' . BASEURL . '?url=auth/register');
            exit;
         }
      } else {
         $data['judul'] = 'Register';
         $data['address'] = $this->model('User_model')->getAllAddress();
         $this->view('template/header-nonnavbar', $data);
         $this->view('auth/register', $data);
         $this->view('template/footer');
      }
   }

   public function logout()
   {
      session_destroy();
      header('Location: ' . BASEURL . '?url=auth/login');
   }

   private function getUser($user)
   {
      $this->db->query("SELECT * FROM users WHERE username = :user");
      $this->db->bind(':user', $user);
      return $this->db->resultSingle();
   }
}
