<?php

class UserController extends Controller
{
   public function index()
   {
      $data['users'] = $this->model('User_model')->getAllUser();
      $data['devs'] = $this->model('User_model')->getAllDev();
      $data['judul'] = 'Admin Dashboard';
      $this->view('template/header', $data);
      $this->view('dashboard/index', $data);
      $this->view('template/footer');
   }



   //Function for Developer
   public function addDev()
   {

      if ($this->model('User_model')->addDev($_POST) > 0) {
         $_SESSION['flash'] = [
            'message' => 'Add developer successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }

   public function updateDev()
   {
      if ($this->model('User_model')->updateDev($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Update developer successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }

   public function deleteDev()
   {
      // if ($this->model('User_model')->deleteDev($_POST['deleteIds'])) {
      if ($this->model('User_model')->deleteDev($_POST['deleteIds'])) {
         $_SESSION['flash'] = [
            'message' => 'Delete developer successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }

   //Function for Developer
   public function addCust()
   {
      if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email']) || !isset($_POST['full_name']) || !isset($_POST['address_id'])) {
         $_SESSION['flash'] = [
            'message' => 'ERROR: All Data Required!',
            'type' => 'danger'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
      if ($this->model('User_model')->addCust($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Add customer successful!',
            'type' => 'primary'
         ];
      } else {
         $_SESSION['flash'] = [
            'message' => 'ERROR:Add customer!',
            'type' => 'danger'
         ];
      }
      echo "<script>history.back();</script>";
      exit;
   }

   public function updateCust()
   {
      if ($this->model('User_model')->updateCust($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Update customer successful!',
            'type' => 'primary'
         ];
         // var_dump($_POST);
         echo "<script>history.back();</script>";
         exit;
      }
   }

   public function deleteCust()
   {
      // if ($this->model('User_model')->deleteDev($_POST['deleteIds']) > 0) {
      if ($this->model('User_model')->deleteCust($_POST['deleteIdsCust'])) {
         $_SESSION['flash'] = [
            'message' => 'Delete customer successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }

   public function addOrders($cust_id, $total)
   {

      if (!empty($_SESSION['cart'])) {
         $gameCart = $_SESSION['cart'];
         // var_dump($gameCart);
         unset($_SESSION['cart']);
         $_SESSION['cart'] = [];
         if ($this->model('User_model')->addOrders($cust_id, $total, $gameCart)) {
            $_SESSION['flash'] = [
               'message' => 'Your game now in my game tab!',
               'type' => 'primary'
            ];
            exit;
         }
      }
   }
   public function addOrdersFree($cust_id, $total, $idgame)
   {

      if ($this->model('User_model')->addOrdersFree($cust_id, $total, $idgame)) {
         $_SESSION['flash'] = [
            'message' => 'Your game now in my game tab!',
            'type' => 'primary'
         ];
         exit;
      }
      echo "<script>history.back();</script>";
   }

   public function updateOrder()
   {
      if ($this->model('User_model')->updateOrder($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Update order successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      } else {
         $_SESSION['flash'] = [
            'message' => 'ERROR:Update order failed!',
            'type' => 'danger'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }

   public function deleteOrder($order_id)
   {
      // if ($this->model('User_model')->deleteDev($_POST['deleteIds']) > 0) {
      if ($this->model('User_model')->deleteOrder($order_id)) {
         $_SESSION['flash'] = [
            'message' => 'Delete order successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }
   public function addAddress()
   {
      // if ($this->model('User_model')->deleteDev($_POST['deleteIds']) > 0) {
      if ($this->model('User_model')->addAddress($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Add address successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
      $_SESSION['flash'] = [
         'message' => 'ERROR:Add address!',
         'type' => 'danger'
      ];
      echo "<script>history.back();</script>";
      exit;
   }
   public function deleteAddress($id)
   {
      // if ($this->model('User_model')->deleteDev($_POST['deleteIds']) > 0) {
      if ($this->model('User_model')->deleteAddress($id)) {
         $_SESSION['flash'] = [
            'message' => 'Delete address successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }
   public function updateAddress()
   {
      if ($this->model('User_model')->updateAddress($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Update address successful!',
            'type' => 'primary'
         ];
         // var_dump($_POST);
         echo "<script>history.back();</script>";
         exit;
      }
   }
   public function deleteUser($id)
   {
      if ($this->model('User_model')->deleteUser($id)) {
         $_SESSION['flash'] = [
            'message' => 'Delete User successful!',
            'type' => 'primary'
         ];
         // var_dump($_POST);
         echo "<script>history.back();</script>";
         exit;
      }
   }
}
