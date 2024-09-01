<?php

class DashboardController extends Controller
{
   public function index()
   {
      $data['users'] = $this->model('User_model')->getAllUser();
      $data['devs'] = $this->model('User_model')->getAllDev();
      $data['custs'] = $this->model('User_model')->getAllCust();
      $data['address'] = $this->model('User_model')->getAllAddress();
      $header['judul'] = 'Admin Dashboard';
      // var_dump($header['users']);
      // echo $header['users'];
      $this->view('template/header', $header);
      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }
      $this->view('dashboard/index', $data);
      $this->view('template/footer');
   }
   public function index2()
   {
      $data['users'] = $this->model('User_model')->getAllUser();
      $data['custs'] = $this->model('User_model')->getAllCust();
      $data['users'] = $this->model('User_model')->getAllUser();
      $data['devs'] = $this->model('User_model')->getAllDev();
      $data['games'] = $this->model('Game_model')->getAllGame();
      $data['wishs'] = $this->model('Game_model')->getAllWishs();
      $data['reviews'] = $this->model('Game_model')->getAllreviews();
      $header['judul'] = 'Admin Dashboard';
      $this->view('template/header', $header);
      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }
      $this->view('dashboard/index2', $data);
      $this->view('template/footer');
   }
   public function index3()
   {
      $data['orders'] = $this->model('User_model')->getAllOrders();
      $data['order_items'] = $this->model('Game_model')->getAllOrderItems();
      $data['custs'] = $this->model('User_model')->getAllCust();
      $data['games'] = $this->model('Game_model')->getAllGame();
      $data['downloads'] = $this->model('Game_model')->getAllDownloads();
      $header['judul'] = 'Admin Dashboard';
      $this->view('template/header', $header);
      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }
      $this->view('dashboard/index3', $data);
      $this->view('template/footer');
   }
   public function index4()
   {
      $data['address'] = $this->model('User_model')->getAllAddress();
      $header['judul'] = 'Admin Dashboard';
      $this->view('template/header', $header);
      if (isset($_SESSION['flash'])) {
         $this->view('template/flash', $_SESSION['flash']);
      }
      $this->view('dashboard/index4', $data);
      $this->view('template/footer');
   }
}
