<?php

class GameController extends Controller
{

   //Function for Game
   public function addGame()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // Check if a file has been uploaded
         if (isset($_FILES['game_file']) && $_FILES['game_file']['error'] === UPLOAD_ERR_OK) {
            // Check file size (limit: 2MB)
            if ($_FILES['game_file']['size'] <= 2097152) {
               // Define the upload directory and file path
               $uploadDir = 'file/';
               $fileName = basename($_FILES['game_file']['name']);
               $filePath = $uploadDir . $fileName;

               // Move the uploaded file to the destination directory
               if (move_uploaded_file($_FILES['game_file']['tmp_name'], $filePath)) {
                  // Prepare the data to be inserted
                  $data = [
                     'developer_id' => $_SESSION['dev_id'],
                     'title' => $_POST['title'],
                     'short_desc' => $_POST['short_desc'],
                     'description' => $_POST['description'],
                     'price' => $_POST['price'],
                     'release_date' => $_POST['release_date'],
                     'file_path' => $filePath
                  ];

                  // var_dump($data);
                  $boolean = $this->model('Game_model')->addGame($data);
                  var_dump($boolean);
                  // Insert the game data
                  if ($boolean) {
                     $_SESSION['flash'] = [
                        'message' => 'Game added successfully!',
                        'type' => 'success'
                     ];
                  } else {
                     $_SESSION['flash'] = [
                        'message' => 'Error: Could not add game!',
                        'type' => 'danger'
                     ];
                  }
               } else {
                  $_SESSION['flash'] = [
                     'message' => 'Error: Could not move the uploaded file!',
                     'type' => 'danger'
                  ];
               }
            } else {
               $_SESSION['flash'] = [
                  'message' => 'Error: File size exceeds 2MB limit!',
                  'type' => 'danger'
               ];
            }
         } else {
            $_SESSION['flash'] = [
               'message' => 'Error: No file uploaded!',
               'type' => 'danger'
            ];
         }

         // echo "<script>history.back();</script>";
         exit;
      }
   }

   public function downloadFile($game_id)
   {
      $game = $this->model('Game_model')->getGameById($game_id);

      if ($game) {
         $filePath = $game['file_path'];
         if (file_exists($filePath)) {
            if ($this->model('Game_model')->addDownload($_SESSION['cust_id'], $game_id)) {

               // Set headers
               header('Content-Description: File Transfer');
               header('Content-Type: application/octet-stream');
               header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
               header('Expires: 0');
               header('Cache-Control: must-revalidate');
               header('Pragma: public');
               header('Content-Length: ' . filesize($filePath));

               // Clear output buffer
               ob_clean();
               flush();

               // Read the file
               readfile($filePath);
               exit;
            } else {
               $_SESSION['flash'] = [
                  'message' => 'Error: Add to Downloads!',
                  'type' => 'danger'
               ];
               echo "<script>history.back();</script>";
               exit;
            }
         } else {
            // File doesn't exist
            $_SESSION['flash'] = [
               'message' => 'Error: File does not exist!',
               'type' => 'danger'
            ];
            echo "<script>history.back();</script>";
            exit;
         }
      } else {
         // Game not found
         $_SESSION['flash'] = [
            'message' => 'Error: Game not found!',
            'type' => 'danger'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }
   public function keyword()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $_SESSION['keyword'] = $_POST;
         var_dump($_POST);
      } else {
         echo "gak ada post";
      }
      // header('location: ' . BASEURL . "?url=home/search");
   }
   public function addKey()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {

         var_dump($_GET);
         $keyword = $_GET['keyword'];
         $results = $this->model('Game_model')->searchFuzzy($keyword);

         $data['judul'] = 'Search Results';
         $data['results'] = $results;

         $this->view('template/header', $data);
         $this->view('home/search_results', $data);
         $this->view('template/footer');
      } else {
         var_dump($_SERVER['REQUEST_METHOD']);
         echo 'GAK ADA POSTNYAA';
      }
   }

   public function updateGame()
   {
      if ($this->model('Game_model')->updateGame($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Update Game successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }

   public function deleteGames()
   {
      // if ($this->model('Game_model')->deleteGame($_POST['deleteIds']) > 0) {
      if ($this->model('Game_model')->deleteGames($_POST['deleteGameIds'])) {
         $_SESSION['flash'] = [
            'message' => 'Delete Game successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }
   public function updateDownload()
   {
      // if ($this->model('Game_model')->deleteGame($_POST['deleteIds']) > 0) {
      if ($this->model('Game_model')->updateDownload($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Update download data successful!',
            'type' => 'primary'
         ];
      } else {
         $_SESSION['flash'] = [
            'message' => 'ERROR:Update download data!',
            'type' => 'warning'
         ];
      }
      echo "<script>history.back();</script>";
      exit;
   }
   public function deleteDownload($id)
   {
      // if ($this->model('Game_model')->deleteGame($_POST['deleteIds']) > 0) {
      if ($this->model('Game_model')->deleteDownload($id)) {
         // var_dump($id);
         $_SESSION['flash'] = [
            'message' => 'Delete download data successful!',
            'type' => 'primary'
         ];
      } else {
         $_SESSION['flash'] = [
            'message' => 'ERROR:Delete download data!',
            'type' => 'warning'
         ];
      }
      echo "<script>history.back();</script>";
      exit;
   }
   public function getWishsbyCustId($user_id)
   {
      $cust_id = $this->model('User_model')->getCustIdbyUserId($user_id);
      $cust_id = $this->model('Game_model')->getWishsbyCustId($cust_id);
      if ($this->model('Game_model')->getWishsbyCustId($cust_id)) {
         // header('location: ' . BASEURL . "?url=$controller/$method");
         exit;
      }
   }
   public function addWish($game_id)
   {
      if ($this->model('Game_model')->addWish($_SESSION['cust_id'], $game_id)) {
         $_SESSION['flash'] = [
            'message' => 'Add Wishlist successful!',
            'type' => 'primary'
         ];
         // header('location: ' . BASEURL . "?url=$controller/$method");
         echo "<script>history.back();</script>";
         exit;
      }
      echo "<script>history.back();</script>";
   }
   public function removeWish($game_id)
   {
      if ($this->model('Game_model')->removeWish($_SESSION['cust_id'], $game_id)) {
         $_SESSION['flash'] = [
            'message' => 'Remove Wihslist successful!',
            'type' => 'primary'
         ];
         // header('location: ' . BASEURL . "?url=$controller/$method");
         echo "<script>history.back();</script>";
         exit;
      }
      echo "<script>history.back();</script>";
   }
   public function addCart($game_id)
   {
      if (!isset($_SESSION['cart'])) {
         $_SESSION['cart'] = [];
      }
      $cart = $this->model('Game_model')->addCart($_SESSION['cart'], $game_id);

      $_SESSION['cart'] = $cart;
      $_SESSION['flash'] = [
         'message' => 'Success added to cart!',
         'type' => 'primary'
      ];
      echo "<script>history.back();</script>";
      exit;
   }
   public function removeCart($game_id)
   {
      $cart = $this->model('Game_model')->removeCart($_SESSION['cart'], $game_id);
      $_SESSION['cart'] = $cart;
      echo "<script>history.back();</script>";
      if (!empty($_SESSION['cart'])) {
         $_SESSION['flash'] = [
            'message' => 'Your cart is empty now, Back to Homepage!',
            'type' => 'primary'
         ];
         header('location: ' . BASEURL . "?url=home/index");
      }
      exit;
   }
   public function deleteWishs($controller, $method)
   {
      // if ($this->model('Game_model')->deleteGame($_POST['deleteIds']) > 0) {
      if ($this->model('Game_model')->deleteWishs($_POST['deleteIdsWish'])) {
         $_SESSION['flash'] = [
            'message' => 'Delete Wishlist successful!',
            'type' => 'primary'
         ];
         header('location: ' . BASEURL . "?url=$controller/$method");
         exit;
      }
   }
   public function updateWish($controller, $method)
   {
      // if ($this->model('Game_model')->deleteGame($_POST['deleteIds']) > 0) {
      // var_dump($_POST);
      if ($this->model('Game_model')->updateWish($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Update Wishlist successful!',
            'type' => 'primary'
         ];
         header('location: ' . BASEURL . "?url=$controller/$method");
         exit;
      }
   }

   public function addReview()
   {
      if ($this->model('Game_model')->addReview($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Add Review successful!',
            'type' => 'primary'
         ];
         // header('location: ' . BASEURL . "?url=$controller/$method");
         echo "<script>history.back();</script>";
         exit;
      }
      $_SESSION['flash'] = [
         'message' => 'ERROR:Add Review!',
         'type' => 'danger'
      ];
      echo "<script>history.back();</script>";
   }
   public function updateReview()
   {
      if ($this->model('Game_model')->updateReview($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Update Review successful!',
            'type' => 'primary'
         ];
         // header('location: ' . BASEURL . "?url=$controller/$method");
         echo "<script>history.back();</script>";
         exit;
      }
      $_SESSION['flash'] = [
         'message' => 'ERROR:Update Review!',
         'type' => 'danger'
      ];
      echo "<script>history.back();</script>";
   }

   public function deleteReviews($controller, $method)
   {
      // Extract the review ID from the URL
      $reviewId = $_GET['reviewId'];
      // var_dump($reviewId);

      // Use the extracted review ID to delete the review
      if ($this->model('Game_model')->deleteReview($reviewId)) {
         $_SESSION['flash'] = [
            'message' => 'Delete Review successful!',
            'type' => 'primary'
         ];
         header('location: ' . BASEURL . "?url=$controller/$method/#reviews");
         exit;
      }
   }

   public function updateItem()
   {
      if ($this->model('Game_model')->updateItem($_POST)) {
         $_SESSION['flash'] = [
            'message' => 'Update item successful!',
            'type' => 'primary'
         ];
         echo "<script>history.back();</script>";
         exit;
      } else {
         $_SESSION['flash'] = [
            'message' => 'ERROR:Update item failed!',
            'type' => 'danger'
         ];
         echo "<script>history.back();</script>";
         exit;
      }
   }
   public function deleteItem($item_id, $controller, $method)
   {
      // if ($this->model('User_model')->deleteDev($_POST['deleteIds']) > 0) {
      if ($this->model('Game_model')->deleteItem($item_id)) {
         $_SESSION['flash'] = [
            'message' => 'Delete Item successful!',
            'type' => 'primary'
         ];
         header('location: ' . BASEURL . "?url=$controller/$method");
         exit;
      }
   }
}
